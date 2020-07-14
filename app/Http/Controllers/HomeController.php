<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $numOfNotifications = '0';
        if(Auth::user()) {
            $notifications = Auth::user()->notifications;
            $numOfNotifications = Auth::user()->unreadNotifications->count();
        }
        setlocale(LC_TIME, 'Turkish');
        $data = [];
        $isAttended = false;
        foreach ($events as $event) {
            $attendants = $event->users;
            foreach ($attendants as $attendant) {
                if($attendant->id === auth()->id())
                    $isAttended = true;
            }
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
        return view('index')
            ->with('data', $data)
            ->with('events', $events)
            ->with('isAttended', $isAttended)
            ->with('notifications', $notifications)
            ->with('numOfNotifications', $numOfNotifications)
            ->with('attendee', $numberOfAttendee ?? '0');


    }

    public function redirect()
    {
        return $this->redirect(route('home'));
    }
}
