let association={
    timeline:[timelineVariable], 
    timeline_variables:expStim //instead we would have assocStim in var.js for this
}
let reward={
    timeline:[timelineVariable], 
    timeline_variables:expStim //instead of expStim we would create rewardStim in var.js for this
}
let choice={
    timeline:[timelineVariable], 
    timeline_variables:expStim
}
timeline.push(welcome);
timeline.push(image1);
timeline.push(multimages);
timeline.push(association);
timeline.push(reward);
timeline.push(choice);
