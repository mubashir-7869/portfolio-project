<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatWeDo;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class WhatWeDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = WhatWeDo::all();
        $pageData = array(
            'title' => 'What We Do',
            'pageName' => 'What We Do',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item active">What We Do</li>',
            'data' => $data,
        );

        return view('pages.admin.what_we_do.index')->with($pageData);
    }

    /**
     * Fetch data for DataTables.
     */
    public function search(Request $request)
    {
        $data = WhatWeDo::query();

        return DataTables::of($data)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('icon', function ($row) {
                return '<i data-feather='. $row->icon .'></i>';
            })
            ->addColumn('title', function ($row) {
                return $row->title;
            })
            ->orderColumn('title', function ($query, $order) {
                $query->orderBy('title', $order)->orderBy('id', $order);
            })
            ->filterColumn('title', function ($query, $keyword) {
                $query->where('title', 'like', "%$keyword%");
            })
            ->addColumn('description', function ($row) {
                return $row->description;
            })
            ->addColumn('actions', function ($row) {
                $btn = '<div class="btn-group">
                <a href="' . route('whatwedo.edit', $row['id']) . '" title="Edit" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                &nbsp &nbsp
                <a href="' . route('whatwedo.destroy', $row->id) . '" title="Delete" >  <i class="fa fa-trash text-danger font-18"></i></a>

                </div>';
                return $btn;
            })
            ->rawColumns(['icon', 'actions'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageData = array(
            'title' => 'Create What We Do',
            'pageName' => 'Create What We Do',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('whatwedo.index') . '">What We Do</a></li>
                              <li class="breadcrumb-item active">Create</li>',
        );
        return view('pages.admin.what_we_do.form')->with($pageData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'icon' => 'required|string|max:255',
        ]);

        $whatWeDo = new WhatWeDo;
        $whatWeDo->title = $request->input('title');
        $whatWeDo->description = $request->input('description');
        $whatWeDo->icon = $request->input('icon');
        $whatWeDo->save();

        return redirect()->route('whatwedo.index')->with('success', 'What We Do created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $whatWeDo = WhatWeDo::findOrFail($id);
        $pageData = array(
            'title' => 'Edit What We Do',
            'pageName' => 'Edit What We Do',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('whatwedo.index') . '">What We Do</a></li>
                              <li class="breadcrumb-item active">Edit</li>',
            'whatWeDo' => $whatWeDo,
        );

        return view('pages.admin.what_we_do.form')->with($pageData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'icon' => 'required|string|max:255',
        ]);

        $whatWeDo = WhatWeDo::findOrFail($id);
        $whatWeDo->title = $request->input('title');
        $whatWeDo->description = $request->input('description');
        $whatWeDo->icon = $request->input('icon');
        $whatWeDo->save();

        return redirect()->route('whatwedo.index')->with('success', 'What We Do updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $whatWeDo = WhatWeDo::findOrFail($id);
        $whatWeDo->delete();

        return redirect()->route('whatwedo.index')->with('success', 'What We Do deleted successfully!');
    }
}