<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php
if (isset($_POST["register"])) {
    if (empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])) {
        $message = "Все поля являются обязательными!";
    } else {
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = mysqli_query($Scon, "SELECT * FROM usertbl WHERE username='$username'");
        $numrows = mysqli_num_rows($query);
        
        if ($numrows == 0) {
            $sql = "INSERT INTO usertbl (full_name, email, username, password) VALUES ('$full_name', '$email', '$username', '$password')";
            $result = mysqli_query($Scon, $sql);
            if ($result) {
                $message = "Учетная запись успешно создана";
            } else {
                $message = "Не удалось вставить данные!";
            }
        } else {
            $message = "Это имя пользователя уже существует! Пожалуйста, попробуйте еще раз!";
        }
    }
}
?>
<?php if (!empty($message)) { echo "<p class=\"error\">MESSAGE: $message</p>"; } ?>
<div class="container mregister">
    <div id="login">
        <h1>РЕГИСТРАЦИЯ</h1>
        <form name="registerform" id="registerform" action="register.php" method="post">
            <p>
                <label for="user_login">ФИО<br/>
                    <input type="text" name="full_name" id="full_name" class="input" size="32" value="" />
                </label>
            </p>
            <p>
                <label for="user_pass">Email<br/>
                    <input type="email" name="email" id="email" class="input" value="" size="32"/>
                </label>
            </p>
            <p>
                <label for="user_pass">Логин<br/>
                    <input type="text" name="username" id="username" class="input" value="" size="20"/>
                </label>
            </p>
            <p>
                <label for="user_pass">Пароль<br/>
                    <input type="password" name="password" id="password" class="input" value="" size="32"/>
                </label>
            </p>
            <p class="submit">
                <input type="submit" name="register" id="register" class="button" value="Регистрация"/>
            </p>
            <p class="regtext">Уже есть учетная запись? <a rel="nofollow ugc" target="_blank" href="login.php">Логин здесь</a>!</p>
        </form>
    </div>
</div>
<?php include("includes/footer.php"); ?>

