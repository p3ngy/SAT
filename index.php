<?php $title = "Home"; ?>
<?php include("templates\\head.php"); ?>

    <!-- Page specific code goes here -->
    <div class="home-container">
        <div class="sidebar">
            <h3>Welcome!</h3>
            <p>Hi there, welcome to the MG Study Planner.</p>
            <br>
            <p>Here, tasks are orginised by sticky notes like this one right here.</p>
            <br>
            <p>There is also a calendar where you can setup your timetable and other events.</p>
            <br>
            <p>Login or create an account to be more productive today!</p>
            <div id="triangle"></div>
        </div>
        <?php include("login.php"); ?>
        <div class="footer">
            This is a footer :)
        </div>
    </div>

    <!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>
