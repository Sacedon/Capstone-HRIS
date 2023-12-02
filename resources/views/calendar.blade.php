<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar of Events') }}
        </h2>
        <!-- Include Bootstrap CSS -->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css' rel='stylesheet'>
    </x-slot>

    <div class="">
        <!-- Calendar Panel -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                Calendar
            </div>
            <div class="panel-body">
                <!-- Calendar Container -->
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <!-- Include jQuery, Bootstrap JS, Moment.js, and FullCalendar -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function () {
            var userRole = "{{ $userRole }}";

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                navLinks: true,
                editable: true,
                events: "{{ route('calendar') }}",
                displayEventTime: false,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true' || event.allDay === true) {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    if (userRole === 'admin') {
                        var title = prompt('Event Title:');
                        if (title) {
                            var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                            var end = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD');
                            $.ajax({
                                url: "{{ URL::to('createevent') }}",
                                data: 'title=' + title + '&start=' + start + '&end=' + end + '&_token=' + "{{ csrf_token() }}",
                                type: "post",
                                success: function (data) {
                                    alert("Added Successfully");
                                    calendar.fullCalendar('refetchEvents');
                                }
                            });
                        }
                    } else {
                        alert("You do not have the necessary permissions to add events.");
                    }
                },
                eventClick: function (event) {
                    if (userRole === 'admin') {
                        var action = prompt("Do you want to edit (e) or delete (d) this Event?");

                        if (action === 'e') {
                            // Edit event title
                            var editTitle = prompt('Edit Event Title:', event.title);
                            if (editTitle !== null) {
                                // Update the event title
                                event.title = editTitle;
                                // Send the updated data to the server
                                $.ajax({
                                    type: "POST",
                                    url: "{{ URL::to('updateevent') }}",
                                    data: {
                                        id: event.id,
                                        title: editTitle,
                                        _token: "{{ csrf_token() }}"
                                    },
                                    success: function (response) {
                                        alert("Updated Successfully");
                                        calendar.fullCalendar('updateEvent', event);
                                    }
                                });
                            }
                        } else if (action === 'd') {
                            var deleteMsg = confirm("Do you really want to delete this Event?");
                            if (deleteMsg) {
                                // Send the delete request to the server
                                $.ajax({
                                    type: "POST",
                                    url: "{{ URL::to('deleteevent') }}",
                                    data: "&id=" + event.id + '&_token=' + "{{ csrf_token() }}",
                                    success: function (response) {
                                        if (parseInt(response) > 0) {
                                            calendar.fullCalendar('removeEvents', event.id);
                                            alert("Deleted Successfully");
                                        }
                                    }
                                });
                            }
                        }
                    } else {
                        alert("You do not have the necessary permissions to edit or delete events.");
                    }
                },
            });
        });
    </script>
</x-app-layout>
