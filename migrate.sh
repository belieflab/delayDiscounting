#!/bin/bash

DIRECTORY="./wrap"
INDEX_FILE="./index.php"

# Check if the wrap directory exists: 
if [ ! -d "$DIRECTORY" ]; then

    while true; do
        echo "Would you like to use jsPsych version 6 or version 7? (Enter 6 or 7):"
        read version

        if [ "$version" == "6" ]; then
            echo "You selected the jsPsych version 6.3 wrapper."
            break  
        elif [ "$version" == "7" ]; then
            echo "You selected the jsPsych version 7.x wrapper."
            break  
        else
            echo "Invalid input. Please enter 6 or 7."
        fi
    done

    # 6.3 and 7.x have different folder structures
    git submodule add git@github.com:belieflab/jsPsychWrapper-v7.x.git wrap > /dev/null 2>&1

fi

echo "Cloning template files..."
echo "/* add local styling here */" >> ./css/exp.css

# Only add the conf.js and lang.js files from the v7 folder if they dont already exist: 
SOURCE_DIR="./wrap/tmp/v7"
DEST_DIR="./exp"

FILES=("conf.js" "lang.js")

for file in "${FILES[@]}"; do
    if [ ! -f "$DEST_DIR/$file" ]; then
        cp -rf "$SOURCE_DIR/$file" "$DEST_DIR/$file"
        echo "Copied $file to $DEST_DIR"
    else
        echo "$file already exists in $DEST_DIR."
    fi
done

echo "File copy operation completed."

cp -rf ./wrap/tmp/var.php ./exp/var.php

echo "Creating symbolic links..."
cp ./wrap/link/data.php ./data.php
cp ./wrap/link/redirect.php ./redirect.php
cp ./wrap/link/sync.sh ./sync.sh

echo "Updating PHP file..."
cat <<EOL > $INDEX_FILE
<?php
require_once './wrap/lib/ids.php';
?>

<!DOCTYPE html>
<html>
<head>
    <!-- add the title of the experiment that would be seen in the browser -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
        document.title = `${experimentAlias.toUpperCase()}`;
        });
    </script>
    <!-- favicon -->
    <link rel="icon" type="image/ico" href="./wrap/favicon.ico">
    <!-- PHP wrapper libraries -->
    <script type="text/javascript" src="./wrap/lib/validate.js"></script>
    <script type="text/javascript" src="./wrap/lib/jquery-3.5.1.min.js"></script>
    <!-- jsPsych library -->
    <script type="text/javascript" src="./wrap/jspsych/jspsych.js"></script>
    <!-- jsPsych Plugins (add more here) -->
    <script type="text/javascript" src="./wrap/jspsych/plugins/jspsych-html-keyboard-response.js"></script>
    <script type="text/javascript" src="./wrap/jspsych/plugins/jspsych-image-keyboard-response.js"></script>
    <script type="text/javascript" src="./wrap/jspsych/plugins/jspsych-video-keyboard-response.js"></script>
    <link href="./wrap/jspsych/css/jspsych.css" rel="stylesheet" type="text/css">
    <!-- general styling -->
    <link rel="stylesheet" type="text/css" href="./wrap/lib/style.css">
    <!-- additional styling -->
    <link rel="stylesheet" type="text/css" href="./css/exp.css">
</head>
<body id='unload' onbeforeunload="return areYouSure()">
<?php
    if (isset($_GET["workerId"]) || isset($_GET["PROLIFIC_PID"]) || isset($_GET["participantId"])) {
      include_once "./wrap/include/consent.php";
    } else if (isset($_GET["src_subject_id"])) {
      include_once "./wrap/include/nda.php";
    } else {
      include_once "./wrap/include/intake.php";
    }
  ?>
</body>
<footer>
    <!-- load config first! -->
    <script type="text/javascript" src="./exp/conf.js"></script>
    <!-- load wrapper dependencies -->
    <script type="text/javascript" src="./wrap/lib/fn.js"></script>
    <!-- load experiment dependencies -->
    <script type="text/javascript" src="./exp/fn.js"></script>
    <script type="text/javascript" src="./exp/var.js"></script>
</footer>
</html>
EOL

echo "PHP file has been updated successfully."

# Overwrite the ./exp/fn.js file with only the countdown function:
cat <<EOL > ./exp/fn.js
function countdown(){ // initialize timer
    var sec = 5; // set timer in seconds
    var timer = setInterval(function(){
    document.getElementById('countdown').innerHTML=sec;
    sec--;
    if (sec > 1) {
      jsPsych.endCurrentTimeline();
      }
    }, 1000);
  }
EOL

# Add the startExperiment function at the top of the ./exp/timeline.js file: 
TIMELINE_FILE="./exp/timeline.js"

START_EXPERIMENT_CODE="startExperiment = () => {
    jsPsych.init({
        timeline: timeline,
        show_progress_bar: true,
        preload_images: [],
        preload_audio: [],
        preload_video: [],
    });
};"

# Add subjectId check to the end of the exp/main.js file:
MAIN_FILE="./exp/main.js"

cat <<EOL >> "$MAIN_FILE"

// don't allow experiment to start unless subjectId is set
if (subjectId) {
    // Old jsPsych 6.3 syntax
    startExperiment();
}
EOL

echo "subjectId check appended to $MAIN_FILE"

# Remove the whole ./db folder from the project: 
rm -rf ./db
echo "Removed the ./db folder from the project"

# Remove the style.css file from ./css folder:
rm -f ./css/style.css
echo "Removed the style.css file from the ./css folder"

# Replace let trial in exp/timeline.js with new block adding writeCandidateKeys(data) to it:
awk '
/let trial = {/ {
    print $0
    print "  type: \"html-keyboard-response\","
    print "  stimulus: jsPsych.timelineVariable('\''stimulus'\''), //train_stimuli_array, //jsPsych.timelineVariable('\''stimulus'\''),"
    print "  choices: ['\''1'\'', '\''0'\''],"
    print "  data: jsPsych.timelineVariable('\''data'\''),"
    print "  on_finish: function(data) {"
    print "    writeCandidateKeys(data);"
    print "    indexIterator++;"
    print "    let response = jsPsych.pluginAPI.convertKeyCodeToKeyCharacter(data.key_press);"
    print "    if (response == 0) {"
    print "      data.response = '\''ldr'\'';"
    print "    } else if (response == 1) {"
    print "      data.response = '\''sir'\'';"
    print "    }"
    print "  }"
    print "};"
    p=1
    next
}
/};/ && p {
    p=0
    next
}
!p {
    print
}
' ./exp/timeline.js > tmp && mv tmp ./exp/timeline.js

# Replace let save_data in ./exp/timeline.js with const dataSave from ./wrap/tmp/v6/: 

echo "jsPsych $version PHP wrapper has been installed successfully!"

echo "$START_EXPERIMENT_CODE" | cat - "$TIMELINE_FILE" > temp && mv temp "$TIMELINE_FILE"
echo "startExperiment function prepended to "$TIMELINE_FILE" 


