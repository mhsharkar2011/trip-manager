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




function updateLocalTime() {
      const now = new Date();
      const utcTime = now.toISOString();
    //   const localTime = now.toLocaleString();
    //   const dateTime = explode('-',localTime);
      const utcTimeFormatted = utcTime.replace('T', ' ').replace('Z', '');
      const years = now.getFullYear().toLocaleString().padStart(4, '0');
      const months = now.getMonth().toLocaleString().padStart(2, '0');
      const dates = now.getDate().toLocaleString().padStart(2, '0');
      const hours = now.getHours().toLocaleString().padStart(2, '0');
      const minutes = now.getMinutes().toLocaleString().padStart(2, '0');
      const seconds = now.getSeconds().toLocaleString().padStart(2, '0');
      const localTimeFormatted = `${years}-${months}-${dates} ${hours}:${minutes}:${seconds}`;

      document.getElementById('local-time').textContent = utcTime;
      
      
    //   document.getElementById('utc-time').innerHTML = localTime;
    //   document.getElementById('utc-time').textContent = dateTime;
    }

    updateLocalTime(); // initial call to update the local time

    setInterval(updateLocalTime, 1000); // update the local time every second
 



var datetimeInput = document.getElementById('datetime');
var datetimeValue = datetimeInput.value;
var datetime = new Date(datetimeValue.replace(' ', 'T') + ':00Z');
var isoDatetime = datetime.toISOString();
