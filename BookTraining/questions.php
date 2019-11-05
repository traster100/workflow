<meta charset='utf-8'>
<title>Вопросы</title>

<?php

$questions = file('questions.txt', FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$questions = array_unique($questions);

shuffle($questions);

foreach ($questions as $k => $v) {
  echo '<p><b>' . $k . '</b></p>';
  echo '<p>' . $v . '</p>';
}