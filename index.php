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
    <title>Self-Deception Task</title>
    <script src="jsPsych/jspsych.js"></script>
    <script src="jsPsych/plugins/jspsych-html-keyboard-response.js"></script>
    <script src="jsPsych/plugins/jspsych-image-keyboard-response.js"></script>
    <link href="jsPsych/css/jspsych.css" rel="stylesheet" type="text/css"></link>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body  style="background-color:lightgrey;">  
  
  <div class="loading centeredDiv">
    <h1 class="loading">Loading...</h1>
  </div>
  <div id="consentHolder" class="consent centeredDiv">
  <h3 id="consentPreamble" class="consent">In order for us to conduct this test online, we need to include the standard consent form below. <br /> <br /> </h3>
  <div id="consentForm" class="consent consent-box"> 
    <h2 id="consentHeading" class="consent">
      CONSENT FOR PARTICIPATION IN A RESERCH PROJECT 200 FR. 1 (2016-2)
      <br>
      YALE UNIVERSITY SCHOOL OF MEDICINE CONNECTICUT MENTAL HEALTH CENTER
    </h2> 

    <h2>
      
    </h2>
    <p id="consentInstructions" class="consent">
      <b>Study Title:</b> Perception and Decisions
      <br><br>
      <b>Principal Investigator:</b> Philip R. Corlett, PhD
      <br><br>
      <b>Funding Source:</b> department funds
      <br><br>
      <u><b>Invitation to Participate and Description of Project</b></u>
      <br>
      You are invited to participate in a research study that concerns psychological processes related to beliefs, perceptions, decisions, and personality traits. Due to the nature of psychology experiments, we cannot explain the precise purpose of the experiment until after the session is over. Afterwards, the experimenter will be happy to answer any questions you might have about the purpose of the study.
      <br><br>
      <u><b>Description of Procedures</b></u>
      <br>
      If you agree to participate in this study, this Human Intelligence Task (HIT) will require you to (1) play a computer game using the computer mouse or keys on your keyboard and (2) answer simple questions about your demographics, health (including mental health), beliefs, and personality through an interactive web survey. You will never be asked for personally identifiable information such as your name, address, or date of birth. 
      <br>
      The experiment is designed to take approximately 1 hour. You will have up to six hours to complete the experiment and submit codes for credit. 
      <br><br>
      <u><b>Risks and Inconveniences</b></u>
      <br>
      There are little to no risks associated with this study. Some individuals may experience mild boredom. 
      <br><br>
      <u><b>Economic Considerations</b></u>
      <br>
      You will receive the reward specified on the Mechanical-Turk HIT for completing both the game and the questionnaire. Payment for completion of the HIT is $6.00 with up to a $2.00 bonus based on task performance and a further $40 bonus to individuals who score in the top 1%. Upon finishing the game and submitting the questionnaire, you will receive code numbers. Please record these two code numbers and submit them for payment. 
      <br><br>
      <u><b>Confidentiality</b></u>
      <br>
      We will never ask for your name, birth date, email or any other identifying piece of information. Your data will be pooled with those of others, and your responses will be completely anonymous. We will keep this data indefinitely for possible use in scientific publications and presentations. 
      <br>
      The researcher will not know your name, and no identifying information will be connected to your survey answers in any way. The survey is therefore anonymous. However, your account is associated with an mTurk number that the researcher has to be able to see in order to pay you, and in some cases these numbers are associated with public profiles which could, in theory, be searched. For this reason, though the researcher will not be looking at anyone’s public profiles, the fact of your participation in the research (as opposed to your actual survey responses) is technically considered “confidential” rather than truly anonymous.
      <br><br>
      <u><b>Voluntary Participation</b></u>
      <br>
      Your participation in this study is completely voluntary. You are free to decline to participate or to end participation at any time by simply closing your browser window. However, please note that you must submit both the computer game and questionnaire in order to receive payment. You may decline answering any question by selecting the designated alternative response (e.g., “I do not wish to answer”). Declining questions will not affect payment.
      <br><br>
      <u><b>Questions or Concerns</b></u>
      <br>
      If you have any questions or concerns regarding the experiment, you may contact us here at the lab by emailing BLAMLabRequester@gmail.com If you have general questions about your rights as a research participant, you may contact the Yale University Human Investigation Committee at 203-785-4688 or human.subjects@yale.edu (HSC# 2000026290).

    </p>
  </div>


</div>
<div id="attritionHolder" class="attrition centeredDiv"> 
  <p id="attritionInstructions" class="attrition"></p>
  <input required type="text" id="attritionAns" class="attrition" size="60" style="width:inherit; height:17px; font-size:15px; margin: 0 auto;" />
</div>
<div id="errorMessageHolder" class="error centeredDiv">
  <p id="mobileBrowserErrorMessage">You cannot access this test from a mobile browser. Please use a desktop computer to complete the task.</p>
  <p id="workerIDErrorMessage">You are ineligible for this task, since your worker ID has been recorded as participating in this task already. 
    Please return the HIT.</p>
</div>



  <div id="nextButtonHolder" class="buttonHolder">
  <button id="nextButton" onclick="startExperiment()">CONSENT/NEXT</button>
</div>
</body>
  
  <script>

    /* create timeline */
    let timeline = [];

    /* define welcome message trial */
    let welcome = {
      type: "html-keyboard-response",
      stimulus: '<h3 style="color:blue;">Welcome to the experiment!</h3> <p>Press any key to begin.</p>'
    };
    timeline.push(welcome);

    let thank_1 = {
      type:"html-keyboard-response",
      stimulus: '<p>Thank you for agreeing to participate in the study</p>'
    }
    timeline.push(thank_1)

    let instr_1 = {
      type:"html-keyboard-response",
      stimulus:'<p>In the following task, you will be asked to pretend to choose between earning either<br></p>'+
      '<p>A) a little money now <br></p>'+
      '<p> B) a little more money, later</p>'
    }
    timeline.push(instr_1)

    let instr_2 = {
      type:"html-keyboard-response",
      stimulus:'<p>There are no right or wrong answers.<br></p>'+
      '<p> Please take your time, and respond as truthfully as you can</p>'
    }
    timeline.push(instr_2)

    let instr_3 = {
      type:"html-keyboard-response",
      stimulus:'<p>Do you have any questions before we begin?</p>'
    }
    timeline.push(instr_3)

    let instr_4 = {
      type:"html-keyboard-response",
      stimulus:'<p>Get ready...</p>'
    }
    timeline.push(instr_4)


    /* define instructions trial */
    let instructions_1 = {
      type: "html-keyboard-response",
      stimulus: '<p>You will see a series of abstract figures. They are adaptations of signs in the Korean alphabet, but that is not important for this study. </p>' +
        '<p>Abstract figures sometimes have a more masculine or feminine shape. Here, each figure has already been assigned a gender '+
        'as <q>Male</q> or <q>Female</q> by a panel of respondents in a pilot study. The respondents were not given specific instructions on how to do this, '+
        'but were only told to use their intuition and to take into account the entire configuration of the stimulus. </p>'+
        '<p>Your task now is to guess the assigned gender of each figure. Please press the corresponding response keys to indicate your choice: </p>'+
        '<p style="color:blue;"> Male &#8594 <q>1</q> (1 key)</p>'+
        '<p style="color:blue;"> Female &#8594 <q>0</q> (0 key)</p>'+
        '<p style>Press either response keys to continue.</p>',
      choices: ['1', '0'],
    };
    timeline.push(instructions_1);

    let instructions_2 = {
      type: "html-keyboard-response",
      stimulus: '<p>Your choice is correct if it matches the gender assigned by the majority of respondents in the pilot study.</p> ' +
          '<p>For each correct choice you will receive 2 cents. There will be 200 trials divided into 4 blocks of 50 trials. You will be able to take a break after every 50 trials.</p> ' +
          '<p>Press the space bar to continue.</p>',
      choices: [32],
    };
    timeline.push(instructions_2);

    let instructions_3 = {
      type: "html-keyboard-response",
      stimulus: '<p>Here are some examples.</p> ' +
          '<p>For each, guess whether the assigned figure is male-like or female-like and indicate your choice by pressing either response keys.</p> ' +
          '<p>Press the space bar to continue.</p>',
      choices: [32],
      post_trial_gap: 2000
    };
    timeline.push(instructions_3);

    /* START TRAINING TRIAL FOR PARTICIPANTS */

    let now = [54,55,19,31,14,47,15,25,78,40,11,67,34,27,69,49,80,24,33,28,34,25,41,54,54,22,20];
    let after = [55,75,25,85,25,50,35,60,80,55,30,75,35,50,85,60,85,35,80,30,50,30,75,60,80,25,55];
    let days = [117,61,53,7,19,160,13,14,162,62,7,119,186,21,91,89,157,29,14,179,30,80,20,111,30,136,7];
    let stim_array = [];
    for (let i = 0; i < now.length; i++) { 
      stim_array.push
      ('<h1 style="color:blue;"><i>Which would you prefer?</i></h1><br><p">$'
      +`${now[i]}`+' now...  (Press 1)</p>'+'<p style="color:blue;">OR</p>'+'<p>$' +`${after[i]}`+
      ' after '+`${days[i]}`+' days... (Press 0)</p>'
      )
    };
    console.log(stim_array);
    //5 sec delay in end of the ready to begin task and first item
    // 1 sec ISI delay 
    
    let main_stimuli = [
        {stimulus: stim_array[0], 
        data: {test_part: 'experiment', 
        correct_response: ','}},

        {stimulus: stim_array[1], 
        data: {test_part: 'experiment', 
        correct_response: ','}},  

        {stimulus: stim_array[2], 
        data: {test_part: 'experiment', 
        correct_response: '.'}}, 

        {stimulus: stim_array[3], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[4], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[5], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},


        {stimulus: stim_array[6], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[7], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[8], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[9], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[10], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[11], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[12], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[13], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[14], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[15], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[16], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[17], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[18], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[19], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[20], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[21], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[22], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[23], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[24], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[25], 
        data: {test_part: 'experiment', 
        correct_response: '.'}},

        {stimulus: stim_array[26], 
        data: {test_part: 'experiment', 
        correct_response: '.'}}
    ]

    let fixation = {
      type: 'html-keyboard-response',
      stimulus: '<div style="font-size:60px;">+</div>',
      choices: jsPsych.NO_KEYS,
      trial_duration: 1000,
      data: {test_part: 'fixation'}
    }

    let experiment = {
      type: "html-keyboard-response",
      stimulus: jsPsych.timelineVariable('stimulus'), //train_stimuli_array, //jsPsych.timelineVariable('stimulus'),
      choices: ['1', '0'],
      data: jsPsych.timelineVariable('data'),
      on_finish: function(data){
        data.experiment = jsPsych.pluginAPI.convertKeyCodeToKeyCharacter(data.key_press)
        //data.c1 = data.key_press == jsPsych.pluginAPI.convertKeyCharacterToKeyCode(data.correct_response);
        
      }
    }

    let procedures = {
      timeline: [fixation, experiment],
      timeline_variables: main_stimuli,
      randomize_order: false
    }

    timeline.push(procedures);

    /* END TRAINING TRIAL FOR PARTICIPANTS */

    let instructions_4 = {
      type: "html-keyboard-response",
      stimulus: '<p>Let us begin! Press the space bar when you are ready to start block 1 of 4.</p> ',
      choices: [32], //ASCII spacebar
      post_trial_gap: 2000
    };
    timeline.push(instructions_4);

    

/*   var debrief_block = {
      type: "html-keyboard-response",
      stimulus: function(){

        var trials = jsPsych.data.get().filter({test_part: 'test'});
        var correct_trials = trials.filter({correct: true});
        var accuracy = Math.round(correct_trials.count() / trials.count() * 100);
        var rt = Math.round(correct_trials.select('rt').mean());

        return "<p style='color:white;'> You responded correctly on "+accuracy+"% of the trials. </p>"+
        "<p style='color:white;'>Your average response time was "+rt+"ms.</p>"+
        "<p style='color:white;'>Press any key to complete the experiment. Thank you!</p>";
      }
    }; 

     timeline.push(debrief_block); */

    // COMPLETION MESSAGE: Completed Classification Phase
    // var link = "https://survey.az1.qualtrics.com/SE/?SID=SV_9uARDX1aXEXq1pP&Q_JFE=0&workerId="
    let instructions_16 = {
      type: "html-keyboard-response",
      stimulus: '<p">Thank you</p>' 
          // +"<a href=" + link + ' target="_blank">' + link + "</a>",
      // choices: jsPsych.NO_KEYS,
      // trial_duration: 40000
    };
    timeline.push(instructions_16);



    /* END PHASE II OF TASK: CLASSIFICATION and ANTICIPATION PHASE */

function saveData(name, data){
  let xhr = new XMLHttpRequest();
  xhr.open('POST', 'index.php'); // 'write_data.php' is the path to the php file described above.
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(JSON.stringify({filename: name, filedata: data}));
}

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

<!-- <script type="text/javascript" src="https://perceptionexperiments.net/SDU/Libraries/Timeout.js"></script> -->
<!-- <script type="text/javascript" src="https://perceptionexperiments.net/SDU/Libraries/lodash.js"></script> -->
<!-- <script type="text/javascript" src="https://perceptionexperiments.net/SDU/Libraries/seedrandom.js"></script> -->
<script type="text/javascript" src="//code.jquery.com/jquery-git.js"></script>
<!-- <script type="text/javascript" src="https://perceptionexperiments.net/SDU/Libraries/jquery.csv.js"></script> -->

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
