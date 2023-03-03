<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\news;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class newscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = news::orderByDesc('id')->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news = news::all();
        return view('admin.news.create');
    }
    public function store(Request $request)
    {
         // Validate Data
         $request->validate([
            'title' => 'required',
            'content' => 'required',
            'date' => 'required',
            'image' => 'required',
        ]);
// Upload Images
        $image_name = null;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = rand(). time().$image->getClientOriginalName();
            $image->move(public_path('uploads/news'), $image_name);
        }

        // Store To Database
        news::create([
            'title' => $request->title,
            'content' => $request->content,
            'date' => $request->date,
            'image' => $image_name,
        ]);

        // Redirect
        return redirect()->route('admin.news.index')->with('msg', 'news added successfully')->with('type', 'success');
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
        $new = news::findOrFail($id);
        $news = news::all();

        return view('admin.news.edit', compact('new', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Data
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'date' => 'required',
            'image' => 'required',
        ]);

        $news = news::findOrFail($id);

        // Upload Images
        $image_name = $news->image;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = rand(). time().$image->getClientOriginalName();
            $image->move(public_path('uploads/news'), $image_name);
        }

        // Store To Database
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'date' => $request->date,
            'image' => $image_name,

        ]);

        // Redirect
        return redirect()->route('admin.news.index')->with('msg', 'new updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news= news::findOrFail($id);

        File::delete(public_path('uploads/news/'.$news->image));


        $news->delete();

        return redirect()->route('admin.news.index')->with('msg', 'new deleted successfully')->with('type', 'danger');
    }

    public function trash()
    {
        $news = news::onlyTrashed()->orderByDesc('id')->paginate(10);

        return view('admin.news.trash', compact('news'));
    }

    public function restore($id)
    {
        // feature::onlyTrashed()->find($id)->update(['deleted_at' => null]);
        news::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.news.index')->with('msg', 'news restored successfully')->with('type', 'warning');
    }

    public function forcedelete($id)
    {
        news::onlyTrashed()->find($id)->forcedelete();

        return redirect()->route('admin.news.index')->with('msg', 'new deleted permanintly successfully')->with('type', 'danger');
    }
}
