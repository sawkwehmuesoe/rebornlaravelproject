<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Type;
use App\Models\Status;
use App\Models\User;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['attshows'] = Status::whereIn('id',[3,4])->get();
        $data['types'] = Type::whereIn('id',[1,2])->get();
        $data['tags'] = Tag::all();
        $data['statuses'] = Status::whereIn('id',[7,10,11])->get();
        // $data['gettoday'] = Carbon::today()->format('Y-m-d'); 
        // $data['gettime'] = Carbon::today()->format('Y-m-d'); 
        return view('leaves.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([            
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
            'title'=>'required|max:300,unique:posts,title',
            'content' => 'required',
            'fee' => 'required', 
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'starttime' => 'required|time',
            'endtime' => 'required|time',
            'type_id' => 'required|in:1,2',
            'tag_id' => 'required',
            'attshow' => 'required|in:3,4',
            'status_id' => 'required|in:7,10,11',
            'title' => 'required|max:100',
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $post = new Post();
        $post->title = $request['title'];
        $post->slug = Str::slug($request['title']);
        $post->content = $request['content'];
        $post->fee = $request['fee'];
        $post->startdate = $request['startdate'];
        $post->enddate = $request['enddate'];
        $post->starttime = $request['starttime'];
        $post->endtime = $request['endtime'];
        $post->type_id = $request['type_id'];
        $post->tag_id = $request['tag_id'];
        $post->attshow = $request['attshow'];
        $post->status_id = $request['status_id'];
        $post->user_id = $user_id;

        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);
            $imagenewname = uniqid($user_id).$user_id.$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/posts/'),$imagenewname);

            $filepath = 'assets/img/posts/'.$imagenewname;
            $post->image = $filepath;
        }

        $post->save();

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['post'] = Post::findOrFail($id);
        $data['types'] = Type::all();
        $data['tags'] = User::orderBy('name','asc')->get();
        $data['statuses'] = Status::whereIn('id',[1,2])->get();
        // dd($data['gettoday']);
        return view('leaves.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $post = Post::findOrFail($id);
        $post->title = $request['title'];
        $post->slug = Str::slug($request['title']);
        $post->content = $request['content'];
        $post->fee = $request['fee'];
        $post->startdate = $request['startdate'];
        $post->enddate = $request['enddate'];
        $post->starttime = $request['starttime'];
        $post->endtime = $request['endtime'];
        $post->type_id = $request['type_id'];
        $post->tag_id = $request['tag_id'];
        $post->attshow = $request['attshow'];
        $post->status_id = $request['status_id'];
        $post->user_id = $user_id;

        if($request->hasFile('image')){
            $path = $post->image;

            if(File::exists($path)){
                File::delete($path);
            }
        }

        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);
            $imagenewname = uniqid($user_id).$user_id.$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/posts/'),$imagenewname);

            $filepath = 'assets/img/posts/'.$imagenewname;
            $post->image = $filepath;
        }

        $post->save();

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        $path = $post->image;

        if(File::exists($path)){
            File::delete($path);
        }

        $post->delete();

        return redirect()->back();
    }
}
