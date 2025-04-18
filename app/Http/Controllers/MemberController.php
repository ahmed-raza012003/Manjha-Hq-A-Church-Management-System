<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use App\Models\Contribution;
use Illuminate\Support\Facades\Auth;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MembersExport;
use App\Models\Event;
use Carbon\Carbon;  // Make sure this is included

class MemberController extends Controller
{


    // Display a list of members
    public function index(Request $request)
    {
        $search = $request->get('search');
        $members = Member::where('church_name', auth()->user()->church_name) // Filter by church_name
            ->when($search, function ($query) use ($search) {
                return $query->where('first_name', 'like', "%$search%")
                             ->orWhere('email', 'like', "%$search%")
                             ->orWhere('phone_number', 'like', "%$search%");
            })->paginate(10); // Paginate results
    
        return view('dashboard.members.list', compact('members', 'search'));
    }
    

    // Show the form to create a new member
    public function create()
    {
        $groups = Group::all(); // Fetch all groups
        return view('dashboard.members.create', compact( 'groups'));
    }

    // Store a new member in the database
    public function store(Request $request)
    {
        $user = Auth::user();
        $package = $user->package;
    
        $memberCount = Member::where('church_name', $user->church_name)->count(); // Count by church_name
        if ($memberCount >= $package->max_members) {
            return redirect()->route('members.index')->with('error', 'You have reached the maximum number of members allowed with your current package.');
        }
    
        $member = new Member($request->all());
        $member->user_id = $user->id;
        $member->church_name = $user->church_name; // Attach church_name
        $member->save();
    
        return redirect()->route('members.index');
    }
    

public function update(Request $request, $id)
{
    $member = Member::findOrFail($id);
    $validatedData = $this->validateMember($request, $id);

    // Update user_id to associate the member with the authenticated user
    $validatedData['user_id'] = auth()->id();  // Save the authenticated user's ID
    
    if ($request->hasFile('picture')) {
        if ($member->picture) {
            Storage::disk('public')->delete($member->picture);
        }
        $validatedData['picture'] = $request->file('picture')->store('pictures', 'public');
    }

    $member->update($validatedData);

    return redirect()->route('members.index')->with('success', 'Member updated successfully.');
}

    // Show the form to edit a member
    public function edit($id)
    { $groups = Group::all(); // Fetch all groups
        $member = Member::findOrFail($id);
        return view('dashboard.members.edit', compact('member', 'groups'));
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
            'first_name' => 'nullable|string|max:255|unique:members,first_name,' . $id . ',id,is_draft,false',
            'middle_name' => 'nullable|string|max:255',
            'nick_name' => 'nullable|string|max:255',
            'picture' => 'nullable|image|max:2048',
            'gender' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'group_id' => 'nullable|int|max:255',
            'baptism_date' => 'nullable|date',
            'member_status' => 'nullable|string|max:50',
'full_address' => 'required|string|max:255|unique:members,full_address,' . $id . ',id,is_draft,false',
            'city' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:members,email,' . $id . ',id,is_draft,false',
            'phone_number' => 'nullable|string|max:50',
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
            'group_id' => 'nullable|int|max:255',
            'baptism_date' => 'nullable|date',
            'member_status' => 'nullable|string|max:50',
            'full_address' => 'nullable|string|max:255'. $id . ',id,is_draft,false',
            'city' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:members,email,' . $id . ',id,is_draft,true',
            'phone_number' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
        ]);
    }

    public function export()
    {
        return Excel::download(new MembersExport, 'members.xlsx');
    }
}
