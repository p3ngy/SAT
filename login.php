<div class="login">

<?php
    include("app.php");
    if(isset($_GET['login'])) {
        /**
         * get inputs
         * check un/pw combo exist
         * slog em in
         */

        /**
         * user ile format,
         * username
         * password
         */

        $error = null;
        $username = $_GET['username'];
        $pw = $_GET['password'];

        // check if username exists
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
            //log em in
            $_SESSION["username"] = $username;

            $_SESSION["tasks"] = [];
            $_SESSION["timetable"] = [];
            $_SESSION["events"] = [];

            loadFromFile();

            header("Location: tasks.php");
            exit;
        }
    }
?>

    <form method="$_GETpost">
        <h3>Login</h3>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="password" required>
        <button type="submit" name="login">Login</button>
        <br><br>
        <p>Don't have an account? <a href="register.php">Register</a> now!</p>
        <?php if (!empty($error)) { echo "<br><p>".$error."</p>"; } ?>
    </form>
</div>