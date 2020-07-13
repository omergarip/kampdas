<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $events = Event::where('start_date', '>', Carbon::today())->paginate(20)->sortBy('start_date');
//        $events = Event::whereBetween('start_date', [Carbon::today(), Carbon::today()->addWeek()])->get();
        $notifications = '';
        if(auth()->user()) {
            $notifications = auth()->user()->notifications;
        }
        setlocale(LC_TIME, 'Turkish');
        $data = [];
        foreach ($events as $event) {
            $numberOfAttendee = $event->users->count() ?? '0';
            $firstMonth = Carbon::parse($event->start_date)->formatLocalized('%B');
            $secondMonth = Carbon::parse($event->end_date)->formatLocalized('%B');
            $firstDay = Carbon::parse($event->start_date)->formatLocalized('%d');
            $secondDay = Carbon::parse($event->end_date)->formatLocalized('%d');
            if($firstMonth === $secondMonth) {
                $data[] = [
                    'event_id' => $event->id,
                    'date' => $firstDay . '-' . $secondDay . ' ' . $firstMonth,
                ] ;
            } else {
                $data[] = [
                    'event_id' => $event->id,
                    'date' => $firstDay . ' ' . $firstMonth . ' - ' . $secondDay . ' ' . $secondMonth,
                ] ;
            }
        }
        //return view('index')->with('events', Event::all()->where('start_date', '>', Carbon::today())->sortBy('start_date'));
        return view('index')
            ->with('data', $data ?? '0')
            ->with('events', $events)
            ->with('notifications', $notifications)
            ->with('attendee', $numberOfAttendee ?? '0');


    }

    public function redirect()
    {
        return $this->redirect(route('home'));
    }
}
