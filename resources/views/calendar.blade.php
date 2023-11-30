<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar of Events') }}
        </h2>
        <!-- Include Bootstrap CSS -->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css' rel='stylesheet'>
    </x-slot>

    <div class="">
        <!-- Add Reminder Button -->
        <button class="btn btn-primary mb-5" data-toggle="modal" data-target="#addReminderModal">Add Reminder</button>

        <!-- Calendar Panel -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                Calendar
            </div>
            <div class="panel-body">
                <!-- Calendar Container -->
                <div id='calendar'></div>

                <!-- Add Reminder Modal -->
                <div class="modal fade" id="addReminderModal" tabindex="-1" role="dialog" aria-labelledby="addReminderModalLabel">
                    <!-- Modal Dialog -->
                    <div class="modal-dialog" role="document">
                        <!-- Modal Content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="addReminderModalLabel">Add Reminder</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Reminder Form -->
                                <form id="reminderForm">
                                    <div class="form-group">
                                        <label for="reminderTitle">Title:</label>
                                        <input type="text" class="form-control" id="reminderTitle" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="reminderDate">Date:</label>
                                        <input type="date" class="form-control" id="reminderDate" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Add Reminder</button>
                                </form>
                            </div>

                        </div>
                    </div>
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
                        var deleteMsg = confirm("Do you really want to delete this Event?");
                        if (deleteMsg) {
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
                    } else {
                        alert("You do not have the necessary permissions to delete events.");
                    }
                },
            });

            // Initialize Reminder form submission
            $('#reminderForm').submit(function (e) {
                e.preventDefault();

                // Get values from the form
                var title = $('#reminderTitle').val();
                var date = $('#reminderDate').val();

                // Add Reminder to the calendar
                var eventData = {
                    title: title,
                    start: date,
                    allDay: true
                };


                // Close the modal
                $('#addReminderModal').modal('hide');


                // Send the data to the server
                $.ajax({
                    url: "{{ route('addReminder') }}",
                    type: "post",
                    data: {
                        title: title,
                        start: date,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        alert(response.message);

                        location.reload();
                    },
                    error: function (error) {
                        console.error(error);
                        alert('An error occurred while adding the reminder.');
                    }
                });
            });

            // Close the modal when it is hidden
            $('#addReminderModal').on('hidden.bs.modal', function () {
                // Clear the form on modal close
                $('#reminderForm')[0].reset();
            });
        });
    </script>
</x-app-layout>
