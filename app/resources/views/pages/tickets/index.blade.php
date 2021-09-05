@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.ticket.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Ticket">
                <thead>
                <tr>
                    <th width="5">

                    </th>
                    <th>
                        {{ trans('cruds.ticket.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.ticket.fields.user_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.ticket.fields.event_name') }}
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
                url: "{{ route('tickets.massDestroy') }}",
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
                            $('.datatable-Client').DataTable().ajax.reload();
                        })
                    }
                }
            }
            dtButtons.push(deleteButton)

            let myTicketsButton = {
                text: '{{ trans('cruds.ticket.buttons.my_tickets') }}',
                className: 'btn-info',
                url: "{{ route('tickets.my_tickets') }}",
                action: function (e, dt, node, config) {
                    $.fn.dataTable.settings[0].ajax = "{{ route('tickets.my_tickets') }}";
                    $('.datatable-Ticket').DataTable().ajax.reload();
                }
            }

            dtButtons.push(myTicketsButton)

            let allTicketsButton = {
                text: '{{ trans('cruds.ticket.buttons.all_tickets') }}',
                className: 'btn-info',
                url: "{{ route('tickets.index') }}",
                action: function (e, dt, node, config) {
                    $.fn.dataTable.settings[0].ajax = "{{ route('tickets.index') }}";
                    $('.datatable-Ticket').DataTable().ajax.reload();
                }
            }

            dtButtons.push(allTicketsButton)

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('tickets.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'user_name', name: 'user_name'},
                    {data: 'event_name', name: 'event_name'},
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                order: [[1, 'desc']],
                pageLength: 100,
            };
            $('.datatable-Ticket').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });

    </script>
@endsection
