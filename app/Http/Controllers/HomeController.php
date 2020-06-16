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
        //return view('index')->with('events', Event::all()->where('start_date', '>', Carbon::today())->sortBy('start_date'));
        return view('index')->with('events', Event::paginate(5));
    }
}
