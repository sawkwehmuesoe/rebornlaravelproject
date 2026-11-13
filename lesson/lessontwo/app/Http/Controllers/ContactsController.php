<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Gender;
use App\Models\Relative;
use App\Models\User;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactEmailNotify;

class ContactsController extends Controller
{
    public function index(Request $request)
    {

        $namefilter = $request['namefilter'];

        $query = Contact::query();

        if($namefilter){
            $query->where('firstname','like','%'.$namefilter.'%');
        }

        $data['contacts'] = $query->paginate(5)->appends($request->except('page'));

        $genders = Gender::orderBy('id','asc')->pluck('name','id');
        $relatives = Relative::pluck('name','id')->prepend('Choose relative',"");
        return view('contacts.index',compact('genders','relatives'),$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([                        
            'firstname'=>'required|min:3|max:50',
            'lastname'=>'nullable|string|max:50',
            'gender_id' => 'nullable|exists:genders,id',
            'birthday' => 'nullable|date|before:today',          
            'relative_id' => 'nullable|exists:relatives,id'            
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $contact = new Contact();
        $contact->firstname = $request['firstname'];
        $contact->lastname = $request['lastname'];
        $contact->gender_id = $request['gender_id'];
        $contact->birthday = $request['birthday'];      
        $contact->relative_id = $request['relative_id'];
        $contact->user_id = $user_id;

        $contact->save();

        // => Email Notification to all users 

        $contactdatas = [
            "firstname"=>$contact->firstname,
            "lastname"=>$contact->lastname,
            "birthday"=>$contact->birthday,
            "relative"=>$contact->relative["name"],
            "url"=>url('/')
        ];

        Notification::send($user,new ContactEmailNotify($contactdatas));

        session()->flash("success","New Contact Created");
        return redirect(route('contacts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['gender'] = Gender::all();    
        $data['relative'] = Relative::all();
        return view('contacts.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([                        
            'editfirstname'=>'required|string|min:3|max:50',
            'editlastname'=>'nullable|string|max:50',
            'editgender_id' => 'nullable|exists:genders,id',
            'editbirthday' => 'nullable|date|before:today',          
            'editrelative_id' => 'nullable|exists:relatives,id'               
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $contact = Contact::findOrFail($id);
        $contact->firstname = $request['editfirstname'];
        $contact->lastname = $request['editlastname'];
        $contact->gender_id = $request['editgender_id'];
        $contact->birthday = $request['editbirthday'];      
        $contact->relative_id = $request['editrelative_id'];
        $contact->user_id = $user_id;

        $contact->save();

        session()->flash("success","Update Successfully");
        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        session()->flash("info","Delete Success");
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Contact::whereIn('id',$getselectedids)->delete();
            return Response::json(["success"=>"Selected data have been deleted successfully."]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return Response::json(["status"=>"Failed","message"=>$e->getMessage()]);
        }
    }
}
