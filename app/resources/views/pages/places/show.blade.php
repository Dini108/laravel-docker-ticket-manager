@extends('layouts.main')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.place.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.id') }}
                        </th>
                        <td>
                            {{ $place->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.name') }}
                        </th>
                        <td>
                            {{ $place->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.address') }}
                        </th>
                        <td>
                            {{ $place->address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection
