<nav class="nav" id="nav">
    <a href="index.php" id="title"><i class="fa-solid fa-note-sticky"></i> MG Study Planner</a>
    <?php if (!empty($_SESSION['username'])) { echo '<a href="tasks.php">tasks</a>'; } ?>
    <?php if (!empty($_SESSION['username'])) { echo '<a href="calendar.php">calendar</a>'; } ?>
    <?php if (!empty($_SESSION['username'])) { echo '<a href="logout.php" style="font-weight: bold; float: right;">logout</a>'; } ?>
    <?php if (!empty($_SESSION['username'])) { echo '<a href="javascript:void(0);" class="icon" onclick="navFunction()"><i class="fa-solid fa-bars"></i></a>'; } ?>
</nav>