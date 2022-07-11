<?php $title = "Register"; ?>
<?php include("templates\\head.php"); ?>

    <!-- Page specific code goes here -->
    <div class="register">

    <?php
        // handle registration form submission

        if(isset($_GET['register'])) {
            /**
             * REGISTER
             * get inputs
             * check p1 = p2
             * check if already registered
             * save username and hashed pswd
             */

            /**
             * user ile format,
             * username
             * password
             */

            $error = null;
            $username = $_GET['username'];
            $pw1 = $_GET['password'];
            $pw2 = $_GET['password2'];

            if ($pw1 != $pw2) {
                $error = "Passwords do not match.";
            }

            if (empty($error)) {
                // check if username exists
                $file = new SplFileObject("data\\users.csv");
                $file -> setFlags(SplFileObject::READ_CSV|SplFileObject::SKIP_EMPTY);

                foreach ($file as $user) {
                    if (!empty($user)) {
                        if (strcasecmp($user[0], $username) == 0) {
                            $error = "Username already exists.";
                            break;
                        }
                    }
                }

                $file = null;
            }

            if (empty($error)) {
                // register user by adding to file
                $file = new SplFileObject("data\\users.csv", "a");
                $file -> setFlags(SplFileObject::READ_CSV|SplFileObject::SKIP_EMPTY);

                $file -> fputcsv(array(
                    $username,
                    password_hash($pw1, PASSWORD_DEFAULT)
                ));

                // create user file structure
                mkdir("data\\users\\$username");

                $tasks = fopen("data\\users\\$username\\tasks.csv", "a");
                $timetable = fopen("data\\users\\$username\\timetable.csv", "a");
                $events = fopen("data\\users\\$username\\events.csv", "a");

                copy("data\\termDates.csv", "data\\users\\$username\\termDates.csv");

                fclose($tasks);
                fclose($timetable);
                fclose($events);

                $file = null;
                header("Location: index.php");
            }
        }
    ?>

        <form>
            <h3>Register</h3>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="password" required>
            <label for="password2">Re-enter password:</label>
            <input type="password" name="password2" id="password2" placeholder="re-enter password" required>
            <button type="submit" name="register">Register</button>
            <br><br>
            <p>Already have an account? <a href="index.php">Login</a> now!</p>
            <?php 
                if (!empty($error)) {
                    echo "<br><p class='error'>$error</p>";
                }
            ?>
        </form>
    </div>
      <!-- End Page specific code -->

    <?php include('templates\\foot.php'); ?>