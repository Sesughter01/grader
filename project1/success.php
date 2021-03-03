<?php include 'includes_2/controller/authcontroller.php' ?>

<?php
    
    // redirect user to login page if they're not logged in
      if (empty($_SESSION['user_id'])) {
        header('location:logout.php');
}
  echo "getting to finals";
?>
