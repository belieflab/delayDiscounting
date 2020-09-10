// let workerID = prompt("Enter your subject id" );

const sir   = [54,55,19,31,14,47,15,25,78,40,11,67,34,27,69,49,80,24,33,28,34,25,41,54,54,22,20];
const ldr = [55,75,25,85,25,50,35,60,80,55,30,75,35,50,85,60,85,35,80,30,50,30,75,60,80,25,55];
const delay  = [117,61,53,7,19,160,13,14,162,62,7,119,186,21,91,89,157,29,14,179,30,80,20,111,30,136,7];

const rewardSize = ['medium', 'large', 'small', 'large', 'small', 'medium', 'small', 'medium', 'large', 'medium', 'small', 'large', 'small', 'medium', 'large', 'medium', 'large', 'small', 'large', 'small', 'medium', 'small', 'large', 'medium', 'large', 'small', 'medium'];

let jitter = [900,1000,1100]; //these will divide evenly by screen refreshes on a 60Hz screen

let stim_array = [];
    for (let i = 0; i < sir.length; i++) { 
      stim_array.push(
        '<h1 style="color:blue;"><i>Which would you prefer?</i></h1>'+
        '<br>'+
        '<p class="bold">$'+
        +`${sir[i]}`+ ' now...&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span style=font-weight:normal;><i>or</i></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+
        '$'+
        +`${ldr[i]}`+ ' after '+`${delay[i]}`+' days...</p>'+
        // '<br>'+
        '<p style=text-align:left;>&nbsp&nbsp&nbsp&nbsp&nbsp (Press 1) &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp (Press 0)</p>',
        // '<p style="color:black;">or</p>'+'<p class="bold">$'

      )
    };

let main_stimuli = [];
    for (let i =0;i<stim_array.length;i++) {
        main_stimuli.push({stimulus: stim_array[i], data: {test_part: 'experiment', short_immediate_reward: sir[i], long_delayed_reward: ldr[i], delay: delay[i], reward_size: rewardSize[i]}})
}

// start indexing 27 trials for consolidated output
let indexIterator = 1;
