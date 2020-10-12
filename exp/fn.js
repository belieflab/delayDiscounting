function countdown(){ // initialize timer
    var sec = 5; // set timer in seconds
    var timer = setInterval(function(){
    document.getElementById('countdown').innerHTML=sec;
    sec--;
    if (sec > 1) {
      jsPsych.endCurrentTimeline();
      }
    }, 1000);
  }

function saveData(name, data){
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php'); // 'index.php' contains the php script described above
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({filename: name, filedata: data}));
}

function startExperiment(){
    jsPsych.init({
      timeline: timeline,
      show_progress_bar: true,
      //on_finish: function(){
        //jsPsych.data.get().filter([{test_part: 'test'},{test_part: 'prediction'},{test_part: 'c2_test'}]).localSave("csv", `test-self-deception-data.csv`);
          //jsPsych.data.displayData(); 
      //}
    });
  }