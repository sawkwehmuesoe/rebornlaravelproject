<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\PaymentType;
use App\Models\Status;

class PaymentTypesController extends Controller
{
    public function index()
    {
        $paymenttypes = PaymentType::all();
        $statuses = Status::whereIn('id',[3,4])->get();     
        return view('paymenttypes.index',compact('paymenttypes','statuses'));
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
        $user = Auth::user();
        $user_id = $user->id;
        
        $paymenttype = new PaymentType();
        $paymenttype->name = $request['name'];
        $paymenttype->slug = Str::slug($request['name']);
        $paymenttype->status_id = $request['status_id'];
        $paymenttype->user_id = $user_id;
        

        $paymenttype->save();

        return redirect(route('paymenttypes.index'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();       
        $user_id = $user->id;

        $paymenttype = PaymentType::findOrFail($id);
        $paymenttype->name = $request['name'];
        $paymenttype->slug = Str::slug($request['name']);
        $paymenttype->status_id = $request['status_id'];
        $paymenttype->user_id = $user_id;
    
        $paymenttype->save();

        return redirect(route('paymenttypes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymenttype = PaymentType::findOrFail($id);
        $paymenttype->delete();

        return redirect()->back();
    }
}
