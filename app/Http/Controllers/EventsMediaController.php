<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventsMediaController extends Controller
{

    public function index()
    {
        //
    }

    public function create($slug)
    {
        return view('media.create')->with('slug', $slug);
    }

    public function store(Request $request, $slug)
    {
        $event = Event::whereSlug($slug)->first();
        $name = Str::slug($request->file->getClientOriginalName());
        $filename = str_replace(array('jpg', 'jpeg', 'png', 'svg'), '', $name);
        $filename = $filename . time() . '.' . $request->file->getClientOriginalExtension();
        $photo = $request->file->storeAs('storage/events', $filename);
        EventMedia::create([
            'photo' => $photo,
            'event_id' => $event->id,
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($slug)
    {
        $event = Event::whereSlug($slug)->first();
        $media = EventMedia::where('event_id', $event->id)->get();
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
