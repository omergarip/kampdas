<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($username)
    {
        $user = User::get()->where('username', $username)->first();
        $createdEvents = Event::all()->where('created_by', $user->id);
        $attendedEvents = $user->attend;
        $numberOfEvent = $createdEvents->count() + $attendedEvents->count();

        return view('profile.show')
            ->with('numberOfEvent', $numberOfEvent)
            ->with('user', $user);
    }

    public function showEvents($username)
    {
        $user = User::get()->where('username', $username)->first();
        $createdEvents = Event::all()->where('created_by', $user->id);
        $attendedEvents = $user->attend;
        return view('profile.showEvents')
            ->with('createdEvents', $createdEvents)
            ->with('attendedEvents', $attendedEvents);
    }

    public function userEvents($username)
    {
        $user = User::get()->where('username', $username)->first();
        $createdEvents = Event::all()->where('created_by', $user->id);
        $attendedEvents = $user->attend;
        $data[] = json_decode($createdEvents);
        $data[] = json_decode($attendedEvents);
        return response()->json($attendedEvents);
    }

    public function edit($username)
    {
        $user = User::where('username', $username)->first();
        return view('profile.edit')->with('user', $user);
    }

    public function update(UpdateProfileRequest $request, $username)
    {
        $user = User::where('username', $username)->first();
        $data = $request->only(['name', 'username', 'email', 'city', 'birthday', 'bio']);
        if($request->password != '')
            $data['password'] = Hash::make($request->password);
        if($request->hasFile('photo')) {
            $name = Str::slug($request['photo']->getClientOriginalName());
            $filename = str_replace(array('jpg', 'jpeg', 'png', 'svg'), '', $name);
            $filename = $filename . time() . '.' . $request['photo']->getClientOriginalExtension();
            $photo = $request['photo']->storeAs('/storage/profile', $filename);
            @unlink('/'.$user->photo);
            $data['photo'] = $photo;
        }
        $user->update($data);
        $errors = Session::get('errors');
        dd($errors);
        session()->flash('success', 'Profiliniz başarı ile güncellendi.');
        return redirect(route('profile', $username));
    }

    public function destroy($id)
    {
        //
    }
}
