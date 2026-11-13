<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Stage;
use App\Models\Status;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class StagesController extends Controller
{
    public function index(Request $request)
    {
        
        $statusfilter = $request->input('statusfilter');
        $namefilter = $request['namefilter'];

        $query = Stage::query();

        if($statusfilter){
            $query->where('status_id',$statusfilter);
        }

        if($namefilter){
            $query->where('name','like','%'.$namefilter.'%');
        }

        $stages = $query->paginate(5)->appends($request->except('page'));
        $statuses = Status::whereIn('id',[3,4])->get();     
        return view('stages.index',compact('stages','statuses'));
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
            'name'=>'required|unique:stages,name',
            'status_id'=>'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        
        $stage = new Stage();
        $stage->name = $request['name'];
        $stage->slug = Str::slug($request['name']);
        $stage->status_id = $request['status_id'];
        $stage->user_id = $user_id;
        

        $stage->save();

        session()->flash("success","New Stage Created");
        return redirect(route('stages.index'));
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

        $stage = Stage::findOrFail($id);
        $stage->name = $request['name'];
        $stage->slug = Str::slug($request['name']);
        $stage->status_id = $request['status_id'];
        $stage->user_id = $user_id;
    
        $stage->save();
        session()->flash("success","Update Successfully");
        return redirect(route('stages.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stage = Stage::findOrFail($id);
        $stage->delete();

        session()->flash("info","Delete Successfully");
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Stage::whereIn('id',$getselectedids)->delete();
            return Response::json(["success"=>"Selected data have been deleted successfully."]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return Response::json(["status"=>"Failed","message"=>$e->getMessage()]);
        }
    }
}
