<?php

$questions = file('questions.txt', FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$questions = array_unique($questions);

shuffle($questions);


foreach ($questions as $k => $v) {
    echo '<b>' . $k . '</b>' . '<br>' . $v . '<br>';
}


//var_dump($questions);