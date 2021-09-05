<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Contracts\View\View as View;
use Illuminate\Contracts\View\Factory as Factory;
use Illuminate\Contracts\Foundation\Application as Application;

class SystemCalendarController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $events = [];

        $getEvents = Event::with(['place', 'performer'])->get();

        foreach ($getEvents as $event) {
            if (!$event->start_time) {
                continue;
            }

            $events[] = [
                'title' => 'Fellépő: '.$event->performer->name.', Helyszín: '.$event->place->address,
                'start' => $event->start_time,
                'end' => $event->finish_time,
                'url' => route('events.edit', $event->id),
            ];
        }

        return view('pages.calendar.calendar', compact('events'));
    }
}
