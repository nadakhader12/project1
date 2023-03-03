<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class projectscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = project::orderByDesc('id')->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = project::all();
        return view('admin.projects.create');
    }
    public function store(Request $request)
    {
         // Validate Data
         $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'required',
            'client' => 'required',
            'category' => 'required',
            'feature_id' => 'required',
        ]);
// Upload Images
        $image_name = null;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = rand(). time().$image->getClientOriginalName();
            $image->move(public_path('uploads/project'), $image_name);
        }

        // Store To Database
        project::create([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $image_name,
            'client' => $request->client,
            'category' => $request->category,
            'feature_id' => $request->feature_id,
        ]);

        // Redirect
        return redirect()->route('admin.projects.index')->with('msg', 'project added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = project::findOrFail($id);
        $projects = project::all();

        return view('admin.projects.edit', compact('project', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Data
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'required',
            'client' => 'required',
            'category' => 'required',
            'feature_id' => 'required',
        ]);

        $project = project::findOrFail($id);

        // Upload Images
        $image_name = $project->image;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = rand(). time().$image->getClientOriginalName();
            $image->move(public_path('uploads/projects'), $image_name);
        }

        // Store To Database
        $project->update([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $image_name,
            'client' => $request->client,
            'category' => $request->category,
            'feature_id' => $request->feature_id,

        ]);

        // Redirect
        return redirect()->route('admin.projects.index')->with('msg', 'project updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = project::findOrFail($id);

        File::delete(public_path('uploads/features/'.$project->image));


        $project->delete();

        return redirect()->route('admin.projects.index')->with('msg', 'project deleted successfully')->with('type', 'danger');
    }

    public function trash()
    {
        $projects = project::onlyTrashed()->orderByDesc('id')->paginate(10);

        return view('admin.projects.trash', compact('projects'));
    }

    public function restore($id)
    {
        // feature::onlyTrashed()->find($id)->update(['deleted_at' => null]);
        project::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.projects.index')->with('msg', 'project restored successfully')->with('type', 'warning');
    }

    public function forcedelete($id)
    {
        project::onlyTrashed()->find($id)->forcedelete();

        return redirect()->route('admin.projects.index')->with('msg', 'project deleted permanintly successfully')->with('type', 'danger');
    }
}
