#!/bin/bash

DIRECTORY="./wrap"

if [ ! -d "$DIRECTORY" ]; then

    while true; do
        echo "Would you like to use jsPsych version 6 or version 7? (Enter 6 or 7):"
        read version

        if [ "$version" == "6" ]; then
            echo "You selected the jsPsych version 6.3 wrapper."
            break  # Exit the loop after valid input
        elif [ "$version" == "7" ]; then
            echo "You selected the jsPsych version 7.x wrapper."
            break  # Exit the loop after valid input
        else
            echo "Invalid input. Please enter 6 or 7."
        fi
    done

    # 6.3 and 7.x have different folder structures
    git submodule add git@github.com:belieflab/jsPsychWrapper-v7.x.git wrap > /dev/null 2>&1

fi

echo "Cloning template files..."
echo "/* add local styling here */" >> ./css/exp.css

# Sandy: only add these files if they dont exist
cp -rf ./wrap/tmp/conf.js ./exp/conf.js
cp -rf ./wrap/tmp/lang.js ./exp/lang.js


cp -rf ./wrap/tmp/var.php ./exp/var.php

echo "// add local functions here" >> ./exp/fn.js

echo "Creating symbolic links..."
cp ./wrap/link/data.php ./data.php
cp ./wrap/link/redirect.php ./redirect.php
cp ./wrap/link/sync.sh ./sync.sh





echo "jsPsych $version PHP wrapper has been installed successfully!"
