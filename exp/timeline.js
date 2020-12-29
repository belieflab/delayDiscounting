/* create timeline */
let timeline = [];

let welcome = {
    type: "html-keyboard-response",
    stimulus: '<h3 style="color:blue;">Welcome to the experiment!</h3>'+
    '<p><i>Press any key to begin.</i></p>',
}

let instr_1 = {
  type:"html-keyboard-response",
  stimulus:'<p>In the following task, you will be asked to pretend to choose between earning either:</p>'+
  '<p><strong>a little money now</strong>&nbsp&nbsp&nbsp&nbsp&nbsp <i>or</i> &nbsp&nbsp&nbsp&nbsp&nbsp<strong>a little more money, later</strong></p>'+
  '<p><i>Press the spacebar to continue.</i></p>',
  choices: [32],
}

let instr_2 = {
  type:"html-keyboard-response",
  stimulus:'<p>To make your selection on each trial:<br></p>'+
  '<p><strong>press the <u>1</u> key</strong>&nbsp&nbsp&nbsp&nbsp&nbsp <i>or</i> &nbsp&nbsp&nbsp&nbsp&nbsp <strong>press the <u>0</u> key</strong><br>'+
  '<p><i>Press either of the response keys to continue.</i></p>',
  choices: ['1', '0'],
}

let instr_3 = {
  type:"html-keyboard-response",
  stimulus:'<p>There are no right or wrong answers.<br></p>'+
  '<p> Please take your time, and respond as truthfully as you can.</p>'+
  '<p><i>Press the spacebar to continue.</i></p>',
  choices: [32],
}

let instr_4 = {
  type:"html-keyboard-response",
  stimulus: '<p style="color:black;"> Get Ready...</p>',
  
  trial_duration: 2000,
}

let instr_5 = {
  type:"html-keyboard-response",
  stimulus:'<p style="color:black; font-size:60px;" id="countdown"></p>',
  trial_duration: 5200,
  on_start: countdown(),
  response_ends_trial: false,
  }


let fixation = {
  type: 'html-keyboard-response',
  stimulus: '<div style="font-size:60px;">+</div>',
  choices: jsPsych.NO_KEYS,
  trial_duration: 1000,
}

let trial = {
  type: "html-keyboard-response",
  stimulus: jsPsych.timelineVariable('stimulus'), //train_stimuli_array, //jsPsych.timelineVariable('stimulus'),
  choices: ['1', '0'],
  data: jsPsych.timelineVariable('data'),
  on_finish: function(data){
    data.subjectkey = GUID;
    data.src_subject_id = workerId;
    data.site = siteNumber;
    data.interview_date = today;
    data.interview_age = ageAtAssessment;
    data.sex = sexAtBirth;
    data.handedness = handedness;
    data.index = indexIterator;
    indexIterator++;
    response = jsPsych.pluginAPI.convertKeyCodeToKeyCharacter(data.key_press)
    if (response == 0) {
      data.response = 'ldr';
    } else if (response == 1) {
      data.response = 'sir';
    }
  }
}

let save_data = {
  type: "html-keyboard-response",
  stimulus: "<p>Data saving...</p>"+
  '<div class="sk-cube-grid">'+
'<div class="sk-cube sk-cube1"></div>'+
'<div class="sk-cube sk-cube2"></div>'+
'<div class="sk-cube sk-cube3"></div>'+
'<div class="sk-cube sk-cube4"></div>'+
'<div class="sk-cube sk-cube5"></div>'+
'<div class="sk-cube sk-cube6"></div>'+
'<div class="sk-cube sk-cube7"></div>'+
'<div class="sk-cube sk-cube8"></div>'+
'<div class="sk-cube sk-cube9"></div>'+
'</div>'+
  "<p>Do not close this window until the text dissapears.</p>",

  choices: jsPsych.NO_KEYS,
  trial_duration: 5000,
  on_finish: function(){
    saveData("dd_" + workerId, jsPsych.data.get().csv());
    document.getElementById("unload").onbeforeunload='';
    $(document).ready(function(){
    $("body").addClass("showCursor"); // returns cursor functionality
});
  }
};

let end = {
  type: "html-keyboard-response",
  stimulus:   "<p>Thank you!</p>"+
  "<p>You have successfully completed the experiment and your data has been saved.</p>"+
  "<p>To leave feedback on this task, please click the following link:</p>"+
  "<p style='color:white;'><a href="+feedbackLink+">Leave Task Feedback!</a></p>"+
  // "<p>Please wait for the experimenter to continue.</p>"+
  "<p><i>You may now close the expriment window at anytime.</i></p>",
  choices: jsPsych.NO_KEYS,
  // trial_duration: 60000,
};





