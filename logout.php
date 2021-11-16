<?php

session_start();
$_SESSION['user'] = "";
session_destroy();
session_unset();
session_unset();


echo "Please come back soon";

?>

<a href="./profile.php">go back</a>


