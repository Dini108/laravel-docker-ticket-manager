<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use Illuminate\Contracts\View\View as View;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyPlaceRequest;
use Illuminate\Contracts\View\Factory as Factory;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactory;

class PlacesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Place::query()->select(sprintf('%s.*', (new Place)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'place_show';
                $editGate      = 'place_edit';
                $deleteGate    = 'place_delete';
                $crudRoutePart = 'places';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ?: "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ?: "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ?: "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('pages.places.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.places.create');
    }

    /**
     * @param \App\Http\Requests\StorePlaceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePlaceRequest $request)
    {
        $place = Place::create($request->all());

        return redirect()->route('places.index');
    }

    /**
     * @param \App\Place $place
     * @return Application|Factory|View
     */
    public function edit(Place $place)
    {
        return view('pages.places.edit', compact('place'));
    }

    /**
     * @param \App\Http\Requests\UpdatePlaceRequest $request
     * @param \App\Place $place
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $place->update($request->all());

        return redirect()->route('places.index');
    }

    /**
     * @param \App\Place $place
     * @return Application|Factory|View
     */
    public function show(Place $place)
    {
        return view('pages.places.show', compact('place'));
    }

    /**
     * @param \App\Place $place
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Place $place)
    {
        $place->events()->delete();

        $place->delete();

        return back();
    }

    /**
     * @param \App\Http\Requests\MassDestroyPlaceRequest $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyPlaceRequest $request)
    {
        $place = Place::whereIn('id', request('ids'));

        $place->events()->delete();

        $place->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
