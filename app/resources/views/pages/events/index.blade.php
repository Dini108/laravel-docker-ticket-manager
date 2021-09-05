@extends('layouts.main')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("events.create") }}">
            {{ trans('global.add',['model' => trans('cruds.event.title_singular')]) }}
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.event.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Event">
            <thead>
            <tr>
                <th width="5">

                </th>
                <th>
                    {{ trans('cruds.event.fields.id') }}
                </th>
                <th>
                    {{ trans('cruds.event.fields.name') }}
                </th>
                <th>
                    {{ trans('cruds.event.fields.place') }}
                </th>
                <th>
                    {{ trans('cruds.event.fields.performer') }}
                </th>
                <th>
                    {{ trans('cruds.event.fields.start_time') }}
                </th>
                <th>
                    {{ trans('cruds.event.fields.finish_time') }}
                </th>
                <th>
                    {{ trans('cruds.event.fields.price') }}
                </th>
                <th>
                    {{ trans('cruds.event.fields.description') }}
                </th>
                <th>
                    {{ trans('global.actions') }}
                </th>
            </tr>
            </thead>
        </table>


    </div>
</div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('events.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                            })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }

            let buyTicketButton = {
                text: '{{ trans('cruds.event.buttons.buy_tickets') }}',
                url: "{{ route('tickets.massBuy') }}",
                className: 'btn-success',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'POST'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(buyTicketButton)

            dtButtons.push(deleteButton)

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('events.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'place_name', name: 'place.name'},
                    {data: 'performer_name', name: 'performer.name'},
                    {data: 'start_time', name: 'start_time'},
                    {data: 'finish_time', name: 'finish_time'},
                    {data: 'price', name: 'price'},
                    {data: 'description', name: 'description'},
                    {data: 'actions', name: '{{ trans('global.actions') }}'}
                ],
                order: [[1, 'desc']],
                pageLength: 100,
            };
            $('.datatable-Event').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });

    </script>
@endsection
