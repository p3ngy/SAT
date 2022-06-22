<nav>
    <ul>
        <li id="title">MG Study Planner</li>
        <li><a href="index.php">Home</a></li>
        <?php if (!empty($_SESSION['username'])) { echo '<li><a href="tasks.php">tasks</a></li>'; } ?>
        <?php if (!empty($_SESSION['username'])) { echo '<li style="float:right;"><a href="logout.php">logout</a></li>'; } ?>
    </ul>
</nav>