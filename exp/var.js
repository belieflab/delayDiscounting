let rewardArray=[];
// for (let i=0; i<5; i++) { //i++ means increasing i by 1
// stimArray.push("stim/golden_puppy.jpg"); 
// }
for (let i=1; i<3; i++) { //i++ means increasing i by 1
  rewardArray.push("stim/golden_puppy_"+i+".jpg"); //could put stimulus number as i and keep that in the for loop
  }

let associationArray=[];
// for (let i=0; i<5; i++) { //i++ means increasing i by 1
// stimArray.push("stim/golden_puppy.jpg"); 
// }
for (let i=1; i<3; i++) { //i++ means increasing i by 1
  associationArray.push("stim/golden_puppy_"+i+".jpg"); //could put stimulus number as i and keep that in the for loop
  }
let expStim=[
  {stimulus:associationArray[0],stimulus2:rewardArray[0]},
  {stimulus:associationArray[1],stimulus2:rewardArray[1]}
];
