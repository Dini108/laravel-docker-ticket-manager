@extends('layouts.main')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
        </div>

        <div class="card-body">
            <form action="{{ route("events.update", [$event->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">{{ trans('cruds.event.fields.name') }}*</label>
                    <input type="text" id="name" name="name" class="form-control"
                           value="{{ old('name', isset($event) ? $event->name : '') }}" required>
                    @if($errors->has('name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.performer.fields.name_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('place_id') ? 'has-error' : '' }}">
                    <label for="place">{{ trans('cruds.event.fields.place') }}*</label>
                    <select name="place_id" id="place" class="form-control" required>
                        @foreach($places as $id => $place)
                            <option value="{{ $id }}"
                                {{ (isset($event) && $event->place ? $event->place->id : old('client_id')) === $id ? 'selected' : '' }}>
                                {{ $place }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('place_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('place_id') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('performer_id') ? 'has-error' : '' }}">
                    <label for="performer">{{ trans('cruds.event.fields.performer') }}</label>
                    <select name="performer_id" id="performer" class="form-control">
                        @foreach($performers as $id => $performer)
                            <option value="{{ $id }}"
                                {{ (isset($event) && $event->performer ? $event->performer->id : old('performer_id')) === $id ? 'selected' : '' }}>
                                {{ $performer }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('performer_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('performer_id') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                    <label for="start_time">{{ trans('cruds.event.fields.start_time') }}*</label>
                    <input type="text" id="start_time" name="start_time" class="form-control datetime"
                           value="{{ old('start_time', isset($event) ? $event->start_time : '') }}"
                           required>
                    @if($errors->has('start_time'))
                        <em class="invalid-feedback">
                            {{ $errors->first('start_time') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.event.fields.start_time_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('finish_time') ? 'has-error' : '' }}">
                    <label for="finish_time">{{ trans('cruds.event.fields.finish_time') }}*</label>
                    <input type="text" id="finish_time" name="finish_time" class="form-control datetime"
                           value="{{ old('finish_time', isset($event) ? $event->finish_time : '') }}"
                           required>
                    @if($errors->has('finish_time'))
                        <em class="invalid-feedback">
                            {{ $errors->first('finish_time') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.event.fields.finish_time_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                    <label for="price">{{ trans('cruds.event.fields.price') }}</label>
                    <input type="number" id="price" name="price" class="form-control"
                           value="{{ old('price', isset($event) ? $event->price : '') }}" step="0.01">
                    @if($errors->has('price'))
                        <em class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.event.fields.price_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="comments">{{ trans('cruds.event.fields.description') }}</label>
                    <textarea id="description" name="description"
                              class="form-control ">{{ old('description', isset($event) ? $event->description : '') }}</textarea>
                    @if($errors->has('description'))
                        <em class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.event.fields.description_helper') }}
                    </p>
                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>


        </div>
    </div>
@endsection
