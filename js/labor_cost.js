$(function() {
  $('#workpicker').datetimepicker({
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
$('#laborcalc').submit(function(e){
    e.preventDefault();
    $.ajax({
        data: $('#laborcalc').serialize(),
        url: 'controllers/labor_cost_controller.php',
        method: 'POST',
        success: function(data) {
          // alert(data);
            
            
          var parsed = data.split(" ");
       
          var fullname = parsed[0]+" " +parsed[1];
          document.getElementById('fullname').value=fullname;
         
          
          document.getElementById('totalhours').value=parseFloat(parsed[2]).toFixed(2);
          document.getElementById('day').value=parsed[3];
          
          document.getElementById('atlocation').value=parsed[4];
        
        
        
            
        }
    });
});