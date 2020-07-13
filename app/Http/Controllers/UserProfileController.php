<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return view('profile.show')->with('user', User::get()->where('username', $username)->first());
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

    public function edit($username)
    {
        $user = User::where('username', $username)->first();
        return view('profile.edit')->with('user', $user);
    }

    public function update(Request $request, $username)
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
        session()->flash('success', 'Profiliniz güncellendi.');
        return redirect(route('profile', $username));
    }

    public function destroy($id)
    {
        //
    }
}
