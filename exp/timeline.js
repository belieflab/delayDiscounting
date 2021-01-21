// create an array called timeline 
// = is assign 
// empty arrays are indicated with square brackets 
let timeline=[];

// create an object 
// objects are denoted with {}
// type, stimulus, choice are properties 
let welcome={
  type: "html-keyboard-response",
  stimulus: "<p> hello world </p>",
  choices: [32]
};

let image={
  type: "image-keyboard-response",
  stimulus: "stim/goldenr.jpg",
  choices: [32]
};

// use of multiple images using html keyboard response 
// let images={
//   type:"html-keyboard-response",
//   stimulus: function() {
// var html="<img src='stim/goldenr.jpg'>" + "<img src='stim/german.jpg'>";
// return html;
//   }
// };

let timelineVariable = {
  type: "html-keyboard-response", 
  stimulus: function(){
    var html="<img src='"+jsPsych.timelineVariable('stimulus', true)+"'>" +
    "<img src='"+jsPsych.timelineVariable('stimulus2', true)+"'>";
    return html;
  }
};

$.getScript('exp/main.js'); //call the main file









