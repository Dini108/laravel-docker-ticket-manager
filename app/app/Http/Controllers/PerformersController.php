<?php

namespace App\Http\Controllers;

use App\Performer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StorePerformerRequest;
use Illuminate\Contracts\View\View as View;
use App\Http\Requests\UpdatePerformerRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyPerformerRequest;
use Illuminate\Contracts\View\Factory as Factory;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactory;

class PerformersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Performer::with([])->select(sprintf('%s.*', (new Performer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'performer_show';
                $editGate = 'performer_edit';
                $deleteGate = 'performer_delete';
                $crudRoutePart = 'performers';

                return view('partials.datatablesActions', compact('viewGate', 'editGate', 'deleteGate', 'crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('pages.performers.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.performers.create');
    }

    /**
     * @param StorePerformerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePerformerRequest $request)
    {
        Performer::create($request->all());

        return redirect()->route('performers.index');
    }

    /**
     * @param \App\Performer $performer
     * @return Application|Factory|View
     */
    public function edit(Performer $performer)
    {
        return view('pages.performers.edit', compact( 'performer'));
    }

    /**
     * @param \App\Http\Requests\UpdatePerformerRequest $request
     * @param \App\Performer $performer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePerformerRequest $request, Performer $performer)
    {
        $performer->update($request->all());

        return redirect()->route('performers.index');
    }

    /**
     * @param \App\Performer $performer
     * @return Application|Factory|View
     */
    public function show(Performer $performer)
    {
        return view('pages.performers.show', compact('performer'));
    }

    /**
     * @param \App\Performer $performer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Performer $performer)
    {
        $performer->events()->delete();

        $performer->delete();

        return back();
    }

    /**
     * @param \App\Http\Requests\MassDestroyPerformerRequest $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyPerformerRequest $request)
    {

        $performer = Performer::whereIn('id', request('ids'));

        $performer->events()->delete();

        $performer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
