<link rel="stylesheet" src="">
<?php
session_start();
require_once("includes/connection.php");
include("includes/header.php");

if (isset($_SESSION["session_username"])) {
    header("Location: intropage.php");
    exit();
}

if (isset($_POST["login"])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Corrected the SQL query syntax
        $query = mysql_query("SELECT * FROM usertbl WHERE username='$username' AND password='$password'");
        $numrows = mysql_num_rows($query);

        if ($numrows != 0) {
            while ($row = mysql_fetch_assoc($query)) {
                $dbusername = $row['username'];
                $dbpassword = $row['password'];
            }

            if ($username == $dbusername && $password == $dbpassword) {
                $_SESSION['session_username'] = $username; // Fixed session assignment
                header("Location: intropage.php");
                exit();
            } else {
                $message = "Неверный логин или пароль!";
            }
        } else {
            $message = "Неверный логин или пароль!";
        }
    } else {
        $message = "Все поля являются обязательными!";
    }
}
?>

<div class="container mlogin">
    <div id="login">
        <h1>ЛОГИН</h1> <!-- Corrected <hl> to <h1> -->
        <form name="loginform" id="loginform" action="" method="POST">
            <p>
                <label for="user_login">Логин<br/>
                    <input type="text" name="username" id="username" class="input" value="" size="20"/>
                </label>
            </p>
            <p>
                <label for="user_pass">Пароль<br/> <!-- Corrected label for -->
                    <input type="password" name="password" id="password" class="input" value="" size="20"/> <!-- Fixed input tag -->
                </label>
            </p>
            <p class="submit"> <!-- Fixed p class -->
                <input type="submit" name="login" class="button" value="Логин"/>
            </p>
            <p class="regtext">Уже есть учетная запись? <a rel="nofollow ugc" target="_blank" href="register.php">Логин Здесь</a>!</p>
        </form>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<?php if (!empty($message)) {
    echo "<p class=\"error\">".$message."</p>"; // Fixed message output
} ?>
