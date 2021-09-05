<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactory;

class UsersApiController extends Controller
{
    /**
     * @return \App\Http\Resources\UserResource
     */
    public function index()
    {
        return new UserResource(User::all());
    }

    /**
     * @param \App\Http\Requests\StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param \App\User $user
     * @return \App\Http\Resources\UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @param \App\User $user
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
