<?php include 'includes_2/controller/authcontroller.php' ?>
<?php

session_destroy();
unset($_SESSION['id']);

unset($_SESSION['username']);
unset($_SESSION['email']);


header("location: index.php");

?>