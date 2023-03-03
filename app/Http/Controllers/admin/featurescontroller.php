<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class featurescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = feature::with('title', 'type','icon','content')->orderByDesc('id')->paginate(10);

        return view('admin.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $features = feature::select('title', 'type', 'icon','content')->get();
        return view('admin.features.create', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

        d
        // Validate Data
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'icon' => 'required',
        ]);

        // Upload Images
        $icon_name = null;
        if($request->hasFile('icon')) {
            $ico = $request->file('icon');
            $icon_name = rand(). time().$ico->getClientOriginalName();
            $ico->move(public_path('uploads/features'), $icon_name);
        }

        // Store To Database
        feature::create([
            'title' => $request->title,
            'type' => $request->type,
            'icon' => $icon_name,
            'content' => $request->content,
        ]);

        // Redirect
        return redirect()->route('admin.features.index')->with('msg', 'feature added successfully')->with('type', 'success');
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
        $feat = feature::findOrFail($id);
        $features = feature::select('title', 'type', 'icon','content')->where('id', '!=', $feat->id)->get();

        return view('admin.features.edit', compact('feat', 'features'));
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
            'type' => 'required',
            'icon' => 'required',
            'content'=>'required',
        ]);

        $feat = feature::findOrFail($id);

        // Upload Images
        $icon_name = $feat->icon;
        if($request->hasFile('icon')) {
            $ico = $request->file('icon');
            $icon_name = rand(). time().$ico->getClientOriginalName();
            $ico->move(public_path('uploads/feature'), $icon_name);
        }

        // Store To Database
        $feat->update([
            'title' => $request->title,
            'type' => $request->type,
            'icon' => $icon_name,
            'content' => $request->content,
        ]);

        // Redirect
        return redirect()->route('admin.features.index')->with('msg', 'feature updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feat = feature::findOrFail($id);

        File::delete(public_path('uploads/feature/'.$feat->icon));
        $feat->delete();

        return redirect()->route('admin.features.index')->with('msg', 'feature deleted successfully')->with('type', 'danger');
    }

    public function trash()
    {
        $features = feature::onlyTrashed()->orderByDesc('id')->paginate(10);

        return view('admin.features.trash', compact('features'));
    }

    public function restore($id)
    { feature::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.features.index')->with('msg', 'feature restored successfully')->with('type', 'warning');
    }

    public function forcedelete($id)
    {
        feature::onlyTrashed()->find($id)->forcedelete();

        return redirect()->route('admin.features.index')->with('msg', 'feature deleted permanintly successfully')->with('type', 'danger');
    }
}
