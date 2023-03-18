<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class projectscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = project::orderByDesc('id')->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = project::select('name', 'image', 'client','category','feature_id','content')->get();
        return view('admin.projects.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
        // Validate Data
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'client' => 'required',
            'category'=>'required',
            'feature_id'=>'required',
            'content' => 'required',
        ]);

        // Upload Images
        $image_name = null;
        if($request->hasFile('image')) {
            $img = $request->file('image');
            $image_name = rand(). time().$img->getClientOriginalName();
            $img->move(public_path('uploads/projects'), $image_name);
        }

        // Store To Database
        project::create([
            'name' => $request->name,
            'image' => $image_name,
            'client' => $request->client,
            'category' => $request->category,
            'feature_id' => $request->feature_id,
            'content' => $request->content,
        ]);

        // Redirect
        return redirect()->route('admin.projects.index')->with('msg', 'project added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pro = project::findOrFail($id);
        $projects = project::select('name', 'image', 'client','category','feature_id','content')->where('id', '!=', $pro->id)->get();

        return view('admin.projects.edit', compact('pro', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate Data
        $request->validate([

        'name' => 'required',
            'content' => 'required',
            'image' => 'required',
            'client' => 'required',
            'category' => 'required',
            'feature_id' => 'nullable|exists:features,id',
        ]);

        $pro = project::findOrFail($id);

        // Upload Images
        $icon_name = $pro->icon;
        if($request->hasFile('icon')) {
            $ico = $request->file('icon');
            $icon_name = rand(). time().$ico->getClientOriginalName();
            $ico->move(public_path('uploads/projects'), $icon_name);
        }

        // Store To Database
        $pro->update([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $request->image,
            'client' => $request->client,
            'category' => $request->category,
            'feature_id' => $request->feature_id,
        ]);

        // Redirect
        return redirect()->route('admin.projects.index')->with('msg', 'project updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pro = project::findOrFail($id);

        File::delete(public_path('uploads/projects/'.$pro->icon));
        $pro->delete();

        return redirect()->route('admin.projects.index')->with('msg', 'project deleted successfully')->with('type', 'danger');
    }

    public function trash()
    {
        $projects = project::onlyTrashed()->orderByDesc('id')->paginate(10);

        return view('admin.projects.trash', compact('projects'));
    }

    public function restore($id)
    { project::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.projects.index')->with('msg', 'project restored successfully')->with('type', 'warning');
    }

    public function forcedelete($id)
    {
        project::onlyTrashed()->find($id)->forcedelete();

        return redirect()->route('admin.projects.index')->with('msg', 'project deleted permanintly successfully')->with('type', 'danger');
    }
}
