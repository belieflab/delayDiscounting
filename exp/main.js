/* define procedures trial */

let instructions = {
  timeline: [welcome, instr_1, instr_2, instr_3, instr_4, instr_5]
};

let procedures = {
  timeline: [fixation, trial],
  timeline_variables: main_stimuli,
  randomize_order: false,
};
  
/* main */
timeline.push(instructions);
timeline.push(procedures);
timeline.push(save_data);
timeline.push(end);
// don't allow experiment to start unless subjectId is set
if (subjectId) {
    // Old jsPsych 6.3 syntax
    startExperiment();
}