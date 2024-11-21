<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        $pageData = [
            'title' => 'All Blogs',
            'pageName' => 'All Blogs',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item active">All Blogs</li>',
            'blogs' => $blogs,
        ];

        return view('pages.admin.blog.index')->with($pageData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageData = [
            'title' => 'Create Blog',
            'pageName' => 'Create Blog',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('blogs.index') . '">Blogs</a></li>
                              <li class="breadcrumb-item active">Create</li>',
        ];

        return view('pages.admin.blog.form')->with($pageData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Max size 2MB
        ]);

        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $currentDate = Carbon::now()->format('Y-m-d_H-i-s'); // Format as: 2024-11-15_14-25-30
            $fileName = $currentDate . '_' . $originalFileName;
            $imagePath = $request->file('image')->storeAs('blog_images', $fileName, 'public');
        } 

        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->author = $request->input('author');
        $blog->date = $request->input('date');
        $blog->category = $request->input('category');
        $blog->description = $request->input('description');
        $blog->image = $imagePath ?? null;
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // This can be implemented if you need a detailed view for individual blog posts
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        $pageData = [
            'title' => 'Edit Blog',
            'pageName' => 'Edit Blog',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('blogs.index') . '">Blogs</a></li>
                              <li class="breadcrumb-item active">Edit</li>',
            'blog' => $blog,
        ];

        return view('pages.admin.blog.form')->with($pageData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Max size 2MB
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title = $request->input('title');
        $blog->author = $request->input('author');
        $blog->date = $request->input('date');
        $blog->category = $request->input('category');
        $blog->description = $request->input('description');

        if ($request->hasFile('image')) {
            $imageName = uniqid('blog_', true) . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('blog_images', $imageName, 'public');
            $blog->image = $imagePath;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        
        // Delete the image from storage if it exists
        if ($blog->image && Storage::exists('public/' . $blog->image)) {
            Storage::delete('public/' . $blog->image);
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }

    /**
     * Search and return data for DataTables.
     */
    public function search(Request $request)
    {
        $data = Blog::query();

        return DataTables::of($data)
        ->addColumn('id', function ($row) {
            return $row->id;
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
            ->addColumn('date', function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->orderColumn('date', function ($query, $order) {
                $query->orderBy('date', $order)->orderBy('id', $order);
            })
            ->addColumn('category', function ($row) {
                return $row->category;
            })
            ->addColumn('image', function ($row) {
                return '<img src="' . asset('storage/' . $row->image) . '" width="100" alt="Blog Image">';
            })
            ->addColumn('description', function ($row) {
                return $row->description;
            })
            ->addColumn('actions', function ($row) {
                return '
                    <a href="' . route('blogs.edit', $row->id) . '" title="Edit Blog">
                        <i class="fas fa-edit  text-info font-18"></i>
                    </a>
                    &nbsp;&nbsp
                    <a href="' . route('blogs.destroy', $row->id) . '" title="Delete" >  <i class="fa fa-trash text-danger font-18"></i></a>
                ';
            })
            ->rawColumns(['image', 'actions'])
            ->toJson();
    }
}
