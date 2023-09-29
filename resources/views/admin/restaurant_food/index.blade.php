@extends('admin.layouts.master')

@section('title')
    Restaurant food
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.css">
    <style>
        #external-events {
            position: fixed;
            z-index: 2;
            top: 20px;
            left: 20px;
            width: 150px;
            padding: 0 10px;
            border: 1px solid #ccc;
            background: #eee;
        }

        #external-events .fc-event {
            margin: 1em 0;
            cursor: move;
        }

        #calendar-container {
            position: relative;
            z-index: 1;
            margin-left: 200px;
        }

        #calendar {
            max-width: 1100px;
            margin: 20px auto;
        }
    </style>
@endsection

@section('content')
    <div class="page-inner-content">
        <div class="row no-gutters">
            <!--================================-->
            <!-- Page Content Area Start -->
            <!--================================-->
            <div class="col-lg-12 page-content-area">
                <div id='external-events'>
                    <p>
                        <strong>Draggable Events</strong>
                    </p>
                    <div class='fc-event fc-h-event fc-timeline-event' data-title="Plan 1" data-duration="01:00:00">Plan 1 ~ 60
                    </div>
                    <div class='fc-event fc-h-event fc-timeline-event' data-title="Plan 2" data-duration="01:20:00">Plan 2 ~
                        80</div>
                    <div class='fc-event fc-h-event fc-timeline-event' data-title="Plan 3" data-duration="01:40:00">Plan 3 ~
                        100</div>
                    <div class='fc-event fc-h-event fc-timeline-event' data-title="Plan 4" data-duration="02:00:00">Plan 4 ~
                        120</div>
                </div>

                <div id='calendar-container'>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = $('#external-events')[0];
            var calendarEl = $('#calendar')[0];
            var checkbox = $('#drop-remove')[0];

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.fc-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.getAttribute('data-title'),
                        duration: eventEl.getAttribute('data-duration')
                    };
                }
            });

            // initialize the calendar
            // -----------------------------------------------------------------

            var tempStartEvent = null;
            var tempEndEvent = null;
            var calendar = new Calendar(calendarEl, {
                timeZone: 'UTC',
                initialView: 'resourceTimelineDay',
                aspectRatio: 1.5,
                slotDuration: '03:00:00',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: '' //resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth
                },
                resourceAreaHeaderContent: 'Rooms',
                resources: [{
                        "id": "a",
                        "title": "ROOM 1"
                    },
                    {
                        "id": "b",
                        "title": "ROOM 2",
                        "eventColor": "green"
                    },
                    {
                        "id": "c",
                        "title": "ROOM 3",
                        "eventColor": "orange"
                    }
                ],
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar
                eventResizableFromStart: true,
                eventDurationEditable: false,
                eventReceive: function(info) {},
                eventDragStop: function(info) {},
                eventDrop: function(info) {}
            });

            calendar.render();
        });
    </script>
@endsection
