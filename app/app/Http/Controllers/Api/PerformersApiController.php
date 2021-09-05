<?php

namespace App\Http\Controllers\Api;

use App\Performer;
use App\Http\Controllers\Controller;
use App\Http\Resources\PerformerResource;
use App\Http\Requests\StorePerformerRequest;
use App\Http\Requests\UpdatePerformerRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactory;

class PerformersApiController extends Controller
{
    /**
     * @return \App\Http\Resources\PerformerResource
     */
    public function index()
    {
        return new PerformerResource(Performer::all());
    }

    /**
     * @param \App\Http\Requests\StorePerformerRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(StorePerformerRequest $request)
    {
        $performer = Performer::create($request->all());

        return (new PerformerResource($performer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param \App\Performer $performer
     * @return \App\Http\Resources\PerformerResource
     */
    public function show(Performer $performer)
    {
        return new PerformerResource($performer);
    }

    /**
     * @param \App\Http\Requests\UpdatePerformerRequest $request
     * @param \App\Performer $performer
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function update(UpdatePerformerRequest $request, Performer $performer)
    {
        $performer->update($request->all());

        return (new PerformerResource($performer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @param \App\Performer $performer
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Performer $performer)
    {
        $performer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
