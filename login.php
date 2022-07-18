<div class="login">

<?php
    include("app.php");
    if(isset($_POST['login'])) {

        /**
         * LOGIN
         * get username and password
         * check if username exists
         * check password hash
         * log user in
         */

        $error = null;

        if (isset($_POST['username']) && isset($_POST['password']))  {
            $username = $_POST['username'];
            $pw = $_POST['password'];
        } else {
            $error = 'please enter account details';
            exit;
        }

        // check if username existsTODO put in if statement so this doesnt run if username and password dont exist
        $file = new SplFileObject("data\\users.csv");
        $file -> setFlags(SplFileObject::READ_CSV|SplFileObject::SKIP_EMPTY);

        $error = "Username or password not correct.";
        foreach ($file as $user) {
            if (!empty($user)) {
                if (strcasecmp($user[0], $username) == 0 && password_verify($pw, $user[1])) {
                    $error = null;
                    break;
                }
            }
        }

        $file = null;


        if (empty($error)) {
            //log em in, initiate session variables
            $_SESSION["username"] = $username;

            $_SESSION["tasks"] = [];
            $_SESSION["timetable"] = [];
            $_SESSION["events"] = [];

            loadFromFile();

            header("Location: index.php");
            exit;
        }
    }
?>

    <form method="post">
        <h3>Login</h3>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="username" >
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="password" >
        <button type="submit" name="login">Login</button>
        <br><br>
        <p>Don't have an account? <a href="register.php">Register</a> now!</p>
        <?php if (!empty($error)) { echo "<br><p>".$error."</p>"; } ?>
    </form>
</div>