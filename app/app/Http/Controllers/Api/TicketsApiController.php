<?php

namespace App\Http\Controllers\Api;

use App\Place;
use App\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Requests\StoreTicketRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactory;

class TicketsApiController extends Controller
{
    /**
     * @return \App\Http\Resources\TicketResource
     */
    public function index()
    {
        return new TicketResource(Ticket::all());
    }

    /**
     * @param \App\Http\Requests\StoreTicketRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create($request->all());

        return (new TicketResource($ticket))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param \App\Place $ticket
     * @return \App\Http\Resources\TicketResource
     */
    public function show(Place $ticket)
    {
        return new TicketResource($ticket);
    }

    /**
     * @param \App\Place $ticket
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Place $ticket)
    {
        $ticket->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
