<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Relative;
use App\Models\Status;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class RelativesController extends Controller
{
    public function index(Request $request)
    {
        $statusfilter = $request->input('statusfilter');
        $namefilter = $request['namefilter'];

        $query = Relative::query();

        if($statusfilter){
            $query->where('status_id',$statusfilter);
        }

        if($namefilter){
            $query->where('name','like','%'.$namefilter.'%');
        }

        $relatives = $query->paginate(5)->appends($request->except('page'));
        $statuses = Status::whereIn('id',[3,4])->get();     
        return view('relatives.index',compact('relatives','statuses'));
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
            'name'=>'required|unique:relatives,name',
            'status_id'=>'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        
        $relative = new Relative();
        $relative->name = $request['name'];
        $relative->slug = Str::slug($request['name']);
        $relative->status_id = $request['status_id'];
        $relative->user_id = $user_id;
        

        $relative->save();

        session()->flash("success","New Relative Created");
        return redirect(route('relatives.index'));
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

        $relative = Relative::findOrFail($id);
        $relative->name = $request['name'];
        $relative->slug = Str::slug($request['name']);
        $relative->status_id = $request['status_id'];
        $relative->user_id = $user_id;
    
        $relative->save();

        session()->flash("success","Update Successfully");
        return redirect(route('relatives.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $relative = Relative::findOrFail($id);
        $relative->delete();

        session()->flash("info","Delete Successfully");
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Relative::whereIn('id',$getselectedids)->delete();
            return Response::json(["success"=>"Selected data have been deleted successfully."]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return Response::json(["status"=>"Failed","message"=>$e->getMessage()]);
        }
    }
}
