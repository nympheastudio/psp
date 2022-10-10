@extends('template')
@section('entete')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />


@endsection
@section('contenu')
<div class="container mt-5" style="max-width: 700px">
       <div id='full_calendar_events'></div>
    </div>
@endsection
@section('footer')

{{-- Scripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/fr.min.js" integrity="sha512-vz2hAYjYuxwqHQAgHPZvry+DTuwemFT/aBIDmgE0cnmYENu/+t8c3u/nX2Ont6e+3m+W6FEKxN1granjgGfr1Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#full_calendar_events').fullCalendar({
                locale: 'fr',
                editable: true,
               // editable: true,
                //events: SITEURL + "/calendar-event",
               
                displayEventTime: true,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (event_start, event_end, allDay) {
                    var event_name = prompt('Nom du RDV:');
                    if (event_name) {
                        var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                        var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + "/calendar-crud-ajax",
                            data: {
                                event_name: event_name,
                                event_start: event_start,
                                event_end: event_end,
                                type: 'create'
                            },
                            type: "POST",
                            success: function (data) {
                                displayMessage("Nouveau RDV enregistré");
                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: event_name,
                                    start: event_start,
                                    end: event_end,
                                    allDay: allDay
                                }, true);
                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
                eventDrop: function (event, delta) {
                    var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                    $.ajax({
                        url: SITEURL + '/calendar-crud-ajax',
                        data: {
                            title: event.event_name,
                            start: event_start,
                            end: event_end,
                            id: event.id,
                            type: 'edit'
                        },
                        type: "POST",
                        success: function (response) {
                            displayMessage("RDV modifié");
                        }
                    });
                },
                eventClick: function (event) {
                   /* var eventDelete = confirm("Etes vous sur?");
                    if (eventDelete) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/calendar-crud-ajax',
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function (response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("RDV supprimé");
                            }
                        });
                    }*/
                    document.location.href = event.url;
                },
                events : [
                  @foreach($appointments as $appointment)
                  {
                   title : '{{ $appointment->event_name }} ',
                      start : '{{ $appointment->event_start }}',
                    
                     
                      @if ($appointment->event_end)
                              end: '{{ $appointment->event_end }}',
                      @endif

                      @if ($appointment->intervention_id)
                      url : "https://psp.facevaucluse.com/interventions/"+{{$appointment->intervention_id}}+"/edit",
                      @endif
                     
                  },
                  @endforeach
              ],
/*
                events: [
      {
        title: 'tts la journée',
        start: '2022-10-01'
      },
      {
        title: 'Long',
        start: '2022-10-07',
        end: '2022-10-10',
        color: 'purple' // override!
      },
      {
        groupId: '999',
        title: 'RepetEvent',
        start: '2022-10-09T16:00:00'
      },
      {
        groupId: '999',
        title: 'RepetEvent',
        start: '2022-10-16T16:00:00'
      },
      {
        title: 'Conference',
        start: '2022-10-11',
        end: '2022-10-13',
        color: 'purple' // override!
      },
      {
        title: 'test Meeting',
        start: '2022-10-12T10:30:00',
        end: '2022-10-12T12:30:00'
      },
      {
        title: 'Reunion',
        start: '2022-10-12T12:00:00'
      },
      {
        title: 'RDV usager 3',
        start: '2022-10-12T14:30:00'
      },
      {
        title: 'test',
        start: '2022-10-13T07:00:00'
      },
      {
        title: 'Médiation',
        url: 'https://psp.facevaucluse.com/interventions/1/edit',
        start: '2022-10-28'
      }
    ]
*/




            });

           
        });
        function displayMessage(message) {
            toastr.success(message, 'Event');            
        }
    </script>
@endsection
