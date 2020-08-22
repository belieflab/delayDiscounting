/* create timeline */
let timeline = [];

let welcome = {
    type: "html-keyboard-response",
    stimulus: '<h3 style="color:blue;">Welcome to the experiment!</h3> <p>Press any key to begin.</p>',
  };
  
  let thank_1 = {
    type:"html-keyboard-response",
    stimulus: '<p>Thank you for agreeing to participate in the study.</p>'+
    '<p>Press the spacebar continue.</p>',
    choices: [32],
  }
  
  let instr_1 = {
    type:"html-keyboard-response",
    stimulus:'<p>In the following task, you will be asked to pretend to choose between earning either:<br><br></p>'+
    '<p><strong>a little money now</strong><br></p>'+
    '<p>or</p>'+
    '<p><strong>a little more money, later</strong></p>'+
    '<br>'+
    '<p>Press the spacebar continue.</p>',
    choices: [32],
  }
  
  let instr_2 = {
    type:"html-keyboard-response",
    stimulus:'<p>To make your selection on each trial:<br></p>'+
    '<p><strong>press the <u>1</u> key</strong><br></p>'+
    '<p>or</p>'+
    '<p><strong>press the <u>0</u> key</strong><br><br>'+
    '<p>Press either of the response keys to continue.</p>',
    choices: ['1', '0'],
  }
  
  let instr_3 = {
    type:"html-keyboard-response",
    stimulus:'<p>There are no right or wrong answers.<br></p>'+
    '<p> Please take your time, and respond as truthfully as you can.</p>'+
    '<p>Press the spacebar continue.</p>',
    choices: [32],
  }
  
  let instr_4 = {
    type:"html-keyboard-response",
    // stimulus:'<p style="color:black;" id="countdown">00:30</p>',
    stimulus: '<p style="color:black;"> Get Ready...</p>',
    
    trial_duration: 2000,
  }
  
  let instr_5 = {
    type:"html-keyboard-response",
    stimulus:'<p style="color:black; font-size:60px;" id="countdown"></p>',
    trial_duration: 5500,
    on_start: countdown(),
    response_ends_trial: false,
    }

  let fixation = {
    type: 'html-keyboard-response',
    stimulus: '<div style="font-size:60px;">+</div>',
    choices: jsPsych.NO_KEYS,
    trial_duration: 1000,
    data: {test_part: 'fixation'},
  }
  
  let trial = {
    type: "html-keyboard-response",
    stimulus: jsPsych.timelineVariable('stimulus'), //train_stimuli_array, //jsPsych.timelineVariable('stimulus'),
    choices: ['1', '0'],
    data: jsPsych.timelineVariable('data'),
    on_finish: function(data){
      data.experiment = jsPsych.pluginAPI.convertKeyCodeToKeyCharacter(data.key_press)
      //data.c1 = data.key_press == jsPsych.pluginAPI.convertKeyCharacterToKeyCode(data.correct_response);
    }
  }

  let thankyou = {
    type: "html-keyboard-response",
    stimulus: '<p>You have completed the experiment. Thank you.</p>', 
        // +"<a href=" + link + ' target="_blank">' + link + "</a>",
    // choices: jsPsych.NO_KEYS,
    trial_duration: 5000,
  };