<?php $title = "Calendar"; ?>
<?php include("templates\\head.php"); ?>

    <!-- Page specific code goes here -->

    <?php 
        
        if (isset($_GET['createEvent'])) {
            $event = new Event($_GET['name'], $_GET['startDateTime'], $_GET['duration'], $_GET['category'], $_GET['notes']);
            $_SESSION['events'][] = $event->asArray();
            saveToFile();
        }

        $calendar = new Calendar();

        foreach ($_SESSION['events'] as $event) {
            $calendar->addEvent($event[0], $event[1], $event[2], $event[3], $event[4]);
        }

        foreach ($_SESSION['tasks'] as $task) {
            $calendar->addEvent($task[0], $task[1], 1, $task[3], $task[4]);
        }

        $daysInMonth = date('t', strtotime($calendar->active_day . '-' . $calendar->active_month . '-' . $calendar->active_year));
        $daysLastMonth = date('j', strtotime('last day of previous month', strtotime($calendar->active_day . '-' . $calendar->active_month . '-' . $calendar->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $firstDayOfWeek = array_search(date('D', strtotime($calendar->active_year . '-' . $calendar->active_month . '-1')), $days);


        // PAGE
        echo '<div class="calendar">';
        echo  '<div class="days">';
        foreach ($days as $day) {
            echo  '
                <div class="day-name">
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $firstDayOfWeek; $i > 0; $i--) {
            echo  '
                <div class="day-num ignore">
                    ' . ($daysLastMonth-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $selected = '';
            if ($i == $calendar->active_day) {
                $selected = ' selected';
            }
            echo  '<div class="day-num' . $selected . '">';
            echo  '<span>' . $i . '</span>';
            foreach ($calendar->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($calendar->active_year . '-' . $calendar->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        echo  '<div class="event ' . $event[3] . '">';
                        echo  $event[0];
                        echo  '</div>';
                    }
                }
            }
            echo  '</div>';
        }
        for ($i = 1; $i <= (42-$daysInMonth-max($firstDayOfWeek, 0)); $i++) {
            echo  '
                <div class="day-num ignore">
                    ' . $i . '
                </div>
            ';
        }
        echo  '</div>';
        echo  '</div>';
        echo  '
        <div class="events">
            <h3>New Event:</h3>
            <form method="get">
                <input type="text" name="name" id="name" placeholder="Task Name"><br>
                <input type="text" name="startDateTime" placeholder="Date" id="startDateTime" onfocus="(this.type=\'datetime-local\')"><br>
                <input type="number" name="duration" id="duration" placeholder="Duration"> <br>
                <input type="text" name="category" id="category" placeholder="category"><br>
                <input type="text" name="notes" id="notes" placeholder="notes"><br>
                <button type="create" name="createEvent" id="new-event">Create new event</button>
            </form>
        </div>
        ';
    ?>

    <!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>
