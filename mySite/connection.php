<?php
require("constants.php");
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error()); // Исправлено на mysqli_connect
mysql_select_db(DB_NAME) or die("Cannot select DB"); // Исправлено на mysqli_select_db
?>
