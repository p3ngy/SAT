<?php include("classes\\Task.php"); ?>
<?php include("classes\\Period.php"); ?>
<?php include("classes\\Event.php"); ?>
<?php include("classes\\Calendar.php"); ?>
<?php include("app.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>MGSP <?php if (isset($title)) { echo "| " . $title; } ?></title>
    <link rel="stylesheet" href="css\\style.css">
    <link rel="icon" href="favicon.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/dace878f3d.js" crossorigin="anonymous"></script>
    <?php

    // SORT TASK ARRAY BY PRIORITY
    function sortTasks() {
        usort($_SESSION['tasks'], function ($a, $b) {
            return $a[2] <=> $b[2]; // <=> spaceship operator - php.net/manual/en/language.operators.comparison.php
        });

        foreach($_SESSION['tasks'] as $taskIndex=>$task) {
            if (empty($task[2])) {
                $tmp_task = $task;
                unset($_SESSION['tasks'][$taskIndex]);
                $_SESSION['tasks'][] = $tmp_task;
            }
        }
    }
    
    // SORT TIMETABLE ARRAY BY DAYS AND PERIODS
    function sortPeriods() {
        usort($_SESSION['tmp_timetable'], function ($a, $b) {
            return ($a[4].$a[3]) <=> ($b[4].$b[3]);
        });
    }

    // SAVE SESSION ARRAYS TO CSV
    // save user tasks, events and timetable session arrays to their csv file
    function saveToFile() {
        $username = $_SESSION['username'];
        $tasksFile = new SplFileObject("data\\users\\$username\\tasks.csv", "w");
        $tasksFile->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);

        foreach ($_SESSION['tasks'] as $task) {
            $tasksFile->fputcsv($task);
        }
        $tasksFile = null;

        $eventsFile = new SplFileObject("data\\users\\$username\\events.csv", "w");
        $eventsFile->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);

        foreach ($_SESSION['events'] as $event) {
            $eventsFile->fputcsv($event);
        }
        $eventsFile = null;

        $timetableFile = new SplFileObject("data\\users\\$username\\timetable.csv", "w");
        $timetableFile->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);

        foreach ($_SESSION['timetable'] as $period) {
            $timetableFile->fputcsv($period);
        }
        $timetableFile = null;

        
    }

    // LOAD FILE DATA INTO SESSION ARRAYS
    // load user task, timetable and event data into session arrays
    function loadFromFile() {
        $username = $_SESSION['username'];
        $tasksFile = new SplFileObject("data\\users\\$username\\tasks.csv", "r");
        $tasksFile->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);

        while (!$tasksFile->eof()) {
            foreach ($tasksFile as $row) {
                $_SESSION["tasks"][] = $row;
            }
        }
        $tasksFile = null;

        $eventsFile = new SplFileObject("data\\users\\$username\\events.csv", "r");
        $eventsFile->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);

        while (!$eventsFile->eof()) {
            foreach ($eventsFile as $row) {
                $_SESSION["events"][] = $row;
            }
        }
        $eventsFile = null;

        $timetableFile = new SplFileObject("data\\users\\$username\\timetable.csv", "r");
        $timetableFile->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);

        while (!$timetableFile->eof()) {
            foreach ($timetableFile as $row) {
                $_SESSION["timetable"][] = $row;
            }
        }
        $timetableFile = null;
    }
    ?>
</head>

<body>
    <div class="container">
        <?php include('nav.php'); ?>