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
        $search = $request->get('search'); // Get the search term
    
        if ($search) {
            // If search term exists, filter the groups by name
            $groups = Group::where('name', 'like', '%' . $search . '%')->paginate(10);
        } else {
            // If no search term, retrieve all groups
            $groups = Group::paginate(10);
        }
    
        return view('dashboard.groups.list', compact('groups'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('group_pictures', 'public');
        }

        Group::create($data);

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
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('group_pictures', 'public');
        }

        $group->update($data);

        return redirect()->route('groups.index')->with('success', 'Group updated successfully.');
    }

    public function destroy(Group $group)
    {
        if ($group->picture) {
            \Storage::delete('public/' . $group->picture);
        }

        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group deleted successfully.');
    }
}
