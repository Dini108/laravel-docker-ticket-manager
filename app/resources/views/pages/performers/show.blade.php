@extends('layouts.main')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.performer.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.performer.fields.id') }}
                        </th>
                        <td>
                            {{ $performer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.performer.fields.name') }}
                        </th>
                        <td>
                            {{ $performer->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.performer.fields.email') }}
                        </th>
                        <td>
                            {{ $performer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.performer.fields.phone') }}
                        </th>
                        <td>
                            {{ $performer->phone }}
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
