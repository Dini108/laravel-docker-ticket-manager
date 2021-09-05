@extends('layouts.main')
@section('content')
    <h3 class="page-title">{{ trans('global.eventCalendar') }}</h3>
    <div class="card">
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
      $(document).ready(function () {
          let events = {!! json_encode($events, JSON_THROW_ON_ERROR) !!};

          let calendar = new window.Calendar($('#calendar').get(0), {
              plugins: [window.timeGridPlugin],
              themeSystem: 'bootstrap',
              initialView: 'timeGridWeek',
              locale: '{{ app()->getLocale() }}',
              eventBorderColor: 'white',
              events: events,
              allDay: false,
              eventTimeFormat: { // like '14:30:00'
                  hour: '2-digit',
                  minute: '2-digit',
                  second: '2-digit',
              }
          });

          console.log(events);

          calendar.render();
      })
    </script>
@stop
