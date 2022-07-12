<?php $title = "Create Timetable"; ?>
<?php include("templates\\head.php"); ?>

    <!-- Page specific code goes here -->

    <?php
        if (empty($_SESSION['timetable'])) {
            if(!isset($_SESSION['tmp_timetable'])) {
                $_SESSION['tmp_timetable'] = [];
            }
        }
         
        // CREATE PERIOD
        if (isset($_GET['createPeriod'])) {
            $period = new Period($_GET['subject'], $_GET['startTime'], $_GET['endTime'], $_GET['period'], $_GET['day'], $_GET['classroom'], $_GET['teacher']);
            $_SESSION['tmp_timetable'][] = $period->asArray();
            header("location: timetable.php");
        }

        // once all periods have been added and edited :
        // if(isset($_GET["createtimetable"]).....

        // funciton : getDay() - returns current school day out of 10
        function getDay() {
            // get term dates and current dates
            $username = $_SESSION['username'];
            $termDatesFile = new SplFileObject("data\\users\\$username\\termdates.csv", "r");
            $termDatesFile->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);
            
            $termDates = explode(',',$termDatesFile->fgets());
            $date = date("Y-m-d");
            $week = date("W");
            $day = date("w");

            // get term, term start day (of timetable), and term start week (of the year)
            if ($date >= $termDates[0] && $date <= $termDates[1]) {
                $termStartDay = $termDates[3];
                $termStartWeek = date("W", strtotime($termDates[0]));
            } else if ($date >= $termDates[3] && $date <= $termDates[4]) {
                $termStartDay = $termDates[5];
                $termStartWeek = date("W", strtotime($termDates[3]));
            } else if ($date >= $termDates[6] && $date <= $termDates[7]) {
                $termStartDay = $termDates[8];
                $termStartWeek = date("W", strtotime($termDates[6]));
            } else if ($date >= $termDates[9] && $date <= $termDates[10]) {
                $termStartDay = $termDates[11];
                $termStartWeek = date("W", strtotime($termDates[9]));
            }

            // get week of term
            $weekOfTerm = $week - $termStartWeek + 1;

            // get week of timetable
            switch ($termStartDay) {
                case '1':
                    if ($weekOfTerm % 2 == 0) {
                        $timetableWeek = 2;
                    } else {
                        $timetableWeek = 1;
                    }
                    break;

                case '6':
                    if ($weekOfTerm % 2 == 0) {
                        $timetableWeek = 1;
                    } else {
                        $timetableWeek = 2;
                    }
                    break;
            }

            // get day of timetable
            switch ($timetableWeek) {
                case '1':
                    $timetableDay = $day;
                    break;

                case '2':
                    $timetableDay = $day + 5;
                    break;
            }

            return $timetableDay;
        }

    ?>
    
    <div class="timetable-container">
        <?php

        if (empty($_SESSION['timetable'])) {
            echo '
                <div class="create-timetable">
                    <div class="instructions">
                        <h3 style="margin-bottom: 0.25em;">Create your timetable!</h3>
                        <p>In order to use the timetable functionality, you must first enter in all of your timetable details.</p>
                        <br>
                        <p>To do so, follow these steps:</p>
                        <br>
                        <ol>
                            <li>Enter subjects in order from period 1 day 1, period 2 day 1, etc... all the way through to period 6 day 10.</li>
                            <br>
                            <li>Enter the subject\'s name, the start and end time of the period, the period number, the day of the timetable (1 - 10), the classroom, and the teacher.</li>
                            <br>
                            <li>Once complete, edit any mistakes and then click \'Create Timetable\'.</li>
                        </ol>
                        <div class="triangle"></div>
                    </div>
                    <div class="new-period">
                    <h3 style="margin-bottom: 0.25em;">Create Timetable:</h3>
                        <form method="get">
                            <input type="text" name="subject" id="subject" placeholder="Subject Name"><br>
                            <input type="text" name="startTime" placeholder="Start Time" id="startTime" onfocus="(this.type=\'time\')"><br>
                            <input type="text" name="endTime" placeholder="End Time" id="endTime" onfocus="(this.type=\'time\')"> <br>
                            <input type="number" name="period" id="period" placeholder="Period"><br>
                            <input type="number" name="day" id="day" placeholder="Day"><br>
                            <input type="text" name="classroom" id="classroom" placeholder="Classroom"><br>
                            <input type="text" name="teacher" id="teacher" placeholder="Teacher"><br>
                            <button type="create" name="createPeriod" id="new-period">Add new Period</button>
                        </form>
                    </div>
                    <div class="output">';
                        echo '<pre style="color:white;">';
                        print_r($_SESSION['tmp_timetable']);
                        echo '</pre>';
            echo '
                    </div>
                </div>
            ';
            

            echo '<div id="timetable" class="timetable hidden">';
        } else {
            echo '<div id="timetable" class="timetable">';
        }

        ?>
            <div class="container">
                <h3>Week 1</h3>
                <div class="week">
                        <?php
                            for ($i = 0; $i < 5; $i++) {
                                echo '<div class="col day'.($i + 1).'">';
                                echo '<p class="title">Day '.($i + 1).'</p>';
                                for ($j = 0; $j < 6; $j++) {
                                    if (($_SESSION['timetable'][$j + 6 * $i][1] <= date("H:i") && date("H:i") <= $_SESSION['timetable'][$j + 6 * $i][2]) && $i == getDay() - 1) {
                                        echo '<div class="row period'.($j + 1).' active">';
                                    } else {
                                        echo '<div class="row period'.($j + 1).'">';
                                    }
                                    echo '<h4>'.$_SESSION['timetable'][$j + 6 * $i][0].'</h4>';
                                    echo '<p>'.$_SESSION['timetable'][$j + 6 * $i][1].' to '. $_SESSION['timetable'][$j + 6 * $i][2].'</p>';
                                    echo '<p>'.$_SESSION['timetable'][$j + 6 * $i][5].'</p>';
                                    echo '<p>'.$_SESSION['timetable'][$j + 6 * $i][6].'</p>';
                                    echo '</div>';
                                }
                                echo '</div>';
                            }
                        ?>
                </div>
            </div>
            <div class="container">
                <h3>Week 2</h3>
                <div class="week">
                    <?php
                        for ($i = 5; $i < 10; $i++) {
                            echo '<div class="col day'.($i + 1).'">';
                            echo '<p class="title">Day '.($i + 1).'</p>';
                            for ($j = 0; $j < 6; $j++) {
                                if (($_SESSION['timetable'][$j + 6 * $i][1] <= date("H:i") && date("H:i") <= $_SESSION['timetable'][$j + 6 * $i][2]) && $i == getDay() - 1) {
                                    echo '<div class="row period'.($j + 1).' active">';
                                } else {
                                    echo '<div class="row period'.($j + 1).'">';
                                }
                                echo '<h4>'.$_SESSION['timetable'][$j + 6 * $i][0].'</h4>';
                                echo '<p>'.$_SESSION['timetable'][$j + 6 * $i][1].' to '. $_SESSION['timetable'][$j + 6 * $i][2].'</p>';
                                echo '<p>'.$_SESSION['timetable'][$j + 6 * $i][5].'</p>';
                                echo '<p>'.$_SESSION['timetable'][$j + 6 * $i][6].'</p>';
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>
