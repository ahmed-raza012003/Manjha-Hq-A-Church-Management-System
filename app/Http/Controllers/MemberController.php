<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    // Display a list of members
    public function index(Request $request)
    {
        $search = $request->get('search');
        $members = Member::query()
            ->when($search, function($query) use ($search) {
                return $query->where('first_name', 'like', "%$search%")
                             ->orWhere('email', 'like', "%$search%")
                             ->orWhere('phone_number', 'like', "%$search%");
            })
            ->paginate(10); // Paginate results
        return view('dashboard.members.list', compact('members', 'search'));
    }

    // Show the form to create a new member
    public function create()
    {
        return view('dashboard.members.create');
    }

    // Store a new member in the database
    public function store(Request $request)
    {
        $validatedData = $this->validateMember($request);

        if ($request->hasFile('picture')) {
            $validatedData['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $validatedData['is_draft'] = false;
        Member::create($validatedData);

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    // Show the form to edit a member
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('dashboard.members.edit', compact('member'));
    }

    // Update a member in the database
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $validatedData = $this->validateMember($request, $id);

        if ($request->hasFile('picture')) {
            if ($member->picture) {
                Storage::disk('public')->delete($member->picture);
            }
            $validatedData['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $member->update($validatedData);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    // Save a new draft
    public function saveDraft(Request $request)
    {
        $validatedData = $this->validateDraft($request);

        if ($request->hasFile('picture')) {
            $validatedData['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $draft = Member::create(array_merge($validatedData, ['is_draft' => true]));

        return redirect()->route('members.edit', $draft->id)->with('success', 'Draft saved successfully.');
    }

    // Update an existing draft
    public function updateDraft(Request $request, $id)
    {
        $draft = Member::findOrFail($id);
        $validatedData = $this->validateDraft($request, $id);

        if ($request->hasFile('picture')) {
            if ($draft->picture) {
                Storage::disk('public')->delete($draft->picture);
            }
            $validatedData['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $draft->update(array_merge($validatedData, ['is_draft' => true]));

        return redirect()->route('members.edit', $draft->id)->with('success', 'Draft updated successfully.');
    }

    // Delete a member or draft
    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        if ($member->picture) {
            Storage::disk('public')->delete($member->picture);
        }

        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }

    // Validate member data
    private function validateMember(Request $request, $id = null)
    {
        return $request->validate([
            'first_name' => 'required|string|max:255|unique:members,first_name,' . $id . ',id,is_draft,false',
            'middle_name' => 'nullable|string|max:255',
            'nick_name' => 'nullable|string|max:255',
            'picture' => 'nullable|image|max:2048',
            'gender' => 'required|string|max:10',
            'date_of_birth' => 'nullable|date',
            'groups' => 'nullable|string|max:255',
            'baptism_date' => 'nullable|date',
            'member_status' => 'required|string|max:50',
            'full_address' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:members,email,' . $id . ',id,is_draft,false',
            'phone_number' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
        ]);
    }

    // Validate draft data
    private function validateDraft(Request $request, $id = null)
    {
        return $request->validate([
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'nick_name' => 'nullable|string|max:255',
            'picture' => 'nullable|image|max:2048',
            'gender' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'groups' => 'nullable|string|max:255',
            'baptism_date' => 'nullable|date',
            'member_status' => 'nullable|string|max:50',
            'full_address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:members,email,' . $id . ',id,is_draft,true',
            'phone_number' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
        ]);
    }
}
