<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $pageData = array(
            'title' => 'Contact Us ',
            'pageName' => 'Contact Us Page',
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . route('dashboard') . '">Dashboard</a></li>
                              <li class="breadcrumb-item active">Contact Us Messages</li>',
        );

        return view('pages.admin.contact.index')->with($pageData);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Save the message to the database
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->status = 'pending';
        $contact->save();

        return response()->json(['status' => 'success','message' => 'Your message has been sent successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        $data = Contact::query();
    
        if($request->has('date') && !empty($request->date)){
            $data = $data->whereDate('created_at',$request->date);
        }
        
        return DataTables::of($data)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->orderColumn('name', function ($query, $order) {
                $query->orderBy('name', $order)->orderBy('id', $order);
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            
            ->addColumn('message', function ($row) {
                return $row->message;
            })
            
            ->addColumn('status', function ($row) {
                // You can customize this based on the status column in your database
                return $row->status === 'reviewed' 
                    ? '<span class="badge bg-success">Reviewed</span>' 
                    : '<span class="badge bg-warning">Pending</span>';
            })
          
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y');
            })
            ->orderColumn('created_at', function ($query, $order) {
                $query->orderBy('created_at', $order)->orderBy('id', $order);
            })
            ->addColumn('actions', function ($row) {
                $btn = '<div class="btn-group">
                            <a href="'.route('contact.review', $row->id).'" title="Reviewed" class="mr-2"><i class="fa fa-check-double text-info font-18"></i></a>
                            &nbsp;&nbsp;
                            <a href="'.route('contact.destroy', $row->id).'" title="Delete"><i class="fa fa-trash text-danger font-18"></i></a>
                        </div>';
                return $btn;
            })
            ->rawColumns(['message', 'status', 'actions']) // Make the message, status, and actions columns raw HTML
            ->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function markAsReviewed($id)
    {
        $message = Contact::findOrFail($id);
        $message->status = 'reviewed';  // Assuming you have a 'status' column
        $message->save();
    
        return redirect()->route('contact.index')->with('success', 'Message marked as reviewed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contact.index')->with('success', 'Message deleted successfully!');
    }
}
