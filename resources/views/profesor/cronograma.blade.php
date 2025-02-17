@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Cronograma</h3>
        <div id="calendar"></div>
    </div>
@endsection

@push('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: '{{ route('profesor.cronograma.eventos') }}'
            });
            calendar.render();
        });
    </script>
@endpush
