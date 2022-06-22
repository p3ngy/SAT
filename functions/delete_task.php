<?php

include("..\\app.php");
echo '<pre>';
print_r($_GET);
print_r($_SESSION);
echo '</pre>';

// remove from SESSION array
unset($_SESSION['tasks'][$_GET['task']]);

// update file
$username = $_SESSION['username'];
$tasksFile = new SplFileObject("..\\data\\users\\$username\\tasks.csv", "w");
$tasksFile->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);

foreach ($_SESSION['tasks'] as $task) {
    $tasksFile->fputcsv($task);
}
$tasksFile = null;

header("location: ..\\tasks.php");
