<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventMedia;
use App\Http\Requests\Events\CreateEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function index()
    {
        return view('events.index')->with('events', Event::paginate(5));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(CreateEventRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->id();
        $data['start_date'] = Carbon::now();
        $data['end_date'] = Carbon::now();
        $event = Event::create($data);
        session()->flash('success', 'Etkinlik başarı ile oluşturuldu.');
        return redirect(route('media.create', $event->slug));
    }

    public function show($slug)
    {
        $event = Event::whereSlug($slug)->first();
        $first_media = EventMedia::where('event_id', $event->id)->latest()->get();
        $media = EventMedia::where('id', '!=', $first_media[0]->id)->latest()->get();
        return view('events.show')
            ->with('event', $event)
            ->with('media', $media)
            ->with('first_media', $first_media);
    }

    public function edit($slug)
    {
        $event = Event::whereSlug($slug)->first();
        return view('events.create')->with('event', $event);
    }

    public function update(UpdateEventRequest $request, $slug)
    {
        $event = Event::whereSlug($slug)->first();
        $data = $request->all();
        $event->update($data);
        session()->flash('success', 'Etkinlik güncellendi.');
        return redirect(route('events.show', $slug));
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $media = EventMedia::where('event_id', $event->id)->get();
        foreach ($media as $m) {
            @unlink('/'.$m->photo);
        }
        $event->forceDelete();
        session()->flash('success', 'Etkinlik başarı ile silindi.');
        return redirect(route('home'));
    }

    public function attend($slug)
    {
        $event = Event::whereSlug($slug)->first();
        $event->users()->attach(auth()->id());
        session()->flash('success', 'Etkinliğe başarı ile katıldınız');
        return redirect()->back();
    }
}
