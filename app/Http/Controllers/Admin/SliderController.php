<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        $pageData = array(
            'title' => 'Home Page Slider',
            'pageName' => 'Home Page Slider',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item active">Home Page Slider</li>',
            'sliders'=> $sliders,
        );

        return view('pages.admin.home.index')->with($pageData);

    }

    public function search(Request $request)
    {
        $data = Slider::query();

        return DataTables::of($data)
        ->addColumn('id', function ($row) {
            return $row->id;
        })
        ->addColumn('slide_subtitle', function ($row) {
            return $row->slide_subtitle;
        })
        ->orderColumn('slide_subtitle', function ($query, $order) {
            $query->orderBy('slide_subtitle', $order)->orderBy('id', $order);
        })
        ->filterColumn('slide_subtitle', function ($query, $keyword) {
            $query->where('slide_subtitle', 'like', "%$keyword%");
        })
        ->addColumn('slide_title', function ($row) {
            return $row->slide_title;
        })
        ->orderColumn('slide_title', function ($query, $order) {
            $query->orderBy('slide_title', $order)->orderBy('id', $order);
        })
        ->filterColumn('slide_title', function ($query, $keyword) {
            $query->where('slide_title', 'like', "%$keyword%");
        })
        ->addColumn('slide_description', function ($row) {
            return $row->slide_description;
        })
        ->orderColumn('slide_description', function ($query, $order) {
            $query->orderBy('slide_description', $order)->orderBy('id', $order);
        })
        ->addColumn('button_name', function ($row) {
            return $row->button_name;
        })
        ->orderColumn('button_name', function ($query, $order) {
            $query->orderBy('button_name', $order)->orderBy('id', $order);
        })
        ->filterColumn('button_name', function ($query, $keyword) {
            $query->where('button_name', 'like', "%$keyword%");
        })
        ->addColumn('button_link', function ($row) {
            return $row->button_link;
        })
        ->orderColumn('button_link', function ($query, $order) {
            $query->orderBy('button_link', $order)->orderBy('id', $order);
        })
        ->addColumn('image', function ($row) {
            return $row->slide_image ? '<img src="' . asset('storage/' . $row->slide_image) . '" width="80">' : 'No Image';
        })
        ->addColumn('actions', function ($row) {
            $btn = '<div class="btn-group">
            <a href="'.route('slider.edit',$row['id']).'" title="Edit" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
            &nbsp &nbsp
            <a href="' . route('slider.destroy', $row->id) . '" title="Delete" >  <i class="fa fa-trash text-danger font-18"></i></a>

            </div>';
            return $btn;
        })
        ->rawColumns(['actions','image'])
        ->toJson();

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageData = array(
            'title' => 'Create Home Page Slider',
            'pageName' => 'Create Home Page Slider',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('slider.index') . '">Home Page Slider</a></li>
                              <li class="breadcrumb-item active">Create</li>',
        );
        return view('pages.admin.home.form')->with($pageData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', 
            'slideTitle' => 'required|string|max:255',
            'slideSubtitle' => 'required|string|max:255',
            'slideDescription' => 'required|string|max:1000',
            'buttonName' => 'nullable|string|max:255',
            'buttonLink' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $currentDate = Carbon::now()->format('Y-m-d_H-i-s'); 
            $fileName = $currentDate . '_' . $originalFileName;
            $imagePath = $request->file('image')->storeAs('slider_images', $fileName, 'public');
        }
        // dd($imagePath);

        $slider = new Slider;
        $slider->slide_title = $request->input('slideTitle');
        $slider->slide_subtitle = $request->input('slideSubtitle');
        $slider->slide_description = $request->input('slideDescription');
        $slider->button_name = $request->input('buttonName');
        $slider->button_link = $request->input('buttonLink');
        $slider->slide_image = $imagePath;
        $slider->save();

        return redirect()->back()->with('success', 'Slider created successfully!');
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
        $slider = Slider::findOrFail($id);
        $pageData = array(
            'title' => 'Edit Home Page Slider',
            'pageName' => 'Edit Home Page Slider',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('slider.index') . '">Home Page Slider</a></li>
                              <li class="breadcrumb-item active">Edit</li>',
            'slider'=>$slider,
        );
        return view('pages.admin.home.form')->with($pageData);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'slideSubtitle' => 'required|string|max:255',
            'slideTitle' => 'required|string|max:255',
            'slideDescription' => 'required|string',
            'buttonName' => 'nullable|string|max:255',
            'buttonLink' => 'nullable|url',
        ]);

        $slider = Slider::findOrFail($id);
        $slider->slide_title = $request->input('slideTitle');
        $slider->slide_subtitle = $request->input('slideSubtitle');
        $slider->slide_description = $request->input('slideDescription');
        $slider->button_name = $request->input('buttonName');
        $slider->button_link = $request->input('buttonLink');
        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'Slider deleted successfully!');
    }
}
