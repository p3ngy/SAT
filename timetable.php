<?php $title = "Create Timetable"; ?>
<?php include("templates\\head.php"); ?>

    <!-- Page specific code goes here -->

    <?php


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
            <div class="week">
                <?php
                    for ($i = 0; $i < 5; $i++) {
                        echo '<div class="col day'.($i + 1).'">';
                        for ($j = 0; $j < 6; $j++) {
                            echo '<div class="row period'.($j + 1).'">';
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
            <div class="week">
                <?php
                    for ($i = 5; $i < 10; $i++) {
                        echo '<div class="col day'.($i + 1).'">';
                        for ($j = 0; $j < 6; $j++) {
                            echo '<div class="row period'.($j + 1).'">';
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

    <!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>
