let timeline=[];

let welcome={
  type: "html-keyboard-response",
  stimulus: "<p> hello world </p>",
  choices: [32] //choices restricts buttons to only the ones in the array -32 is the space bar, you can google search ascii keyboard values
};
let image1={
  type: "image-keyboard-response",
  stimulus: "stim/golden_puppy.jpg",
  choices: [32] //choices restricts buttons to only the ones in the array -32 is the space bar, you can google search ascii keyboard values
};
let multimages={ //created images with html function this time
  type: "html-keyboard-response",
  stimulus: function dogs() {
var html="<img src='stim/golden_puppy.jpg' height='200px' width='200px'>" + "<img src='stim/golden_puppy.jpg' height='200px' width='200px'>" ;
return html;

  }
};
let timelineVariable={ 
    type: "html-keyboard-response",
    stimulus: function dogs() {
  var html="<img src='"+jsPsych.timelineVariable('stimulus', true)+"'>" + "<img src='"+jsPsych.timelineVariable('stimulus2', true)+"'>";
  return html;
  
    }
};
$.getScript('exp/main.js'); //call the main file







