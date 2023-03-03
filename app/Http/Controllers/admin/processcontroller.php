<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class processController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = process::with('title', 'image','content')->orderByDesc('id')->paginate(10);

        return view('admin.process.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $processes = process::select( 'title', 'image','content')->get();
        return view('admin.process.create', compact('processes'));
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
            'title' => 'required',
            'image' => 'required',
            'content' => 'required',
        ]);

        // Upload Images
        $img_name = null;
        if($request->hasFile('image')) {
            $img = $request->file('image');
            $img_name = rand(). time().$img->getClientOriginalName();
            $img->move(public_path('uploads/process'), $img_name);
        }

        // Store To Database
        process::create([
            'title' => $request->title,
            'image' => $img_name,
            'content' => $request->content,
        ]);

        // Redirect
        return redirect()->route('admin.process.index')->with('msg', 'process added successfully')->with('type', 'success');
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
        $proces = process::findOrFail($id);
        $processes = process::select('title', 'image', 'content')->where( '!=', $ $proces->id)->get();

        return view('admin.process.edit', compact('proces', 'processes'));
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
            'title' => 'required',
            'image' => 'required',
            'content' => 'required',
        ]);

        $proces = process::findOrFail($id);

        // Upload Images
        $img_name = $proces->image;
        if($request->hasFile('image')) {
            $img = $request->file('image');
            $img_name = rand(). time().$img->getClientOriginalName();
            $img->move(public_path('uploads/process'), $img_name);
        }

        // Store To Database
        $proces->update([
            'title' => $request->title,
            'image' => $img_name,
            'content' => $request->content,
        ]);

        // Redirect
        return redirect()->route('admin.process.index')->with('msg', 'process updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proces = process::findOrFail($id);

        File::delete(public_path('uploads/process/'.$proces->image));

        $proces->delete();

        return redirect()->route('admin.process.index')->with('msg', 'process deleted successfully')->with('type', 'danger');
    }

    public function trash()
    {
        $processes = process::onlyTrashed()->orderByDesc('id')->paginate(10);

        return view('admin.process.trash', compact('processes'));
    }

    public function restore($id)
    {
        // Category::onlyTrashed()->find($id)->update(['deleted_at' => null]);
        process::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.process.index')->with('msg', 'process restored successfully')->with('type', 'warning');
    }

    public function forcedelete($id)
    {
        process::onlyTrashed()->find($id)->forcedelete();

        return redirect()->route('admin.process.index')->with('msg', 'process deleted permanintly successfully')->with('type', 'danger');
    }
}
