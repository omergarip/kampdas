<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\Events\CreateEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use Illuminate\Http\Request;

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
        //
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        //
    }

    public function update(UpdateEventRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
