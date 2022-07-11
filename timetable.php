<?php $title = "Create Timetable"; ?>
<?php include("templates\\head.php"); ?>

    <!-- Page specific code goes here -->

    <?php
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
        <!-- <div class="input">
            <?php echo '<h3 style="margin-bottom: 0.25em;">Enter period '.$i.' details</h3>'; ?>
            <form method="get">
                <input type="text" name="subject" id="subject" placeholder="subject" required><br>
                <input type="text" name="startTime" id="startTime" placeholder="start time" onfocus="(this.type='time')" required><br>
                <input type="text" name="endTime" id="endTime" placeholder="end time" onfocus="(this.type='time')" required><br>
                <input type="number" name="period" id="period" placeholder="period" required><br>
                <input type="number" name="day" id="day" placeholder="day" required><br>
                <input type="text" name="classroom" id="classroom" placeholder="classroom" required><br>
                <input type="text" name="teacher" id="teacher" placeholder="teacher" required><br>
                <button type="submit" name="createPeriod">Create Period</button>
            </form>
        </div> -->

        <div class="timetable">
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
