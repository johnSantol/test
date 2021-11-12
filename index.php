
<?php
//index.php




?>
<!DOCTYPE html>
<html>
 <head>
  <title></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   

  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },

    
    events: 'load.php',
    selectable:false,
    selectHelper:true,
    select: function(start, end, allDay) 


    {
      $( "#submit" ).click(function() {
 // alert("click");
  var sample = $('#startTime').val();
        var sample2 = $('#endTime').val();
        var title = $('#title').val();
      // var title = prompt("Enter Event Title");
      //alert (title);
        if(title) {

        // var sample = $('#startTime').val();
        // var sample2 = $('#endTime').val();
        // alert(sample2);
        // var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        // var start =  '2021-11-09 10:30:00';
        var start =  sample;
        var end = sample2;
        // var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        // alert(start);

      $.ajax({
       url:"insert.php",
       type:"POST",
      // start: '2019-08-12T10:30:00',
      // end: '2019-08-12T11:30:00',
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }

     });

    },


    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
   
  </script>
  <style>
      {
      background-color: blue;
    }
  </style>
 </head>
 <body>
<input type="text" id="title" required />
<input type="datetime-local" id="startTime" required />
<input type="datetime-local" id="endTime" required />
<input type="submit" id="submit">
  <div class="container">
   <div id="calendar"></div>
  </div>
 </body>
</html>