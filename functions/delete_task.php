<?php

include("..\\app.php");
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
