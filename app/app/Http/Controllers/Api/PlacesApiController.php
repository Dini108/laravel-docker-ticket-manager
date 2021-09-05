<?php

namespace App\Http\Controllers\Api;

use App\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactory;

class PlacesApiController extends Controller
{
    /**
     * @return \App\Http\Resources\PlaceResource
     */
    public function index()
    {
        return new PlaceResource(Place::all());
    }

    /**
     * @param \App\Http\Requests\StorePlaceRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(StorePlaceRequest $request)
    {
        $place = Place::create($request->all());

        return (new PlaceResource($place))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param \App\Place $place
     * @return \App\Http\Resources\PlaceResource
     */
    public function show(Place $place)
    {
        return new PlaceResource($place);
    }

    /**
     * @param \App\Http\Requests\UpdatePlaceRequest $request
     * @param \App\Place $place
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $place->update($request->all());

        return (new PlaceResource($place))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @param \App\Place $place
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
