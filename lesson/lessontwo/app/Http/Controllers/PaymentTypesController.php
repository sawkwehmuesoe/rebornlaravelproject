<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\PaymentType;
use App\Models\Status;

class PaymentTypesController extends Controller
{
    public function index(Request $request)
    {
        $statusfilter = $request->input('statusfilter');
        $namefilter = $request['namefilter'];

        $query = PaymentType::query();

        if($statusfilter){
            $query->where('status_id',$statusfilter);
        }

        if($namefilter){
            $query->where('name','like','%'.$namefilter.'%');
        }

        $paymenttypes = $query->paginate(5)->appends($request->except('page'));
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

        $request->validate([
            'name'=>'required|unique:payment_types,name',
            'status_id'=>'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        
        $paymenttype = new PaymentType();
        $paymenttype->name = $request['name'];
        $paymenttype->slug = Str::slug($request['name']);
        $paymenttype->status_id = $request['status_id'];
        $paymenttype->user_id = $user_id;
        

        $paymenttype->save();

        session()->flash("success","New PaymentType Created");
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
        $request->validate([
            'name'=>'required|unique:payment_types,name',
            'status_id'=>'required|in:3,4'
        ]);
        
        $user = Auth::user();       
        $user_id = $user->id;

        $paymenttype = PaymentType::findOrFail($id);
        $paymenttype->name = $request['name'];
        $paymenttype->slug = Str::slug($request['name']);
        $paymenttype->status_id = $request['status_id'];
        $paymenttype->user_id = $user_id;
    
        $paymenttype->save();

        session()->flash("success","Update Successfully");
        return redirect(route('paymenttypes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymenttype = PaymentType::findOrFail($id);
        $paymenttype->delete();

        session()->flash("info","Delete Successfully");
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            PaymentType::whereIn('id',$getselectedids)->delete();
            return Response::json(["success"=>"Selected data have been deleted successfully."]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return Response::json(["status"=>"Failed","message"=>$e->getMessage()]);
        }
    }
}
