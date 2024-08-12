function countdown() {
    var sec = 5; // set timer in seconds
    var timer = setInterval(function(){
        var countdownElement = document.getElementById('countdown');
        if (countdownElement) {
            countdownElement.innerHTML = sec;
        } else {
            console.error("Element with ID 'countdown' not found.");
            clearInterval(timer);
            return;
        }
        sec--;
        if (sec < 1) {
            clearInterval(timer);
            jsPsych.endCurrentTimeline();
        }
    }, 1000);
}