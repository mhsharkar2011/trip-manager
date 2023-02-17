$('#attendanceFrom').submit(function(e){
    $('#attendanceFrom').preventDefault();
    console.log('clicked');
    
});
$('#submitAttend').click(function(){
    $('#attendanceFrom').submit();
});

$('#attendanceFrom td span').click(function(){
    var a = $(this).text();
    if(a == 'Yes'){
        $(this).next().attr("disabled", 'disabled');
        $(this).next().css("background", '#ccc');
        $(this).next().next().css('display', 'inline-block');
        
    }else if(a == 'No'){
        $(this).prev().attr("disabled", 'disabled');
        $(this).next().css('display', 'inline-block');
    }else if(a == 'Undo'){
        $(this).prev().removeAttr("disabled");
        $(this).prev().prev().removeAttr("disabled");
        $(this).css('display', 'none');
    }
    
    console.log(a);
});


$(document).ready( function() {
   
    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth() + 1;
    const day = now.getDate();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const seconds = now.getSeconds();
    const formattedTime = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')} ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    $('#date22').val(formattedTime);
    
    // updateDate();
    // setInterval(updateDate, 10);
});
