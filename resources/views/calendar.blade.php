<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar of Events') }}
        </h2>
        <!-- Include Bootstrap CSS -->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css' rel='stylesheet'>
    </x-slot>

    <div class="">
        <!-- Button to Open Add Event Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEventModal">
            Add Event
        </button>

        <!-- Calendar Panel -->
        <div class="panel panel-primary mt-2">
            <div class="panel-heading">
                Calendar
            </div>
            <div class="panel-body">
                <!-- Calendar Container -->
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="addEventModalLabel">Add Event</h4>
                </div>
                <div class="modal-body">
                    <form id="addEventForm">
                        <div class="form-group">
                            <label for="eventTitle">Event Title:</label>
                            <input type="text" class="form-control" id="eventTitle" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="eventColor">Event Color:</label>
                            <input type="text" class="form-control" id="eventColor" name="color" />
                        </div>
                        <div class="form-group">
                            <label for="eventStart">Event Start Date:</label>
                            <input type="text" class="form-control" id="eventStart" name="start" required>
                        </div>
                        <div class="form-group">
                            <label for="eventEnd">Event End Date:</label>
                            <input type="text" class="form-control" id="eventEnd" name="end" required>
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Include jQuery, Bootstrap JS, Moment.js, and FullCalendar -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>
    <!-- Include Bootstrap Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.js"></script>

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
                        // Clear the form fields
                        $('#addEventForm')[0].reset();
                        // Set the start and end date in the form
                        $('#eventStart').val(moment(start).format('YYYY-MM-DD'));
                        $('#eventEnd').val(moment(end).format('YYYY-MM-DD'));
                        $('#addEventModal').modal('show');
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
                                    url: "{{ route('updateevent') }}",
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
                                    url: "{{ route('deleteevent') }}",
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

            // Initialize Datepicker for start and end dates in the modal
            $('#eventStart, #eventEnd').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            });

            $('#eventColor').spectrum({
            preferredFormat: "hex",
            showInput: true,
            showPalette: true,
            palette: [
                ['#FF0000', '#FF8000', '#FFFF00', '#00FF00', '#0000FF', '#8000FF', '#FF00FF']
            ]
        });

            // Handle form submission for adding events
            $('#addEventForm').submit(function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('createevent') }}",
                    data: formData,
                    type: "post",
                    success: function (data) {
                        $('#addEventModal').modal('hide');
                        alert("Added Successfully");
                        calendar.fullCalendar('refetchEvents');
                    }
                });
            });
        });
    </script>
</x-app-layout>
