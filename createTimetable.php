<?php $title = "Create Timetable"; ?>
<?php include("templates\\head.php"); ?>

    <!-- Page specific code goes here -->

    <?php
        $i = 1;
        if (isset($_GET["createPeriod"])) {
            $period = new Period($_GET);
            $_SESSION["timetable"][] = $period->asArray();
            saveToFile();
            $i++;
        }
    ?>
    
    <div class="timetable-container">
        <div class="input">
            <?php echo '<h3 style="margin-bottom: 0.25em;">Enter period '.$i.' details</h3>'; ?>
            <form method="get">
                <input type="text" name="subject" id="subject" placeholder="subject" required><br>
                <input type="text" name="startTime" id="startTime" placeholder="start time" onfocus="(this.type='time')" required><br>
                <input type="text" name="endTime" id="endTime" placeholder="end time" onfocus="(this.type='time')" required><br>
                <input type="number" name="day" id="day" placeholder="day" required><br>
                <input type="text" name="classroom" id="classroom" placeholder="classroom" required><br>
                <input type="text" name="teacher" id="teacher" placeholder="teacher" required><br>
                <button type="submit" name="createPeriod">Create Period</button>
            </form>
        </div>
    </div>

    <?php 
            echo "<pre style='color:white;'>";
            print_r($_SESSION["timetable"]);
            echo "</pre>";
        ?>

    <!-- End Page specific code -->

<?php include('templates\\foot.php'); ?>
