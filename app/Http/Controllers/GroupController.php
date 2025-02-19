<?php
namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GroupsExport;

class GroupController extends Controller
{
    public function export()
    {
        return Excel::download(new GroupsExport, 'groups.xlsx');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
    
        $groups = Group::withCount('members')
            ->where('church_name', auth()->user()->church_name) // Filter by church_name
            ->where('user_id', auth()->id()) // Ensure the user owns the groups
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })->paginate(10);
    
        return view('dashboard.groups.list', compact('groups'));
    }
    

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|max:255',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string',
    ]);

    $validated['user_id'] = auth()->id();
    $validated['church_name'] = auth()->user()->church_name; // Attach church_name

    if ($request->hasFile('picture')) {
        $validated['picture'] = $request->file('picture')->store('group_pictures', 'public');
    }

    Group::create($validated);

    return redirect()->route('groups.index')->with('success', 'Group created successfully.');
}


    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        // Make sure the user is updating their own group
        if ($group->user_id !== auth()->id()) {
            return redirect()->route('groups.index')->with('error', 'Unauthorized action');
        }

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('group_pictures', 'public');
        }

        $group->update($data);

        return redirect()->route('groups.index')->with('success', 'Group updated successfully.');
    }

 public function destroy(Group $group)
    {
        // Make sure the user is deleting their own group
        if ($group->user_id !== auth()->id()) {
            return redirect()->route('groups.index')->with('error', 'Unauthorized action');
        }
        if ($group->picture) {
            \storage_path()::delete('public/' . $group->picture);
        }

        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group deleted successfully.');
    }
}
