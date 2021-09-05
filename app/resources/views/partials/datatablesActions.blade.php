@isset($viewGate)
    <a class="btn btn-xs btn-primary" href="{{ route($crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
@endif

@isset($editGate)
    <a class="btn btn-xs btn-info" href="{{ route($crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
@endif

<form action="{{ route($crudRoutePart . '.destroy', $row->id) }}" method="POST"
      onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
</form>

@isset($buyTicketGate)
    <form action="{{ route('tickets.create') }}" method="POST"
          onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="id" value='{{ $row->id }}'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-m btn-success" value="{{ trans('global.buy') }}">
    </form>
@endif
