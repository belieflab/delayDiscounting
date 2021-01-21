let timeline=[];

let welcome={
  type: "html-keyboard-response",
  stimulus: "<p> hello world </p>", 
  choices: [32]
};

// let image={
//   type: "image-keyboard-response",
//   stimulus: "stim/goldenr.jpg", 
//   choices: [32]
// };

// let images={
//   type:"html-keyboard-response", 
//   stimulus: function() {
// var html="<img src='stim/goldenr.jpg'>" + "<img src='stim/german.jpg'>";
// return html;
//   }
// };

let timelineVariable={
  type:"html-keyboard-response", 
  stimulus: function() {
var html="<img src='"+jsPysch.timelineVariable('stimulus', true)+"'>" + "<img src='"+jsPysch.timelineVariable('stimulus2', true)+"'>";
return html;
  }
};

$.getScript('exp/main.js'); //call the main file









