let stimArray= [];

for (let i=1; i<6; i++) {
  stimArray.push("stim/dog_"+i+".jpg");
}

let expStim= [
  { stimulus: stimArray[0], stimulus2: stimArray[1]},
  { stimulus: stimArray[2], stimulus2: stimArray[3]}
];
