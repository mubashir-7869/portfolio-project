<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $pageData = array(
            'title' => 'Portfolio Items',
            'pageName' => 'Portfolio Items',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item active">Portfolio Items</li>',
            'categories' => $categories,
        );

        return view('pages.admin.portfolio.index')->with($pageData);
    }

    /**
     * Handle the server-side processing for DataTable.
     */
    public function search(Request $request)
    {
        $data = Portfolio::query();

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
            ->addColumn('category_id', function ($row) {
                return ($row->category_id);
            })
            ->addColumn('image', function ($row) {
                return $row->image ? '<img src="' . asset('storage/' . $row->image) . '" width="80">' : 'No Image';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <a href="' . route('portfolio.edit', $row->id) . '" title="Edit" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                             &nbsp;&nbsp;
                            <a href="' . route('portfolio.destroy', $row->id) . '" title="Delete" >  <i class="fa fa-trash text-danger font-18"></i></a>
                        </div>';
            })
            ->rawColumns(['image', 'actions'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageData = array(
            'title' => 'Create Portfolio Item',
            'pageName' => 'Create Portfolio Item',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('portfolio.index') . '">Portfolio Items</a></li>
                              <li class="breadcrumb-item active">Create</li>',
        );
        return view('pages.admin.portfolio.form')->with($pageData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Max size 2MB
        ]);

        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $currentDate = Carbon::now()->format('Y-m-d_H-i-s'); // Format as: 2024-11-15_14-25-30
            $fileName = $currentDate . '_' . $originalFileName;
            $imagePath = $request->file('image')->storeAs('portfolio_images', $fileName, 'public');
        }
        // Handle image upload if exists

        // Create new portfolio item
        $portfolio = new Portfolio();
        $portfolio->title = $request->input('title');
        $portfolio->image = $imagePath ?? null;
        $portfolio->save();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $pageData = array(
            'title' => 'Edit Portfolio Item',
            'pageName' => 'Edit Portfolio Item',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('portfolio.index') . '">Portfolio Items</a></li>
                              <li class="breadcrumb-item active">Edit</li>',
            'portfolio' => $portfolio,
        );

        return view('pages.admin.portfolio.form')->with($pageData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Max size 2MB
        ]);

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->title = $request->input('title');
        // If new image is uploaded, store it
        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $currentDate = Carbon::now()->format('Y-m-d_H-i-s'); // Format as: 2024-11-15_14-25-30
            $fileName = $currentDate . '_' . $originalFileName;
            $imagePath = $request->file('image')->storeAs('portfolio_images', $fileName, 'public');
            $portfolio->image = $imagePath;
        }

        $portfolio->save();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        if ($portfolio->image) {
            Storage::disk('public')->delete('portfolio_images/' . $portfolio->image);
        }
        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item deleted successfully!');
    }

    public function updateCategory(Request $request){
        $id = $request->rowId; 
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->category_id = $request->categoryId; 
        $portfolio->save();
    }
}