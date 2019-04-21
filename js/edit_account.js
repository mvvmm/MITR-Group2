$('#lookup').submit(function(e){
    e.preventDefault();
    $.ajax({
        data: $('#lookup').serialize(),
        url: 'controllers/edit_account_fill.php',
        method: 'POST',
        success: function(data) {
            if(data =="E-mail does not exist."){
              alert("E-mail does not exist.");
            }
            else if(data=="Did not fill in an e-mail."){
              alert("Did not fill in an e-mail.");
            }
            else if(data=="You do not have permission to look up this account."){
              alert("You do not have permission to look up this account.");
            }
            else{
                var parsed = data.split(" ");
                document.getElementById('email').value=$('#lookup-email').val();
                document.getElementById('first').value=parsed[0];
                document.getElementById('last').value=parsed[1];
                document.getElementById('phone').value=parsed[2];
                if (document.getElementById('privilege')){
                  document.getElementById('privilege').value=parsed[3];
                }
            }
        }
    });
});
