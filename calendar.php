<?php $title = "Calendar"; ?>
<?php include("templates\\head.php"); ?>

    <!-- Page specific code goes here -->

    <?php
    $calendar = new Calendar(date($_SESSION['year'].'-'.$_SESSION['month'].'-'.$_SESSION['day']));

    $daysInMonth = date('t', strtotime($calendar->activeDay . '-' . $calendar->activeMonth . '-' . $calendar->activeYear));
    $daysLastMonth = date('j', strtotime('last day of previous month', strtotime($calendar->activeDay . '-' . $calendar->activeMonth . '-' . $calendar->activeYear)));
    $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
    $firstDayOfWeek = array_search(date('D', strtotime($calendar->activeYear . '-' . $calendar->activeMonth . '-1')), $days);

    // CREATE EVENT
    if (isset($_GET['createEvent'])) {
        $event = new Event($_GET['name'], $_GET['startDateTime'], $_GET['duration'], $_GET['category'], $_GET['notes']);
        $_SESSION['events'][] = $event->asArray();
        saveToFile();
        header("location: calendar.php");
    }

    // load tasks and events into calendar
    foreach ($_SESSION['events'] as $event) {
        $calendar->addEvent($event[0], $event[1], $event[2], $event[3], $event[4], "event");
    }

    foreach ($_SESSION['tasks'] as $task) {
        $calendar->addEvent($task[0], $task[1], $task[2], $task[3], $task[4], "task");
    }


    // CHANGE THROUGH MONTHS
    if (isset($_GET['month'])) {
        switch ($_GET['month']) {
            case '+1':
                if ($calendar->activeMonth == 12) {
                    $_SESSION['year']++;
                    $_SESSION['month'] = 1;
                } else {
                    $_SESSION['month']++;
                }
                header("location: calendar.php");
                break;
            case '-1':
                if ($calendar->activeMonth == 1) {
                    $_SESSION['year']--;
                    $_SESSION['month'] = 12;
                } else {
                    $_SESSION['month']--;
                }
                header("location: calendar.php");
                break;
        }
    }

    // GOTO TODAY
    if (isset($_GET["today"])) {
        $_SESSION['year'] = date("Y");
        $_SESSION['month'] = date("m");
        $_SESSION['day'] = date("d");
        header("location: calendar.php");
    }

    // DELETE TASK
    if (isset($_GET['delete'])) {
        switch ($calendar->events[$_GET['event']][5]) {
            case 'event':
                foreach ($_SESSION['events'] as $event) {
                    if ($event[0] == $calendar->events[$_GET['event']][0]) {
                        $eventIndex = array_search($event, $_SESSION['events']);
                    }
                }
                unset($_SESSION['events'][$eventIndex]);
                saveToFile();
                header("location: calendar.php");
                break;

            case 'task':
                foreach ($_SESSION['tasks'] as $task) {
                    if ($task[0] == $calendar->events[$_GET['event']][0]) {
                        $taskIndex = array_search($task, $_SESSION['tasks']);
                    }
                }
                unset($_SESSION['tasks'][$taskIndex]);
                sortTasks();
                saveToFile();
                header("location: calendar.php");
                break;
        }
        $calendar->removeEvent($_GET['event']);
    }

    // EDIT EVENT
    if (isset($_GET['editEvent'])) {
        foreach ($_SESSION['events'] as $event) {
            if ($event[0] == $calendar->events[$_GET['event']][0]) {
                $eventIndex = array_search($event, $_SESSION['events']);
            }
        }
        $event = new Event($_GET['name'], $_GET['startDateTime'], $_GET['duration'], $_GET['category'], $_GET['notes']);
        $_SESSION['events'][$eventIndex] = $event->asArray();
        saveToFile();
        header("location: calendar.php");
    }

    // EDIT TASk
    if (isset($_GET['editTask'])) {
        foreach ($_SESSION['tasks'] as $task) {
            if ($task[0] == $calendar->events[$_GET['event']][0]) {
                $taskIndex = array_search($task, $_SESSION['tasks']);
            }
        }
        $task = new Task($_GET['name'], $_GET['dueDate'], $_GET['priority'], $_GET['subject'], $_GET['notes']);
        $_SESSION['tasks'][$taskIndex] = $task->asArray();
        sortTasks();
        saveToFile();
        header("location: calendar.php");
    }
    ?>
<div class="wrapper">
    <div class="calendar">
        <div class="heading">
            <h3><?php echo date("F Y", strtotime($calendar->activeYear . '-' . $calendar->activeMonth . '-' . $calendar->activeDay)); ?></h3>
            <div class="buttons">
                <a href="calendar.php?today="><button style="width: auto; padding: 8px 16px;">Today</button></a>
                <a href="calendar.php?month=-1"><button><i class="fa-solid fa-angle-left"></button></i></a>
                <a href="calendar.php?month=+1"><button><i class="fa-solid fa-angle-right"></button></i></a>
            </div>
        </div>
        <div class="days">

            <?php
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
                        ' . ($daysLastMonth - $i + 1) . '
                    </div>
                ';
            }
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $selected = ''; // highlight current day
                if ($i == $calendar->activeDay && $calendar->activeMonth == date("m")) {
                    $selected = ' selected';
                }
                echo  '<div class="day-num' . $selected . '">';
                echo  '<span>' . $i . '</span>';
                foreach ($calendar->events as $event) {
                    $eventIndex = array_search($event, $calendar->events);
                    if ( $event[5] == 'event' ) {
                        for ($d = 0; $d <= ($event[2] - 1); $d++) { // if event is an event (not task) output x times based on duration
                            if (date('y-m-d', strtotime($calendar->activeYear . '-' . $calendar->activeMonth . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                                echo  '<a href="calendar.php?event=' . $eventIndex . '"><div class="event ' . $event[3] . '">';
                                echo  $event[0];
                                echo  '</div></a>';
                            }
                        }
                    } else { // output only once if event type is task
                        if (date('y-m-d', strtotime($calendar->activeYear . '-' . $calendar->activeMonth . '-' . $i )) == date('y-m-d', strtotime($event[1]))) {
                            echo  '<a href="calendar.php?event=' . $eventIndex . '"><div class="event ' . $event[3] . '">';
                            echo  $event[0];
                            echo  '</div></a>';
                        }
                    }
                }
                echo  '</div>';
            }
            for ($i = 1; $i <= (42 - $daysInMonth - max($firstDayOfWeek, 0)); $i++) {
                echo  '
                    <div class="day-num ignore">
                        ' . $i . '
                    </div>
                ';
            }
            ?>
        </div>
    </div>
    <div class="events">
        <div class="new-event">
            <h3 style="margin-bottom: 0.25em;">New Event:</h3>
            <form method="get">
                <input type="text" name="name" id="name" placeholder="Task Name"><br>
                <input type="text" name="startDateTime" placeholder="Date" id="startDateTime" onfocus="(this.type='datetime-local')"><br>
                <input type="number" name="duration" id="duration" placeholder="Duration"> <br>
                <input type="text" name="category" id="category" placeholder="category"><br>
                <input type="text" name="notes" id="notes" placeholder="notes"><br>
                <button type="create" name="createEvent" id="new-event">Create new event</button>
            </form>
        </div>

        <div class="event-details">
            <?php
                if (isset($_GET['event'])) {
                    $event = $calendar->events[$_GET['event']];

                    if (isset($_GET['edit'])) {
                        switch ($event[5]) {
                            case 'event':
                                echo '<h3 style="margin-bottom: 0.25em;">Edit Event:</h3>';
                                echo '<form method="get">';
                                    echo '<input type="text" name="name" id="name" value="'.$event[0].'"><br>';
                                    echo '<input type="datetime-local" name="startDateTime" value="'.$event[1].'"><br>';
                                    echo '<input type="number" name="duration" id="duration" value="'.$event[2].'"> <br>';
                                    echo '<input type="text" name="category" id="category" value="'.$event[3].'"><br>';
                                    echo '<input type="text" name="notes" id="notes" value="'.$event[4].'"><br>';
                                    echo '<input type="hidden" name="event" id="event" value="'.$_GET['event'].'"><br>';
                                    echo '<button type="create" name="editEvent" class="confirm">Confirm Changes</button>';
                                echo '</form>';
                                break;
                            
                            case 'task':
                                echo '<h3 style="margin-bottom: 0.25em;">Edit Task:</h3>';
                                echo '<form method="get">';
                                    echo '<input type="text" name="name" id="name" value="' . $event[0] . '" required><br>';
                                    echo '<input type="date" name="dueDate" id="dueDate" value="' . $event[1] . '" required><br>';
                                    echo '<input type="number" name="priority" id="priority" min="1" max="5" value="' . $event[2] . '"><br>';
                                    echo '<input type="text" name="subject" id="subject" value="' . $event[3] . '" required><br>';
                                    echo '<input type="text" name="notes" id="notes" value="' . $event[4] . '" required><br>';
                                    echo '<input type="hidden" name="event" id="event" value="' . $_GET['event'] . '">';
                                echo '<button type="submit" name="editTask" class="confirm">Confirm Changes</button>';
                                echo '</form>';
                                break;
                        }
                    } else {
                        switch ($event[5]) {
                            case 'event':
                                echo '<h3>' . $event[0] . '</h3><br>';
                                echo '<p><em>Date: </em>' . (new DateTime($event[1]))->format("d/m/y H:i") . '</p><br>';
                                echo '<p><em>Duration: </em>' . $event[2] . '</p><br>';
                                echo '<p><em>Category: </em>' . $event[3] . '</p><br>';
                                echo '<p><em>Notes: </em>' . $event[4] . '</p><br>';
                                echo '<div class="icons">';
                                    echo '<a href="calendar.php?event=' . $_GET['event'] . '&edit="><button><i class="fa-solid fa-pen fa-xl"></i></button></a>';
                                    echo '<a href="calendar.php?event=' . $_GET['event'] . '&delete="><button><i class="fa-solid fa-trash fa-xl"></i></button></a>';
                                echo '</div>';
                                echo '<div class="triangle"></div>';

                                break;
                            
                            case 'task':
                                echo '<h3>' . $event[0] . '</h3><br>';
                                echo '<p><em>Due Date: </em>' . (new DateTime($event[1]))->format("d/m/y") . '</p><br>';
                                echo '<p><em>Priority: </em>' . $event[2] . '</p><br>';
                                echo '<p><em>Subject: </em>' . $event[3] . '</p><br>';
                                echo '<p><em>Notes: </em>' . $event[4] . '</p><br>';
                                echo '<div class="icons">';
                                    echo '<a href="calendar.php?event=' . $_GET['event'] . '&edit="><button><i class="fa-solid fa-pen fa-xl"></i></button></a>';
                                    echo '<a href="calendar.php?event=' . $_GET['event'] . '&delete="><button><i class="fa-solid fa-trash fa-xl"></i></button></a>';
                                echo '</div>';
                                echo '<div class="triangle"></div>';
                                break;
                        }
                    }
                } else {
                    echo '<h3>Click on a task or event to view its details.</h3>';
                    echo '<div class="triangle"></div>';
                }
            ?>
        </div>
    </div>
</div>
    <!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>