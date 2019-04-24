$('#lookup').submit(function(e){
    e.preventDefault();
    $.ajax({
        data: $('#lookup').serialize(),
        url: 'controllers/edit_project_fill.php',
        method: 'POST',
        success: function(data) {
            if(data =="Did not select a project."){
              alert("Please select a project");
            }
            else{
                var parsed = data.split("%^%");
                document.getElementById('pid').value=parsed[0];
                document.getElementById('address').value=parsed[1];
                document.getElementById('borough').value=parsed[2];
                document.getElementById('startdate').value=parsed[3];
                document.getElementById('enddate').value=parsed[4];
            }
        }
    });
});


$(document).ready(function() {
  $(function() {
    $('#startDatePicker').datetimepicker({
      format: 'L',
      debug: true,
      icons: {
        time: 'far fa-clock',
        date: 'far fa-calendar-alt',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'far fa-calendar-check',
        clear: 'far fa-trash-alt',
        close: 'fas fa-times'
      }
    });

    $('#endDatePicker').datetimepicker({
      format: 'L',
      debug: true,
      icons: {
        time: 'far fa-clock',
        date: 'far fa-calendar-alt',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'far fa-calendar-check',
        clear: 'far fa-trash-alt',
        close: 'fas fa-times'
      }
    });
  });
});
