<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::latest()->paginate(10);
        return view('admin.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:50',
        ]);

        Feature::create([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.features.index')
            ->with('success', 'Feature created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:50',
        ]);

        $feature->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.features.index')
            ->with('success', 'Feature updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();

        return redirect()->route('admin.features.index')
            ->with('success', 'Feature deleted successfully.');
    }
}
