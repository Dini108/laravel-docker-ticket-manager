<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\MassBuyTicketRequest;
use Illuminate\Contracts\View\View as View;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory as Factory;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactory;

class UsersController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::all();

        return view('pages.users.index', compact('users'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * @param \App\Http\Requests\StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->all());

        return redirect()->route('users.index');
    }

    /**
     * @param \App\User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    /**
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('users.index');
    }

    /**
     * @param \App\User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->tickets()->delete();

        $user->delete();

        return back();
    }

    /**
     * @param \App\Http\Requests\MassBuyTicketRequest $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function massDestroy(MassBuyTicketRequest $request)
    {
        $user = User::whereIn('id', request('ids'));

        $user->tickets()->delete();

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
