<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventMedia;
use App\Http\Requests\Events\CreateEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use App\Notifications\EventsNotification;
use App\Notifications\LimitNotificiation;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::whereBetween('start_date', [Carbon::today(), Carbon::today()->addWeek()]);
        //return view('events.index')->with('events', Event::paginate(5)->where('start_date', '>', Carbon::today())->sortBy('start_date'));
        return view('events.index')->with('events', $events);
    }

    public function apiIndex()
    {
        return response()->json(Event::whereBetween('start_date', [Carbon::today(), Carbon::today()->addWeek()])->get());
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(CreateEventRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->id();
        $data['start_date'] = Carbon::parse($data['start_date']);
        $data['end_date'] = Carbon::parse($data['end_date']);
        $event = Event::create($data);
        return redirect(route('media.create', $event->slug));
    }

    public function show($slug)
    {
        $event = Event::whereSlug($slug)->first();
        $attendants = $event->users;
        $isAttended = false;
        foreach ($attendants as $attendant) {
            if($attendant->id === auth()->id())
                $isAttended = true;
        }
        $first_media = EventMedia::where('event_id', $event->id)->latest()->get();
        $media = EventMedia::where('id', '!=', $first_media[0]->id)->latest()->get();
        return view('events.show')
            ->with('event', $event)
            ->with('attendants', $attendants)
            ->with('isAttended', $isAttended)
            ->with('media', $media)
            ->with('first_media', $first_media);
    }

    public function apiShow($slug) {
        $event = Event::whereSlug($slug)->first();
        return response()->json($event);
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
        $data['start_date'] = Carbon::parse($data['start_date']);
        $data['end_date'] = Carbon::parse($data['end_date']);
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
        $notify = $event->user;
        $user = Auth::user();
        $number = $event->users->count();
        if($number == $event->limit - 1) {
            $notify->notify(new LimitNotificiation($user, $event));
        } else {
            $notify->notify(new EventsNotification($user, $event));
        }

        session()->flash('success', 'Etkinliğe başarı ile katıldınız');
        return redirect()->back();
    }

    public function detach($slug)
    {
        $event = Event::whereSlug($slug)->first();
        $user = $event->user;
        $user->notifications()
            ->whereJsonContains("data->slug", $slug)
            ->get()
            ->first()
            ->delete();
        $event->users()->detach(auth()->id());
        session()->flash('success', 'Etkinlikten başarı ile ayrildiniz');
        return redirect()->back();
    }
}
