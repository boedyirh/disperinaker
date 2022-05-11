

@extends('layouts.v_template')
@section('keterangan','Managemen Penetapan Hari Libur')
@section('title','Penetapan Hari Libur (v_penetapan_libur.blade.php)')
@section('breadcrumb','Penetapan Hari Libur')

@push('styles')
<style>
    .fc-sun {
        color:#337ab7;
        background-color: #f4a4c1; }
    .fc-sat {
        color:#337ab7;
        background-color: #f4a4c1; }
    #calendar-container{
        width: 100%;
        }
    #calendar{
        padding: 10px;
        margin: 10px;
        }
</style>

@endpush

@push('scripts')

    <script>
        $(document).ready(function () {
        var SITEURL = "{{ url('/') }}";

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
                        editable: true,
                        events: SITEURL + "/fullcalendar",
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
                            var title = prompt('Set Hari Libur:');
                           // var title = "Libur";
                            if (title) {
                                var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                                var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                                $.ajax({
                                    url: SITEURL + "/fullcalendarAjax",
                                    data: {
                                        title: title,
                                        start: start,
                                        end: end,
                                        type: 'add'
                                    },
                                    type: "POST",
                                    success: function (data) {
                                        displayMessage("Hari libur berhasil diset");

                                        calendar.fullCalendar('renderEvent',
                                            {
                                                id: data.id,
                                                title: title,
                                                start: start,
                                                end: end,
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
                                url: SITEURL + '/fullcalendarAjax',
                                data: {
                                    title: event.title,
                                    start: start,
                                    end: end,
                                    id: event.id,
                                    type: 'update'
                                },
                                type: "POST",
                                success: function (response) {
                                    displayMessage("Event Updated Successfully");
                                }
                            });
                        },
                        eventClick: function (event) {
                            // var deleteMsg = confirm("Do you really want to delete?");
                            var deleteMsg = true;
                            if (deleteMsg) {
                                $.ajax({
                                    type: "POST",
                                    url: SITEURL + '/fullcalendarAjax',
                                    data: {
                                            id: event.id,
                                            type: 'delete'
                                    },
                                    success: function (response) {
                                        calendar.fullCalendar('removeEvents', event.id);
                                        displayDeleteMessage("Hari Libur berhasil dihapus");
                                    }
                                });
                            }
                        }

                    });

     });

    function displayMessage(message) {
        toastr.success(message, 'Event', {timeOut: 700});
    }
    function displayDeleteMessage(message) {
        toastr.warning(message, 'Event',{timeOut: 700});
    }

    </script>

@endpush
@section('content')

<div class="row">
    <div class="col-md-4">
        @livewire('backend.daftar-libur-lw')

    </div>
    <div class="col-md-8">
        <div class="calendar-container box box-primary">
            <div id='calendar'></div>
        </div>
    </div>
</div>



@endsection

