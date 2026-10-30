<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use App\Models\Leave;
use App\Models\LeaveFile;
use App\Models\Post;
use App\Models\Stage;
use App\Models\Tag;
use App\Models\User;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::all();
        $users = User::pluck('name','id');
        return view('leaves.index',compact('leaves','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['posts'] = Post::where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        $data['tags'] = User::orderBy('name','asc')->get();
        $data['gettoday'] = Carbon::today()->format('Y-m-d'); 
        // dd($data['gettoday']);
        return view('leaves.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveRequest $request)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $leave = new Leave();
        $leave->post_id = json_encode($request['post_id']);
        $leave->startdate = $request['startdate'];
        $leave->enddate = $request['enddate'];
        $leave->tag = json_encode($request['tag']);
        $leave->title = $request['title'];
        $leave->content = $request['content'];        
        $leave->user_id = $user_id;

        $leave->save();

        // Multi Image Upload 
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){

                $leavefile = new LeaveFile();
                $leavefile->leave_id = $leave->id;

                $file = $image;
                $fname = $file->getClientOriginalName();
                $imagenewname = uniqid($user_id).$leave['id'].$fname;
                $file->move(public_path('assets/img/leaves/'),$imagenewname);

                $filepath = 'assets/img/leaves/'.$imagenewname;
                $leavefile->image = $filepath;

                $leavefile->save();
            }
        }

        session()->flash("success","New Leave Created");
        return redirect(route('leaves.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leave = Leave::findOrFail($id);
        $leavefiles = LeaveFile::where('leave_id',$id)->get();
        $users = User::pluck('name','id');
        $stages = Stage::whereIn('id',[1,2,3])->where('status_id',3)->get();
        return view('leaves.show',["leave"=>$leave,"leavefiles"=>$leavefiles,"users"=>$users,"stages"=>$stages]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['leave'] = Leave::findOrFail($id);
        $data['leavefiles'] = LeaveFile::where('leave_id',$id)->get(); // load all associate images
        $data['posts'] = Post::where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        $data['tags'] = User::orderBy('name','asc')->get()->pluck('name','id');
        return view('leaves.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveRequest $request, string $id)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $leave = Leave::findOrFail($id);
        $leave->post_id = $request['post_id'];
        $leave->startdate = $request['startdate'];
        $leave->enddate = $request['enddate'];
        $leave->tag = $request['tag'];
        $leave->title = $request['title'];
        $leave->content = $request['content'];
        
        if($leave->isconveted()){
            return redirect()->back()->with('info',"This leave form has already been conveted to an authorize stage. Editing is disable");
        }

        $leave->save();

        if($request->hasFile('images')){

            $leavefiles = LeaveFile::where('leave_id',$id)->get();

            // Remove Old Multi Images 
            foreach($leavefiles as $leavefile){

                $path = $leavefile->image;

                if(File::exists($path)){
                    File::delete($path);
                }

            }

            // Delete associated records from the database 
            $leavefiles = LeaveFile::where('leave_id',$id)->delete();

            // Multi Images Upload 
            foreach($request->file('images') as $image){

                $leavefile = new LeaveFile();
                $leavefile->leave_id = $leave->id;

                $file = $image;
                $fname = $file->getClientOriginalName();
                $imagenewname = uniqid($user_id).$leave['id'].$fname;
                $file->move(public_path('assets/img/leaves/'),$imagenewname);

                $filepath = 'assets/img/leaves/'.$imagenewname;
                $leavefile->image = $filepath;

                $leavefile->save();
            }
        }

        session()->flash("success","Update Successfully");
        return redirect(route('leaves.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leave = Leave::findOrFail($id);
        $leavefiles = LeaveFile::where('leave_id',$id)->get();

        if($leave->isconveted()){
            return redirect()->back()->with('info',"This leave form has already been conveted to an authorize stage. Delete is disable");
        }

        // Remove Old Multi Images
        foreach($leavefiles as $leavefile){

            $path = $leavefile->image;

            if(File::exists($path)){
                File::delete($path);
            }

        }

        // Delete associated records from the database 
            $leavefiles = LeaveFile::where('leave_id',$id)->delete();

        // Delete Leave Record
        $leave->delete();

        session()->flash('info',"Delete Successfully");
        return redirect()->back();
    }

    public function updatestage(Request $request,$id){
        $leave = Leave::findOrFail($id);
        $leave->stage_id = $request->stage_id;
        $leave->save();

        session()->flash('info',"Changed Stage");
        return redirect()->back();  
    }
}


// Tag CRUD 
// Post 