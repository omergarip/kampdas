<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;

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

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
