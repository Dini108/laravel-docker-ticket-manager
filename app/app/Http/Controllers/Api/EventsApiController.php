<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Requests\StoreEventRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactory;

class EventsApiController extends Controller
{
    /**
     * @return \App\Http\Resources\EventResource
     */
    public function index()
    {
        return new EventResource(Event::with(['place', 'performer'])->get());
    }

    /**
     * @param \App\Http\Requests\StoreEventRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());

        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param \App\Event $event
     * @return \App\Http\Resources\EventResource
     */
    public function show(Event $event)
    {
        return new EventResource($event->load(['place', 'performer']));
    }

    /**
     * @param \App\Http\Requests\UpdateEventRequest $request
     * @param \App\Event $event
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());

        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @param \App\Event $event
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
