<?php

namespace App\Http\Controllers\API;

use App\Event;
use App\EventMedia;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventsResource;
use App\Notifications\EventsNotification;
use App\Notifications\LimitNotificiation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{

    public function index()
    {
        $events = Event::where('start_date', '>', Carbon::today())->get();
        return response(['events' => new EventsResource($events), 'message' => 'Retrieved Succesfully'], 200);
    }

    public function store(Request $request)
    {
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
        $photos = EventMedia::where('event_id', $event->id)->get();
        return response([ 'event' => new EventsResource($event),
                'attendants' => $attendants,
                'isAttended' => $isAttended,
                'photos' => $photos,
                'message' => 'Retrieved successfully'],
            200);
        // return response(['event' => $event, 'attendants' => $attendants, 'isAttended' => $isAttended, 'photos' => $media, 'firstPhoto' => $first_media]);
    }

    public function update(Request $request, $slug)
    {
        $event = Event::whereSlug($slug)->first();
        $data = $request->all();
        $validator = Validator::make($data,
            [
                'title' => ['required', 'string', 'max:75', 'min:5'],
                'location' => 'required',
                'description' => ['required', 'string', 'min:10', 'max:1000'],
                'limit' => 'required',
                'start_date' => 'required',
                'end_date' => 'required'
            ],
            [
                'title.required' => 'Kamp etkinliğinize bir isim verin.',
                'title.min' => 'Etkinlik başlığı en az 10 karakter olmalıdır.',
                'title.max' => 'Etkinlik başlığı 75 karakteri geçemez',
                'location.required' => 'Kamp etkinliğiniz için konum bildiriniz.',
                'description.required' => 'Diğer kampdaşları bilgilendirmek için kamp etkinliğiniz hakkında bir açıklama yazısı girin.',
                'description.min' => 'Açıklama yazısı en az 10 karakter olmalıdır.',
                'description.max' => 'Açıklama yazısı en fazla 1000 karakter olabilir.',
                'limit.required' => 'Katılım kontenjanını belirleyiniz.',
                'start_date.required' => 'Etkinlik başlangıç tarihini giriniz.',
                'end_date.required' => 'Etkinlik bitiş tarihini giriniz.'
            ]
        );
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $data['start_date'] = Carbon::parse($data['start_date']);
            $data['end_date'] = Carbon::parse($data['end_date']);
            $event->update($data);
            return response([ 'event' => $data]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $event = Event::whereSlug($slug)->first();
        $media = EventMedia::where('event_id', $event->id)->get();
        foreach ($media as $m) {
            @unlink('https://kampdas.org/'.$m->photo);
        }
        $event->forceDelete();
        return response(['Message' => 'Deleted']);
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
        return response(['Message' => 'Etkinliğe başarı bir şekilde katıldınız']);
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
        return response(['Message' => 'Etkinlikten başarı bir şekilde ayrıldınız']);
    }
}
