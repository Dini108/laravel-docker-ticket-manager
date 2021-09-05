<?php

namespace App\Http\Controllers;

use App\Http\Requests\MassDestroyTicketRequest;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\MassBuyTicketRequest;
use Illuminate\Contracts\View\View as View;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory as Factory;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactory;

class TicketsController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Ticket::with([
                'event',
                'user',
            ])->select(sprintf('%s.*', (new Ticket)->table));

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $deleteGate = 'ticket_delete';
                $crudRoutePart = 'tickets';

                return view('partials.datatablesActions', compact('deleteGate', 'crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ?: "";
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user->name ?? '';
            });

            $table->addColumn('event_name', function ($row) {
                return $row->event->name ?? '';
            });

            $table->rawColumns(['actions', 'placeholder', 'events', 'users']);

            return $table->make(true);
        }

        return view('pages.tickets.index');
    }

    /**
     * @param \App\Http\Requests\StoreTicketRequest $request
     * @return Application|Factory|View
     */
    public function create(StoreTicketRequest $request)
    {
        Ticket::create(['event_id' => $request->id, 'user_id' => Auth::user()->id]);

        return view('pages.events.index');
    }

    /**
     * @param Ticket $ticket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return back();
    }

    /**
     * @param MassBuyTicketRequest $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function massBuy(MassBuyTicketRequest $request)
    {
        foreach (request('ids') as $id){
            Ticket::create(['event_id' => $id, 'user_id' => Auth::user()->id]);
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param \App\Http\Requests\MassDestroyTicketRequest $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyTicketRequest $request)
    {
        $ticket = Ticket::whereIn('id', request('ids'));

        $ticket->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function my_tickets(Request $request)
    {
        if ($request->ajax()) {
            $query = Ticket::with([
                'event',
                'user',
            ])->select(sprintf('%s.*', (new Ticket)->table))->where('user_id', Auth::user()->id);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $deleteGate = 'ticket_delete';
                $crudRoutePart = 'tickets';

                return view('partials.datatablesActions', compact('deleteGate', 'crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ?: "";
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user->name ?? '';
            });

            $table->addColumn('event_name', function ($row) {
                return $row->events->name ?? '';
            });


            $table->rawColumns(['actions', 'placeholder', 'events', 'users']);

            return $table->make(true);
        }

        return view('pages.tickets.index');
    }

}
