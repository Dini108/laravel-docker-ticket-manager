<?php

namespace App\Http\Controllers;

use App\Place;
use App\Event;
use App\Performer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\View\View as View;
use App\Http\Requests\StoreEventRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Contracts\View\Factory as Factory;
use App\Http\Requests\MassDestroyEventRequest;
use Illuminate\Contracts\Foundation\Application as Application;

class EventsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Event::with([
                'place',
                'performer',
            ])->select(sprintf('%s.*', (new Event)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'appointment_show';
                $editGate = 'appointment_edit';
                $buyTicketGate = 'ticket_buy';
                $deleteGate = 'appointment_delete';
                $crudRoutePart = 'events';

                return view('partials.datatablesActions', compact('viewGate', 'editGate', 'deleteGate', 'buyTicketGate', 'crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('name', function ($row) {
                return $row->name ?? '';
            });
            $table->addColumn('place_name', function ($row) {
                return $row->place->name ?? '';
            });

            $table->addColumn('performer_name', function ($row) {
                return $row->performer->name ?? '';
            });

            $table->editColumn('price', function ($row) {
                return $row->price ?: "";
            });

            $table->editColumn('description', function ($row) {
                return $row->description ?: "";
            });

            $table->rawColumns(['actions', 'placeholder', 'place', 'performer']);

            return $table->make(true);
        }

        return view('pages.events.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $places = Place::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $performers = Performer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('pages.events.create', compact('places', 'performers'));
    }

    /**
     * @param \App\Http\Requests\StoreEventRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEventRequest $request)
    {
        Event::create($request->all());

        return redirect()->route('events.index');
    }

    /**
     * @param \App\Event $event
     * @return Application|Factory|View
     */
    public function edit(Event $event)
    {
        $places = Place::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $performers = Performer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event->load('place', 'performer');

        return view('pages.events.edit', compact('places', 'performers', 'event'));
    }

    /**
     * @param \App\Http\Requests\UpdateEventRequest $request
     * @param \App\Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());

        return redirect()->route('events.index');
    }

    /**
     * @param \App\Event $event
     * @return Application|Factory|View
     */
    public function show(Event $event)
    {
        $event->load('place', 'performer');

        return view('pages.events.show', compact('event'));
    }

    /**
     * @param \App\Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Event $event)
    {
        $event->ticket()->delete();

        $event->delete();

        return back();
    }

    /**
     * @param \App\Http\Requests\MassDestroyEventRequest $request
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyEventRequest $request)
    {
        $event = Event::whereIn('id', request('ids'));

        $event->ticket()->delete();

        $event->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
