<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Religion;
use App\Models\Status;

class ReligionsController extends Controller
{
    public function index()
    {
        $religions = Religion::all();
        $statuses = Status::whereIn('id',[3,4])->get();     
        return view('religions.index',compact('religions','statuses'));
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
        
        $religion = new Religion();
        $religion->name = $request['name'];
        $religion->slug = Str::slug($request['name']);
        $religion->status_id = $request['status_id'];
        $religion->user_id = $user_id;
        

        $religion->save();

        return redirect(route('religions.index'));
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

        $religion = Religion::findOrFail($id);
        $religion->name = $request['name'];
        $religion->slug = Str::slug($request['name']);
        $religion->status_id = $request['status_id'];
        $religion->user_id = $user_id;
    
        $religion->save();

        return redirect(route('religions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $religion = Religion::findOrFail($id);
        $religion->delete();

        return redirect()->back();
    }
}
