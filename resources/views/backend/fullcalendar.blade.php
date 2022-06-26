@extends('backend.backend_master')

@section('content')


<div class="page-wrapper">

    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
          <h4 class="page-title">Calendar Example</h4>
        </div>
      </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>
                            Click a date to create a task. Click it again to delete. All tasks are saved to the database.
                        </p>
                        <div id='calendar'></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
  
    $(document).ready(function () {
          
        //Get Site URL
        var SITEURL = "{{ url('/') }}";
        

        //CSRF Token Setup
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          
        //Tasks from DB
        var tasks = @json($events);

        //FullCalender JS Code
        var calendar = $('#calendar').fullCalendar({

                editable: true,
                events: tasks, //SITEURL + "/fullcalender",
                displayEventTime: false,
                editable: true,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                            event.allDay = true;
                    } else {
                            event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        $.ajax({
                            url: SITEURL + "/user/fullcalendarAjax",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                user_id:'{{Auth()->user()->id}}',
                                type: 'add'
                            },
                            type: "POST",
                            success: function (data) {
                                console.log(data);
                                displayMessage("Event Created Successfully");

                                calendar.fullCalendar('renderEvent',
                                    {
                                        id: data.id,
                                        title: title,
                                        start: start,
                                        end: end,
                                        user_id:'{{Auth()->user()->id}}',
                                        allDay: allDay
                                    },true);

                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    $.ajax({
                        url: SITEURL + '/user/fullcalendarAjax',
                        data: {
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function (response) {
                            console.log(response);
                            displayMessage("Event Updated Successfully");
                        }
                    });
                },
                eventClick: function (event) {
                    var deleteMsg = confirm("Do you really want to delete?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/user/fullcalendarAjax',
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function (response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Event Deleted Successfully");
                            }
                        });
                    }
                }

            });
     
        });
        

        //Toastr Success Code
        function displayMessage(message) {
            toastr.success(message, 'Event');
        } 
        
    </script>

@endsection
