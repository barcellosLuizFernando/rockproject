@extends('layouts.main')

@section('headscript')

    <link href='/css/fullcalendar/main.css' rel='stylesheet' />
    <script src='/js/fullcalendar/main.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                nowIndicator: true,
                themeSystem: 'bootstrap',
                headerToolbar: {
                    right: 'dayGridMonth,dayGridWeek,dayGridDay,timeGridWeek,timeGridDay,listDay',
                    center: 'title',
                    left: 'prev,next today'
                }, // buttons for switching between views
                views: {
                    timeGrid: { // name of view
                        titleFormat: {
                            year: 'numeric',
                            month: 'long',
                            day: '2-digit',
                            separator: ' até '
                        }
                        // other view-specific options here
                    },
                    dayGrid: { // name of view
                        titleFormat: {
                            month: 'long',
                            year: 'numeric',
                            day: '2-digit',
                            separator: ' até '
                        }
                        // other view-specific options here
                    }
                },
                locale: 'pt',
                editable: true,
                selectable: true,
                select: function(start, end, allDay) {

                },
                eventResize: function(event, delta) {

                },
                eventSources: [{
                    url: '/schedule/getSchedule',
                    method: 'GET',
                    headers: {
                        "XSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    },
                    extraParams: {},
                    /*failure: function() {
                        alert('there was an error while fetching events!');
                        alert(document.querySelector('meta[name="csrf-token"]').content);
                    },*/
                }],
                eventSourceSuccess: function(content, xhr) {
                    //console.log(content);
                },
                eventSourceFailure: function(errorObj) {
                    //console.log(errorObj);
                }

                /*events: [{
                    id: 1,
                    title: 'my event',
                    started_at: '2021-10-13',
                    start: '2021-10-12T10:30:00',
                    end: '2021-10-12T17:30:00',
                    allDay: false

                }]*/
            });

            calendar.render();
        });
    </script>

@endsection

@section('content')

    <div class="container">

        <div id='calendar'></div>

    </div>

@endsection

@section('bodyscript')


@endsection
