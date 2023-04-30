<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/CSS/bootsrap.css"/>
</head>
<body>
    <br>
    <h2 align="center">
        <a href="#">
            Full Calendar
        </a>
    </h2>
    <br>
    <div class="container">
        <div id="calendar">

        </div>
    </div>

    <script src="https:cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function(){
            var calendar =  $("#calendar").fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,adendaDay'
                },
                events:'load.php',
                selectable:true,
                selectHelper:true,
                select:function(start,end,allDay){
                    var title = prompt("enter event title");
                    if(title){
                        var start = $.fullCalendar.formatDate(start,"Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end,"Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url:'insert.php',
                            type:'POST',
                            data: {
                                title:title,
                                start:start,
                                end:end  
                            },success:function(){
                                calendar.fullCalendar('refetchEvents');
                                alert("added successfully");
                            }
                        })

                    }
                },
                eventClick:function(event){
                    if(confirm("Are you sure you want to remove it?")){
                      var id = event.id;
                      $.ajax({
                        url:'delete.php',
                        method:'POST',
                        data:{id:id},
                        success:function(){
                            calendar.fullCalendar('refetchEvents');
                            alert("deleted successfully");

                        }

                      })  
                    }
                },
                eventResize:function(event){
                    var start = $.fullCalendar.formatDate(start,"Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end,"Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:'update.php',
                        method:'POST',
                        data:{
                            start:start,
                            end:end,
                            id:id
                        },
                        success:function(data){
                            calendar.fullCalendar('refetchEvents');
                            alert("updated successfully");

                        }

                      })
                },
                eventDrop: function(event, start, end) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                    url: 'update.php',
                    method: 'POST',
                        data: {
                        start: start,
                        end: end,
                        id: id
                        },
                    success: function(data) {
                    calendar.fullCalendar('refetchEvents');
                    alert("updated successfully");
        }
    })
}



            })
        })
    </script>
</body>
</html>