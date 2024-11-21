<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        $pageData = array(
            'title' => 'Services',
            'pageName' => 'Services',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item active">Services</li>',
            'services' => $services,
        );

        return view('pages.admin.services.index')->with($pageData);
    }

    /**
     * Search method for DataTables.
     */
    public function search(Request $request)
    {
        $data = Service::query();

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
            ->addColumn('description', function ($row) {
                return $row->description;
            })
            ->addColumn('first_btn_name', function ($row) {
                return $row->first_btn_name;
            })

            ->addColumn('first_btn_link', function ($row) {
                return $row->first_btn_link;
            })

            ->addColumn('second_btn_name', function ($row) {
                return $row->second_btn_name;
            })

            ->addColumn('second_btn_link', function ($row) {
                return $row->second_btn_link;
            })

            ->addColumn('right_image_url', function ($row) {
                return '<img src="' . asset('storage/' . $row->right_image_url) . '" alt="Right Image" style="max-width: 100px; height: auto;">';
            })
            ->addColumn('actions', function ($row) {
                $btn = '<div class="btn-group">
                <a href="' . route('services.edit', $row->id) . '" title="Edit" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                &nbsp &nbsp
                <a href="' . route('services.destroy', $row->id) . '" title="Delete" >  <i class="fa fa-trash text-danger font-18"></i></a>

            </div>';
                return $btn;
            })
            ->rawColumns(['actions', 'right_image_url'])
            ->toJson();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageData = array(
            'title' => 'Create Service',
            'pageName' => 'Create Service',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('services.index') . '">Services</a></li>
                              <li class="breadcrumb-item active">Create</li>',
        );
        return view('pages.admin.services.form')->with($pageData);
    }

    // Store a new service
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'first_btn_name' => 'required|string',
            'first_btn_link' => 'required|string',
            'second_btn_name' => 'required|string',
            'second_btn_link' => 'required|string',
            'right_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for the image
        ]);

        if ($request->hasFile('right_image')) {
            $originalFileName = $request->file('right_image')->getClientOriginalName();
            $currentDate = Carbon::now()->format('Y-m-d_H-i-s'); // Format as: 2024-11-15_14-25-30
            $fileName = $currentDate . '_' . $originalFileName;
            $imagePath = $request->file('right_image')->storeAs('services', $fileName, 'public');
        }
        $service = new Service();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->first_btn_name = $request->first_btn_name;
        $service->first_btn_link = $request->first_btn_link;
        $service->second_btn_name = $request->second_btn_name;
        $service->second_btn_link = $request->second_btn_link;
        $service->right_image_url = $imagePath ?? null;
        $service->save();

        return redirect()->route('services.index')->with('success', 'Content created successfully!');
    }

    // Show form to edit an existing service
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $pageData = array(
            'title' => 'Edit Service',
            'pageName' => 'Edit Service',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('services.index') . '">Services</a></li>
                              <li class="breadcrumb-item active">Edit</li>',
            'service' => $service,
        );
        return view('pages.admin.services.form')->with($pageData);
    }

    // Update an existing service
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'first_btn_name' => 'required|string',
            'first_btn_link' => 'required|string',
            'second_btn_name' => 'required|string',
            'second_btn_link' => 'required|string',
            'right_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for the image
        ]);

        if ($request->hasFile('right_image')) {
            $originalFileName = $request->file('right_image')->getClientOriginalName();
            $currentDate = Carbon::now()->format('Y-m-d_H-i-s'); // Format as: 2024-11-15_14-25-30
            $fileName = $currentDate . '_' . $originalFileName;
            $imagePath = $request->file('right_image')->storeAs('services', $fileName, 'public');
        }       
        $service = Service::findOrFail($id);
        $service->title = $request->title;
        $service->description = $request->description;
        $service->first_btn_name = $request->first_btn_name;
        $service->first_btn_link = $request->first_btn_link;
        $service->second_btn_name = $request->second_btn_name;
        $service->second_btn_link = $request->second_btn_link;
        if ($request->hasFile('right_image')) {
        $service->right_image_url = $imagePath ?? null;
        }
        $service->save();

        return redirect()->route('services.index')->with('success', 'Content updated successfully!');
    }

    // Delete a service
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Content deleted successfully!');
    }
}
