<?php
namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AssetsExport;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssettrackingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $assets = Asset::where('church_name', auth()->user()->church_name) // Filter by church_name
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                          ->orWhere('asset_id', 'like', "%$search%")
                          ->orWhere('category', 'like', "%$search%");
                });
            })->paginate(10);
    
        return view('dashboard.assetstracking.list', compact('assets'));
    }
    

    public function export()
    {
        return Excel::download(new AssetsExport, 'assets.xlsx');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'asset_id' => 'required|string|unique:assets',
        'category' => 'required|string|max:255',
        'stock' => 'required',
        'price' => 'required|numeric',
        'status' => 'required|string|in:Active,Inactive,Scheduled,Draft',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('assets', 'public');
    }

    $validated['church_name'] = auth()->user()->church_name; // Attach church_name

    Asset::create($validated);

    return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
}

    

    public function edit(Asset $asset)
    {
        return view('assets.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'asset_id' => 'required|string|unique:assets', // Correct name
            'category' => 'required|string|max:255',
            'stock'=> 'required',
            'price' => 'required|numeric',
            'status' => 'required|string|in:Active,Inactive,Scheduled,Draft',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
    
    

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('assets', 'public');
        }

        $asset->update($validated);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
}
