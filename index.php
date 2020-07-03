<?php
$post_data = json_decode(file_get_contents('php://input'), true); 
// the directory "data" must be writable by the server
$name = "data/".$post_data['filename'].".csv"; 
$data = $post_data['filedata'];
// write the file to disk
file_put_contents($name, $data);
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Delay Discounting</title>
    <script src="js/saveData.js"></script>
    <script src="js/countdown.js"></script>
    <script src="jsPsych/jspsych.js"></script>
    <script src="jsPsych/plugins/jspsych-html-keyboard-response.js"></script>
    <script src="jsPsych/plugins/jspsych-image-keyboard-response.js"></script>
    <link href="jsPsych/css/jspsych.css" rel="stylesheet" type="text/css"></link>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body  style="background-color: white;">  
    <?php include "include/consent.php"?>
  </body>
  
  <script>

    /* create timeline */
    let timeline = [];

    /* define welcome message trial */
    let welcome = {
      type: "html-keyboard-response",
      stimulus: '<h3 style="color:blue;">Welcome to the experiment!</h3> <p>Press any key to begin.</p>',
    };
    timeline.push(welcome);

    let thank_1 = {
      type:"html-keyboard-response",
      stimulus: '<p>Thank you for agreeing to participate in the study.</p>'+
      '<p>Press the spacebar continue.</p>',
      choices: [32],
    }
    timeline.push(thank_1)

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
    timeline.push(instr_1)

    let instr_2 = {
      type:"html-keyboard-response",
      stimulus:'<p>To make your selection on each trial:<br></p>'+
      '<p><strong>press the <u>1</u> key</strong><br></p>'+
      '<p>or</p>'+
      '<p><strong>press the <u>0</u> key</strong><br><br>'+
      '<p>Press either of the response keys to continue.</p>',
      choices: ['1', '0'],
    }
    timeline.push(instr_2)

    let instr_3 = {
      type:"html-keyboard-response",
      stimulus:'<p>There are no right or wrong answers.<br></p>'+
      '<p> Please take your time, and respond as truthfully as you can.</p>'+
      '<p>Press the spacebar continue.</p>',
      choices: [32],
    }
    timeline.push(instr_3)

    let instr_4 = {
      type:"html-keyboard-response",
      // stimulus:'<p style="color:black;" id="countdown">00:30</p>',
      stimulus: '<p style="color:black;"> Get Ready...</p>',
      
      trial_duration: 2000,
    }
    timeline.push(instr_4)

    let instr_5 = {
      type:"html-keyboard-response",
      stimulus:'<p style="color:black; font-size:60px;" id="countdown"></p>',
      trial_duration: 6000,
      on_load: timer(),
      }
    timeline.push(instr_5)



    /* START TRAINING TRIAL FOR PARTICIPANTS */

    let now = [54,55,19,31,14,47,15,25,78,40,11,67,34,27,69,49,80,24,33,28,34,25,41,54,54,22,20];
    let after = [55,75,25,85,25,50,35,60,80,55,30,75,35,50,85,60,85,35,80,30,50,30,75,60,80,25,55];
    let days = [117,61,53,7,19,160,13,14,162,62,7,119,186,21,91,89,157,29,14,179,30,80,20,111,30,136,7];
    // let correctResponse = [,	,	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.	.]
    let stim_array = [];
    for (let i = 0; i < now.length; i++) { 
      stim_array.push
      ('<h1 style="color:blue;"><i>Which would you prefer?</i></h1><br><p class="bold">$'
      +`${now[i]}`+' now...&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  (Press 1)</p>'+'<p style="color:black;">or</p>'+'<p class="bold">$' +`${after[i]}`+
      ' after '+`${days[i]}`+' days...&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp (Press 0)</p>'
      )
    };
    // console.log(stim_array);
    //5 sec delay in end of the ready to begin task and first item
    // 1 sec ISI delay 
    
    let main_stimuli = [
        {trial: stim_array[0], 
        data: {test_part: 'experiment', 
        correct_response: ','}},

        {trial: stim_array[1], 
        data: {test_part: 'experiment', 
        correct_response: ','}},  

        {trial: stim_array[2], 
        data: {test_part: 'experiment', 
        correct_response: '.'}}, 

        {trial: stim_array[3], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[4], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[5], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[6], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[7], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[8], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[9], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[10], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[11], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[12], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[13], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[14], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[15], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[16], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[17], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[18], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[19], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[20], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[21], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[22], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[23], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[24], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[25], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {trial: stim_array[26], 
        data: {test_part: 'experiment', 
        correct_response: '.'}}
    ]

    let fixation = {
      type: 'html-keyboard-response',
      stimulus: '<div style="font-size:60px;">+</div>',
      choices: jsPsych.NO_KEYS,
      trial_duration: 1000, //jsPsych.timelineVariable('jitter'),
      data: {test_part: 'fixation'},
    }

    let trial = {
      type: "html-keyboard-response",
      stimulus: jsPsych.timelineVariable('trial'), //train_stimuli_array, //jsPsych.timelineVariable('trial'),
      choices: ['1', '0'],
      data: jsPsych.timelineVariable('data'),
      on_finish: function(data){
        data.experiment = jsPsych.pluginAPI.convertKeyCodeToKeyCharacter(data.key_press)
        //data.c1 = data.key_press == jsPsych.pluginAPI.convertKeyCharacterToKeyCode(data.correct_response);
        
      }
    }

    let procedure = {
      timeline: [fixation, trial],
      timeline_variables: main_stimuli,
      randomize_order: false,
    }

    timeline.push(procedure);


    /* END TRAINING TRIAL FOR PARTICIPANTS */


    // COMPLETION MESSAGE: Completed Classification Phase
    // var link = "https://survey.az1.qualtrics.com/SE/?SID=SV_9uARDX1aXEXq1pP&Q_JFE=0&workerId="
    let thankyou = {
      type: "html-keyboard-response",
      stimulus: '<p">Thank you.</p>', 
          // +"<a href=" + link + ' target="_blank">' + link + "</a>",
      // choices: jsPsych.NO_KEYS,
      trial_duration: 5000,
    };
    timeline.push(thankyou);



    /* END PHASE II OF TASK: CLASSIFICATION and ANTICIPATION PHASE */



    //var this_seed = new Date().getTime();
    //Math.seedrandom(this_seed);

    //var randNum = Math.random() * 1000
    //var randNumRounded = Math.floor(randNum+1)
    function getParamFromURL(name)
    {
      name = name.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]");
      let regexS = "[\?&]"+name+"=([^&#]*)";
      let regex = new RegExp( regexS );
      let results = regex.exec( window.location.href );
      if( results == null )
        return "";
      else
        return results[1];
    }
    let workerID = prompt("Enter your subject id" );

    /* start the experiment */
    function startExperiment(){
      jsPsych.init({
        timeline: timeline,
        show_progress_bar: true,
        on_finish: function(){ saveData("delay-discounting" + workerID, jsPsych.data.get().csv()); }
        //on_finish: function(){
          //jsPsych.data.get().filter([{test_part: 'test'},{test_part: 'prediction'},{test_part: 'c2_test'}]).localSave("csv", `test-self-deception-data.csv`);
            //jsPsych.data.displayData(); 
        //}
      });
    }
  </script>

<footer>

<script type="text/javascript" src="//code.jquery.com/jquery-git.js"></script>

<script>
// show page when loaded 
window.onload = function() {
  $(".loading").css({display: "none"});
  $(".consent").css({display: "block"});
  $(".buttonHolder").css({display: "block"});
};
</script>
</footer>
  </html>
