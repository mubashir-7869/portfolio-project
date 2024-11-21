<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FunFact;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class FunFactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funfacts = FunFact::all();
        $pageData = [
            'title' => 'All Fun Facts',
            'pageName' => 'All Fun Facts',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item active">All Fun Facts</li>',
            'funfacts' => $funfacts,
        ];

        return view('pages.admin.funfact.index')->with($pageData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageData = [
            'title' => 'Create Fun Fact',
            'pageName' => 'Create Fun Fact',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('funfacts.index') . '">Fun Facts</a></li>
                              <li class="breadcrumb-item active">Create</li>',
        ];

        return view('pages.admin.funfact.form')->with($pageData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'count' => 'required|integer|min:0',
        ]);

        $funfact = new FunFact();
        $funfact->label = $request->input('label');
        $funfact->count = $request->input('count');
        $funfact->save();

        return redirect()->route('funfacts.index')->with('success', 'Fun Fact created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Optional: implement if you need to show a specific fun fact
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $funfact = FunFact::findOrFail($id);
        $pageData = [
            'title' => 'Edit Fun Fact',
            'pageName' => 'Edit Fun Fact',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="' . route('funfacts.index') . '">Fun Facts</a></li>
                              <li class="breadcrumb-item active">Edit</li>',
            'funfact' => $funfact,
        ];

        return view('pages.admin.funfact.form')->with($pageData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'count' => 'required|integer|min:0',
        ]);

        $funfact = FunFact::findOrFail($id);
        $funfact->label = $request->input('label');
        $funfact->count = $request->input('count');
        $funfact->save();

        return redirect()->route('funfacts.index')->with('success', 'Fun Fact updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $funfact = FunFact::findOrFail($id);
        $funfact->delete();

        return redirect()->route('funfacts.index')->with('success', 'Fun Fact deleted successfully!');
    }

    /**
     * Search and return data for DataTables.
     */
    public function search(Request $request)
    {
        $data = FunFact::query();

        return DataTables::of($data)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('label', function ($row) {
                return $row->label;
            })
            ->orderColumn('label', function ($query, $order) {
                $query->orderBy('label', $order)->orderBy('id', $order);
            })
            ->filterColumn('label', function ($query, $keyword) {
                $query->where('label', 'like', "%$keyword%");
            })
            ->addColumn('count', function ($row) {
                return $row->count;
            })
            ->addColumn('actions', function ($row) {
                return '
                    <a href="' . route('funfacts.edit', $row->id) . '" title="Edit Fun Fact">
                        <i class="fas fa-edit text-info font-18"></i>
                    </a>
                    &nbsp;&nbsp;
                    <a href="' . route('funfacts.destroy', $row->id) . '" title="Delete">
                        <i class="fa fa-trash text-danger font-18"></i>
                    </a>
                ';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}