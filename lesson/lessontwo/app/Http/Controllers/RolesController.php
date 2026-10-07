<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RolesController extends Controller
{
    public function index(){

        $roles = Role::all();
        $statuses = Status::whereIn('id',[3,4])->get();  
        return view('roles.index',compact('roles','statuses'));

    }

    public function create(){
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('roles.create',compact('statuses'));  
    }

    public function store(Request $request){
        $user = Auth::user();
        $user_id = $user->id;

        $role = new Role();
        $role->name = $request['name'];
        $role->slug = Str::slug($request['name']);
        $role->status_id = $request['status_id'];
        $role->user_id = $user_id;

        // Single Image Upload 

        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);
            $imagenewname = uniqid($user_id).$user_id.$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/roles/'),$imagenewname);

            $filepath = 'assets/img/roles/'.$imagenewname;
            $role->image = $filepath;
        }
  
        $role->save();

        return redirect(route('roles.index'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $role = Role::findOrfail($id);
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('roles.edit')->with('role',$role)->with('statuses',$statuses);
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $role = Role::findOrFail($id);
        $role->name = $request['name'];
        $role->slug = Str::slug($request['name']);
        $role->status_id = $request['status_id'];
        $role->user_id = $user_id;

        if($request->hasFile('image')){
            $path = $role->image;

            if(File::exists($path)){
                File::delete($path);
            }
        }

        // Single Image Upload 

        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);
            $imagenewname = uniqid($user_id).$user_id.$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/roles/'),$imagenewname);

            $filepath = 'assets/img/roles/'.$imagenewname;
            $role->image = $filepath;
        }

        $role->save();

        return redirect(route('roles.index'));
    }

    public function destroy(string $id){
        $role = Role::findOrFail($id);

        $path = $role->image;

        if(File::exists($path)){
            File::delete($path);
        }

        $role->delete();

        return redirect()->back();
    }
}
