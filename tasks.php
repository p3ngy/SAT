<?php $title = "Tasks"; ?>
<?php include("templates\\head.php"); ?>

<!-- Page specific code goes here -->
<?php
if (isset($_GET["submit"])) {
    saveToFile();
}
?>

<h1 id="greeting">Hello <?php echo $_SESSION["username"]; ?>!</h1>
<div class="tasks">
    <h3>New Task:</h3>
    <form method="get">
        <!--TODO: placeholder for dates, validation for input formats  -->
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Exercise 7B" required>
        <br>
        <label for="dueDate">Due date:</label>
        <input type="datetime-local" name="dueDate" id="dueDate" required>
        <br>
        <label for="priority">Priority: (low, med, high)</label>
        <input name="priority" id="priority" placeholder="med" required>
        <br>
        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject" placeholder="Maths" required>
        <br>
        <label for="notes">Notes:</label>
        <input type="text" name="notes" id="notes" placeholder="update summary book with exercise notes" required>
        <br>
        <button type="submit" name="submit">Create new task</button>
    </form>
</div>

<?php
foreach ($_SESSION['tasks'] as $task) {
    echo '<div class="tasks"><pre>';
    print_r($task);
    echo '<a href="functions\\delete_task.php?task='.array_search($task, $_SESSION['tasks']).'">Remove</a>';
    echo '</div></pre>';
}
?>

<!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>