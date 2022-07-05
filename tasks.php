<?php $title = "Tasks"; ?>
<?php include("templates\\head.php"); ?>

<!-- Page specific code goes here -->
<?php

if (isset($_GET["edit"])) {
    $task = new Task($_GET['name'], $_GET['dueDate'], $_GET['priority'], $_GET['subject'], $_GET['notes']);
    $_SESSION["tasks"][$_GET["taskIndex"]] = $task->asArray();
    sortTasks();
    saveToFile();
}

if (isset($_GET["submit"])) {
    $task = new Task($_GET['name'], $_GET['dueDate'], $_GET['priority'], $_GET['subject'], $_GET['notes']);
    $_SESSION["tasks"][] = $task->asArray();
    sortTasks();
    saveToFile();
}
?>

<div class="tasks-container">
    <div class="task">
        <h3 style="margin-bottom: 0.25em;">New Task:</h3>
        <form method="get">
            <input type="text" name="name" id="name" placeholder="Task Name" required><br>
            <input type="text" name="dueDate" id="dueDate" placeholder="Due Date" onfocus="(this.type='date')"><br>
            <input type="number" name="priority" id="priority" min="1" max="5" placeholder="Priority (1 - 5)" <br>
            <input type="text" name="subject" id="subject" placeholder="Subject" required><br>
            <input type="text" name="notes" id="notes" placeholder="Notes" required><br>
            <button type="submit" name="submit" id="newTask">Create new task</button>
        </form>
    </div>
    <?php
    foreach ($_SESSION['tasks'] as $task) {
        $taskIndex = array_search($task, $_SESSION['tasks']);

        if (isset($_GET['task'])) {
            if ($taskIndex == $_GET["task"]) {
                if ($task[2] == 1) {
                    echo '<div style="border: 6px solid #ff173e; box-shadow: inset 0 0 12px #ff173e;" class="task">';
                } else {
                    echo '<div class="task">';
                }
                echo '<h3 style="margin-bottom: 0.25em;">Edit Task:</h3>';
                echo '<form method="get">';
                echo '<input type="text" name="name" id="name" value="' . $task[0] . '" required><br>';
                echo '<input type="date" name="dueDate" id="dueDate" value="' . $task[1] . '" required><br>';
                echo '<input type="number" name="priority" id="priority" min="1" max="5" value="' . $task[2] . '"<br>';
                echo '<input type="text" name="subject" id="subject" value="' . $task[3] . '" required><br>';
                echo '<input type="text" name="notes" id="notes" value="' . $task[4] . '" required><br>';
                echo '<input type="hidden" name="taskIndex" id="taskIndex" value="' . $taskIndex . '">';
                echo '<button type="submit" name="edit" id="newTask">Confirm</button>';
                echo '</form>';
                echo '</div>';
            } else {
                if ($task[2] == 1) {
                    echo '<div style="border: 6px solid #ff173e; box-shadow: inset 0 0 12px #ff173e;" class="task">';
                } else {
                    echo '<div class="task">';
                }
                echo '<h3>' . $task[0] . '</h3><br>';
                echo '<p><em>Due date: </em>' . (new DateTime($task[1]))->format("d/m/y") . '</p><br>';
                echo '<p id="priority"><em>Priority: </em>' . $task[2] . '</p><br>';
                echo '<p><em>Subject: </em>' . $task[3] . '</p><br>';
                echo '<p><em>Notes: </em>' . $task[4] . '</p><br>';
                echo '<div id="icons">';
                echo '<a href="tasks.php?task=' . $taskIndex . '"><button><i class="fa-solid fa-pen fa-xl"></i></button></a>';
                echo '<a href="functions\\delete_task.php?task=' . $taskIndex . '"><button><i class="fa-solid fa-trash fa-xl"></i></button></a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            if ($task[2] == 1) {
                echo '<div style="border: 6px solid #ff173e; box-shadow: inset 0 0 12px #ff173e;" class="task">';
            } else {
                echo '<div class="task">';
            }
            echo '<h3>' . $task[0] . '</h3><br>';
            echo '<p><em>Due date: </em>' . (new DateTime($task[1]))->format("d/m/y") . '</p><br>';
            echo '<p id="priority"><em>Priority: </em>' . $task[2] . '</p><br>';
            echo '<p><em>Subject: </em>' . $task[3] . '</p><br>';
            echo '<p><em>Notes: </em>' . $task[4] . '</p><br>';
            echo '<div id="icons">';
            echo '<a href="tasks.php?task=' . $taskIndex . '"><button><i class="fa-solid fa-pen fa-xl"></i></button></a>';
            echo '<a href="functions\\delete_task.php?task=' . $taskIndex . '"><button><i class="fa-solid fa-trash fa-xl"></i></button></a>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</div>


<!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>