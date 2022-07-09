<?php $title = "Calendar"; ?>
<?php include("templates\\head.php"); ?>

    <!-- Page specific code goes here -->

    <?php 
        if (isset($_GET['createEvent'])) {
            $event = new Event($_GET['name'], $_GET['startDateTime'], $_GET['endDateTime'], $_GET['category'], $_GET['notes']);
            $_SESSION['events'][] = $event->asArray();
            saveToFile();
        }

        // CREATE YEAR
        $year = [];
        $date = strtotime(date("Y")."-01-01");

        while ($date <= strtotime(date("Y")."-12-31")) {
            $year[date("Y-m-d",$date)] = [];
            $date = strtotime("+1 day", $date);
        }

        // add tasks and events to calendar
        foreach ($_SESSION['tasks'] as $task) {
            $year[$task[1]][] = $task;
        }

        foreach ($_SESSION['events'] as $event) {
            $year[date("Y-m-d",strtotime($event[1]))][] = $event;
        }
    ?>

    
    <!-- <div class="events-container">
        <h3>New Event:</h3>
        <form method="get">
            <input type="text" name="name" id="name" placeholder="Task Name"><br>
            <input type="datetime-local" name="startDateTime" id="startDateTime"><br>
            <input type="datetime-local" name="endDateTime" id="EndDateTime"> <br>
            <input type="text" name="category" id="category" placeholder="category"><br>
            <input type="text" name="notes" id="notes" placeholder="notes"><br>
            <button type="create" name="createEvent" id="newEvent">Create new event</button>
        </form>
    </div> -->

    <div class="calendar">
        <?php 
            // for ($m = 1; $m <= 12; $m++) {
            //     echo '<div class="month">';
            //     $month = DateTime::createFromFormat('m', $m);
            //     echo $month->format("F");
            //     echo '</div>';
            // }
        ?>

        <div class="month">
            <?php
                for ($d = 1; $d <= 7; $d++) {
                    echo '<div class="col day">';
                    echo "day $d";
                    echo '</div>';
                }
            ?>
        </div>
    </div>


    <?php 
        // echo "<pre style='color:white;'>";
        // // print_r($_SESSION["events"]);
        // print_r($year);
        // echo "</pre>";
    ?>

    <!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>
