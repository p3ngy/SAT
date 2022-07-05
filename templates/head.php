<?php include("classes\\Task.php"); ?>
<?php include("app.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>MGSP <?php if (isset($title)) { echo "| " . $title; } ?></title>
    <link rel="stylesheet" href="css\\style.css">
    <script src="https://kit.fontawesome.com/dace878f3d.js" crossorigin="anonymous"></script>
    <?php

    // SORT BY PRIORITY
    function sortTasks() {
        usort($_SESSION['tasks'], function ($a, $b) {
            return $a[2] <=> $b[2];
        });
    }


    //SAVE AND LOAD ARRAYS TO AND FROM FILE
    function saveToFile() {
        $username = $_SESSION['username'];
        $tasksFile = new SplFileObject("data\\users\\$username\\tasks.csv", "w");
        $tasksFile->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);

        foreach ($_SESSION['tasks'] as $task) {
            $tasksFile->fputcsv($task);
        }
        $tasksFile = null;
    }

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
    }
    ?>
</head>

<body>
    <div class="container">
        <?php include('nav.php'); ?>