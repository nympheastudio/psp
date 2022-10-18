@extends('template')
@section('entete')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<style>
.fc-day-grid-event > .fc-content {
    white-space: normal;
    color: white;
}

</style>
<style>



@foreach($users as $u)

.event_{{$u->name}} {
    background-color:  {{$u->bgcolor}};
    color: #fff;
}

.event_{{$u->name}}:hover {
    background-color: {{$u->bgcolor}};
    color: #fff;
}


@endforeach

</style>

@endsection
@section('contenu')
<div class="container">
<div id='full_calendar_events'></div>
</div>
@endsection
@section('footer')

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
        height: 'auto',
        
        displayEventTime: true,
        timeFormat: 'HH:mm',
        
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
            
            
        },
        eventRender: function(event, element, calEvent) {
            //console.log(event);
            // console.log(element);
            //  console.log(calEvent);
            element.find(".fc-title").after("<img rel='"+event.id+"' class='delete_rdv' src=\"https://psp.facevaucluse.com/public/img/delete.png\" height='20px' width='20'px' />");
            
            
            
        },
        
        events : [
            @foreach($appointments as $appointment)
            {
                title : '{{ $appointment->event_name }}',
                start : '{{ $appointment->event_start }}',
                
                backgroundColor : '{{ $appointment->bgcolor }}',
                
                @if ($appointment->event_end)
                end: '{{ $appointment->event_end }}',
                @endif
                
                @if ($appointment->intervention_id)
                url : "https://psp.facevaucluse.com/interventions/"+{{$appointment->intervention_id}}+"/edit",
                @else
                
                url : "#",
                
                @endif
                
            },
            @endforeach
        ],
        
        
        
        
    });
    
$('.delete_rdv').on("click", function(event) {
           // $('.delete_rdv').click(function(event) {
                    var eventDelete = confirm("Etes vous sur de vouloir supprimer ce RDV ?");
                    var id_to_delete = $(this).attr('rel');
                    if (eventDelete) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/calendar-crud-ajax',
                            data: {
                                id: id_to_delete,
                                type: 'delete'
                            },
                            success: function (response) {
                                calendar.fullCalendar('removeEvents',id_to_delete);
                                displayMessage("RDV supprimé");
                            }
                        });
                    }
                 });

                 $(".fc-title").click(function(event) {

                    if($(e.target).is(".delete_rdv") ){
                    e.preventDefault();
                 }

                    document.location.href = event.url;
                 });
    
});
function displayMessage(message) {
    toastr.success(message, 'Event');            
}
</script>
@endsection
