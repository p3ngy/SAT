<?php $title = "Tasks"; ?>
<?php include("templates\\head.php"); ?>

<!-- Page specific code goes here -->
<?php
    if (isset($_GET["edit"])) { editTask($_GET["taskIndex"]); }
    if (isset($_GET["submit"])) { saveToFile(); }
?>

<h1 id="greeting">Hello <?php echo $_SESSION["username"]; ?>!</h1>
<div class="tasks-container">
    <div class="task" style="flex-basis: 400px">
        <h3>New Task:</h3>
        <form method="get">
            <input type="text" name="name" id="name" placeholder="Task Name" required><br>
            <input type="date" name="dueDate" id="dueDate" value="<?php echo date("Y-m-d"); ?>" required><br>
            <input name="priority" id="priority" placeholder="Priority (low, med, high)" required><br>
            <input type="text" name="subject" id="subject" placeholder="Subject" required><br>
            <input type="text" name="notes" id="notes" placeholder="Notes" required><br>
            <button type="submit" name="submit" style="width: 100%;">Create new task</button>
        </form>
    </div>
    <?php
        foreach ($_SESSION['tasks'] as $task) {
            $taskIndex = array_search($task, $_SESSION['tasks']);

            if (isset($_GET['task'])) {
                if ($taskIndex == $_GET["task"]) {
                    echo '<div class="task" style="flex-basis: 400px">';
                        echo '<h3>Edit Task:</h3>';
                        echo '<form method="get">';
                            echo '<input type="text" name="name" id="name" value="'.$task[0].'" required><br>';
                            echo '<input type="date" name="dueDate" id="dueDate" value="'.$task[1].'" required><br>';
                            echo '<input name="priority" id="priority" value="'.$task[2].'" required><br>';
                            echo '<input type="text" name="subject" id="subject" value="'.$task[3].'" required><br>';
                            echo '<input type="text" name="notes" id="notes" value="'.$task[4].'" required><br>';
                            echo '<input type="hidden" name="taskIndex" id="taskIndex" value="'.$taskIndex.'">';
                            echo '<button type="submit" name="edit" style="width: 100%;">Confirm</button>';
                        echo '</form>';
                    echo '</div>';
                } else {
                    echo '<div class="task">';
                    echo '<h3>'.$task[0].'</h3><br>';
                    echo '<p><em>Due date: </em>'.(new DateTime($task[1]))->format("d/m/y").'</p><br>';
                    echo '<p id="priority"><em>Priority: </em>'.$task[2].'</p><br>';
                    echo '<p><em>Subject: </em>'.$task[3].'</p><br>';
                    echo '<p><em>Notes: </em>'.$task[4].'</p><br>';
                    echo '<a href="tasks.php?task='.$taskIndex.'"><button>Edit</button></a>';
                    echo '<a href="functions\\delete_task.php?task='.$taskIndex.'"><button>Remove</button></a>';
                    echo '</div>';
                }
            } else {
                echo '<div class="task">';
                echo '<h3>'.$task[0].'</h3><br>';
                echo '<p><em>Due date: </em>'.(new DateTime($task[1]))->format("d/m/y").'</p><br>';
                echo '<p id="priority"><em>Priority: </em>'.$task[2].'</p><br>';
                echo '<p><em>Subject: </em>'.$task[3].'</p><br>';
                echo '<p><em>Notes: </em>'.$task[4].'</p><br>';
                echo '<a href="tasks.php?task='.$taskIndex.'"><button>Edit</button></a>';
                echo '<a href="functions\\delete_task.php?task='.$taskIndex.'"><button>Remove</button></a>';
                echo '</div>';
            }
            
        }
    ?>
</div>


<!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>