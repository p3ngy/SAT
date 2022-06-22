<?php include("classes\\Task.php"); ?>
<?php include("app.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>MGSP <?php if (isset($title)) {
                echo "| " . $title;
              } ?></title>
  <link rel="stylesheet" href="css\\style.css">
  <?php
  /**
   * SAVE AND LOAD ARRAYS TO AND FROM FILE
   */

  function saveToFile() { //TODO - add events and timetable...
    $task = new Task($_GET['name'], $_GET['dueDate'], $_GET['priority'], $_GET['subject'], $_GET['notes']);
    $_SESSION["tasks"][] = $task->asArray();

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