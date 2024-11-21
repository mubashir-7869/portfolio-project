<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SocialLink; 
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialLinks = SocialLink::all();  // Fetch all social links
        $pageData = array(
            'title' => 'Social Media Links',
            'pageName' => 'Social Media Links',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item active">Social Media Links</li>',
            'socialLinks' => $socialLinks,  // Passing the data to the view
        );

        return view('pages.admin.social-links.index')->with($pageData);
    }

    /**
     * Handle the AJAX request for searching and displaying data in DataTable.
     */
    public function search(Request $request)
    {
        $data = SocialLink::query();

        return DataTables::of($data)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('icon', function ($row) {
                return '<i class="fa fa-facebook"></i>';
            })
            ->addColumn('link', function ($row) {
                $link = '<a href="' . $row->link . '" target="_blank">' . $row->link . '</a>';
                return  $link;
            })
            ->addColumn('actions', function ($row) {
                $btn = '<div class="btn-group">
                <a href="' . route('social-links.edit', $row->id) . '" title="Edit" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                &nbsp &nbsp
                <a href="' . route('social-links.destroy', $row->id) . '" title="Delete"><i class="fa fa-trash text-danger font-18"></i></a>
                </div>';
                return $btn;
            })
            ->rawColumns(['icon', 'link','actions'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageData = array(
            'title' => 'Create Social Media Link',
            'pageName' => 'Create Social Media Link',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('social-links.index') . '">Social Media Links</a></li>
                              <li class="breadcrumb-item active">Create</li>',
        );
        return view('pages.admin.social-links.form')->with($pageData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'string|max:255',
            'link' => 'string|max:255',
        ]);

        $socialLink = new SocialLink;
        $socialLink->icon = $request->input('icon');
        $socialLink->link = $request->input('link');
        $socialLink->save();

        return redirect()->route('social-links.index')->with('success', 'Social Media Link created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $pageData = array(
            'title' => 'Edit Social Media Link',
            'pageName' => 'Edit Social Media Link',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('social-links.index') . '">Social Media Links</a></li>
                              <li class="breadcrumb-item active">Edit</li>',
            'socialLinks' => $socialLink,  // Passing the existing social link to the form
        );
        return view('pages.admin.social-links.form')->with($pageData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'icon' => 'string|max:255',
            'link' => 'string|max:255',
        ]);

        $socialLink = SocialLink::findOrFail($id);
        $socialLink->icon = $request->input('icon');
        $socialLink->link = $request->input('link');
        $socialLink->save();

        return redirect()->route('social-links.index')->with('success', 'Social Media Link updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->delete();
        return redirect()->route('social-links.index')->with('success', 'Social Media Link deleted successfully!');
    }
}
