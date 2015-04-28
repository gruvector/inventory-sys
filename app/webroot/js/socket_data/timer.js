//$(document).ready(function(){
//this script is what will be used for setting up the value for the timer
var timerID = null;
var timerRunning = false;

function stopclock (){
    if(timerRunning)
        clearTimeout(timerID);
    timerRunning = false;
}
function showtime () {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var timeValue = "" + ((hours > 12) ? hours - 12 : hours); // re-introduce AM/PM Format
        timeValue = ((parseInt(timeValue) < 10) ? "0" : "") + timeValue;
        
    if (timeValue == "00") timeValue = 12;
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
    timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
    timeValue += hours > 12 ? " PM" : " AM";
    document.timer_form.timerx.value = timeValue;
    timerID = setTimeout("showtime()",1000);
    timerRunning = true;
}
function startclock() {
    stopclock();
    showtime();
}

$(document).ready(function() {
    startclock();
});