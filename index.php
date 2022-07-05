<?php $title = "Home"; ?>
<?php include("templates\\head.php"); ?>

    <!-- Page specific code goes here -->
    <div class="home-container">
        <div class="sidebar">
            <h3>Welcome!</h3>
            <br>
            <p>Hi there, welcome to the MG Study Planner.</p>
            <br>
            <p>Here, tasks are orginised by sticky notes like this one right here.</p>
            <br>
            <p>There is also a calendar where you can setup your timetable and other events.</p>
            <br>
            <p>Login or create an account to be more productive today!</p>
            <div id="triangle"></div>
        </div>
        <?php 
            if (empty($_SESSION['username'])) {
                include("login.php"); 
            } else {
                echo 
                '
                <div class="home">
                    <h3>Hi there, '.$_SESSION['username'].'!</h3>
                    <br>
                    <p>View your tasks or calendar here: </p>
                    <br>
                    <a href="tasks.php" class="links">tasks</a>
                    <a href="calendar.php" class="links">calendar</a>
                    <br><br><br>
                    <p>And here\'s an inspirational quote because why not:</p>
                    <br>
                    <script type="text/javascript" src="https://www.brainyquote.com/link/quotebr.js"></script>
                </div>
                ';
            }
        ?>
        
    </div>

    <!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>
