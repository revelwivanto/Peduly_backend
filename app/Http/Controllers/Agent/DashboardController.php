<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Mail\Contact;
use Carbon\Carbon;
use App\Property;
use App\Message;
use App\User;
use Auth;
use Hash;
use Toastr;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $properties    = Property::latest()->where('agent_id', Auth::id())->take(5)->get();
        $propertytotal = Property::latest()->where('agent_id', Auth::id())->count();

        $messages      = Message::latest()->where('agent_id', Auth::id())->take(5)->get();
        $messagetotal  = Message::latest()->where('agent_id', Auth::id())->count();

        return view('agent.dashboard',compact('properties','propertytotal','messages','messagetotal'));
    }

    public function profile()
    {
        $profile = Auth::user();

        return view('agent.profile',compact('profile'));
    }
    // public function profileUpdate(Request $request)
    // {
    //     $request->validate([
    //         'name'      => 'required',
    //         'username'  => 'required',
    //         'email'     => 'required|email',
    //         'image'     => 'image|mimes:jpeg,jpg,png',
    //         'about'     => 'max:250'
    //     ]);

    //     $user = User::find(Auth::id());

    //     $image = $request->file('image');
    //     $slug  = str_slug($request->name);

    //     if(isset($image)){
    //         $currentDate = Carbon::now()->toDateString();
    //         $imagename = $slug.'-agent-'.Auth::id().'-'.$currentDate.'.'.$image->getClientOriginalExtension();

    //         if(!Storage::disk('public')->exists('users')){
    //             Storage::disk('public')->makeDirectory('users');
    //         }
    //         if(Storage::disk('public')->exists('users/'.$user->image) && $user->image != 'default.png' ){
    //             Storage::disk('public')->delete('users/'.$user->image);
    //         }
    //         $userimage = Image::make($image)->stream();
    //         Storage::disk('public')->put('users/'.$imagename, $userimage);
    //     }

    //     $user->name = $request->name;
    //     $user->username = $request->username;
    //     $user->email = $request->email;
    //     $user->image = $imagename;
    //     $user->about = $request->about;

    //     $user->save();

    //     return back();
    // }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'username'  => 'required',
            'email'     => 'required|email',
            'image'     => 'image|mimes:jpeg,jpg,png',
            'about'     => 'max:191'
        ]);

        $user = User::find(Auth::id());

        $image = $request->file('image');
        $slug  = Str::slug($request->name);

        if ($image) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-agent-' . Auth::id() . '-' . $currentDate . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('users')) {
                Storage::disk('public')->makeDirectory('users');
            }

            if (Storage::disk('public')->exists('users/' . $user->image) && $user->image != 'default.png') {
                Storage::disk('public')->delete('users/' . $user->image);
            }

            $userimage = Image::make($image)->encode($image->getClientOriginalExtension(), 90);
            Storage::disk('public')->put('users/' . $imagename, $userimage);

            // Only update image column if a new image is uploaded
            $user->image = $imagename;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->about = $request->about;

        $user->save();

        return back();
    }



    
    public function changePassword()
    {
        return view('agent.changepassword');

    }

    public function changePasswordUpdate(Request $request)
    {
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {

            Toastr::error('message', 'Your current password does not matches with the password you provided! Please try again.');
            return redirect()->back();
        }
        if(strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0){

            Toastr::error('message', 'New Password cannot be same as your current password! Please choose a different password.');
            return redirect()->back();
        }

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        Toastr::success('message', 'Password changed successfully.');
        return redirect()->back();
    }



    // MESSAGE
    public function message()
    {
        $messages = Message::latest()->where('agent_id', Auth::id())->paginate(10);

        return view('agent.messages.index',compact('messages'));
    }

    public function messageRead($id)
    {
        $message = Message::findOrFail($id);

        return view('agent.messages.read',compact('message'));
    }

    public function messageReplay($id)
    {
        $message = Message::findOrFail($id);

        return view('agent.messages.replay',compact('message'));
    }

    public function messageSend(Request $request)
    {
        $request->validate([
            'agent_id'  => 'required',
            'user_id'   => 'required',
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        Message::create($request->all());

        Toastr::success('message', 'Message send successfully.');
        return back();

    }

    public function messageReadUnread(Request $request)
    {
        $status = $request->status;
        $msgid  = $request->messageid;

        if($status){
            $status = 0;
        }else{
            $status = 1;
        }

        $message = Message::findOrFail($msgid);
        $message->status = $status;
        $message->save();

        return redirect()->route('agent.message');
    }

    public function messageDelete($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        Toastr::success('message', 'Message deleted successfully.');
        return back();
    }


    public function contactMail(Request $request)
    {
        $message  = $request->message;
        $name     = $request->name;
        $mailfrom = $request->mailfrom;

        Mail::to($request->email)->send(new Contact($message,$name,$mailfrom));

        Toastr::success('message', 'Mail send successfully.');
        return back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'purpose' => 'required',
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'city' => 'required',
            'address' => 'required',
            'area' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/property')){
                mkdir('uploads/property', 0777, true);
            }
            $image->move('uploads/property', $imagename);
        }else{
            $imagename = 'default.png';
        }

        $property = new Property();
        $property->title = $request->title;
        $property->slug = $slug;
        $property->price = $request->price;
        $property->purpose = $request->purpose;
        $property->type = $request->type;
        $property->image = $imagename;
        $property->bedroom = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->city = $request->city;
        $property->city_slug = Str::slug($request->city);
        $property->address = $request->address;
        $property->area = $request->area;
        $property->agent_id = Auth::id();
        $property->description = $request->description;
        $property->location_latitude = $request->location_latitude;
        $property->location_longitude = $request->location_longitude;
        $property->nearby = $request->nearby;
        $property->save();

        Toastr::success('Property Successfully Saved', 'Success');
        return redirect()->route('agent.property.index');
    }

}

// Visit codeastro.com for more projects
