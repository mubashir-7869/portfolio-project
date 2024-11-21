<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('pages.admin.portfolio.index');
    }

    // Get the data for the DataTable (AJAX)
    public function search(Request $request)
    {
        $data = Category::query();

        return Datatables::of($data)
        ->editColumn('id', function ($row) {
            return $row->id;
        })
        ->addColumn('title', function ($row) {
            return $row->title;
        })
        ->addColumn('actions', function ($row) {
            return '
                <div class="btn-group" >
                   <a  href="#" id="create-category" title="Edit Category" data-url="'.route('category.edit', $row->id).'" data-ajax-popup="true" data-title="Edit Category" data-bs-toggle="tooltip"><i class="fa fa-edit text-info font-18"></i></a>
                    &nbsp;&nbsp;
                    <a href="' . route('category.destroy', $row->id) . '" title="Delete" >  <i class="fa fa-trash text-danger font-18"></i></a>

                </div>
            ';
        })
        ->rawColumns(['actions'])
        ->toJson();
    }

    // Show the form for creating a new category
    public function create()
    {
        $data = [
            "action" => "category/store",
            "row" => [],
            "method" => "POST",
        ];
        return view('pages.admin.portfolio.categories.form')->with($data);
    }

    // Store a newly created category in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->title = $request->title;
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    // Show the form for editing the specified category
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $data = [
            "action" => "category/update/".$id,
            "method" => "PUT",
            "category" => $category,
        ];
        return view('pages.admin.portfolio.categories.form')->with($data);
    }

    // Update the specified category in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $category = Category::findOrFail($id);
        $category->title = $request->title;
        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    // Remove the specified category from storage
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success' , 'Category deleted successfully.');
    }
}