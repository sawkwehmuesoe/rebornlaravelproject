<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RolesController extends Controller
{
    public function index(){

        $roles = Role::all();
        return view('roles.index',compact("roles"));

    }

    public function create(){

    }

    public function store(Request $request){
        $user = Auth::user();
        $user_id = $user->id;

        $role = new Role();
        $role->name = $request['name'];
        $role->slug = Str::slug($request['name']);
        $role->status_id = $request['status_id'];
        $role->user_id = $user_id;

        $role->save();

        return redirect(route('roles.index'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
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

        $role->save();

        return redirect(route('roles.index'));
    }

    public function delete(string $id){
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->back();
    }
}
