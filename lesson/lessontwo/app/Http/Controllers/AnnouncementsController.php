<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;


class AnnouncementsController extends Controller
{
    public function index(){

        $announcements = Announcement::all();          
        return view('announcements.index',compact('announcements'));

    }

    public function create(){
        // $posts = Post::where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        $posts = \DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        return view('announcements.create',compact('posts'));  
    }

    public function store(Request $request){

        $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
            'title' => 'required|max:100',
            'content'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $announcement = new Announcement();
        $announcement->title = $request['title'];
        $announcement->content = $request['content'];
        $announcement->post_id = $request['post_id'];
        $announcement->user_id = $user_id;

        // Single Image Upload 

        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);
            $imagenewname = uniqid($user_id).$user_id.$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/announcements/'),$imagenewname);

            $filepath = 'assets/img/announcements/'.$imagenewname;
            $announcement->image = $filepath;
        }
  
        $announcement->save();

        session()->flash("success","New Announcement Created");
        return redirect(route('announcements.index'));
    }

    public function show(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.show',compact('announcement'));
    }

    public function edit(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        $posts = \DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        return view('announcements.edit')->with('announcement',$announcement)->with('posts',$posts);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
            'title' => 'required|max:100',
            'content'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $announcement = Announcement::findOrFail($id);
        $announcement->title = $request['title'];
        $announcement->content = $request['content'];
        $announcement->post_id = $request['post_id'];        
        $announcement->user_id = $user_id;

        if($request->hasFile('image')){
            $path = $announcement->image;

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
            $file->move(public_path('assets/img/announcements/'),$imagenewname);

            $filepath = 'assets/img/announcements/'.$imagenewname;
            $announcement->image = $filepath;
        }

        $announcement->save();
        session()->flash("success","Update Successfully");
        return redirect(route('announcements.index'));
    }

    public function destroy(string $id){
        $announcement = Announcement::findOrFail($id);

        $path = $announcement->image;

        if(File::exists($path)){
            File::delete($path);
        }

        $announcement->delete();

        session()->flash("info","Delete Successfully");
        return redirect()->back();
    }
}
