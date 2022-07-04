<nav>
    <ul>
        <li><a href="index.php" style="font-weight: bold;">MG Study Planner</a></li>
        <?php if (!empty($_SESSION['username'])) { echo '<li><a href="tasks.php">tasks</a></li>'; } ?>
        <?php if (!empty($_SESSION['username'])) { echo '<li><a href="calendar.php">calendar</a></li>'; } ?>
        <?php if (!empty($_SESSION['username'])) { echo '<li style="float:right;"><a href="logout.php">logout</a></li>'; } ?>
    </ul>
</nav>