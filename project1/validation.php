<?php
session_start();
$Username = "";
$email = "";
$errors = [];
require_once("connect.php");


//$Username = $_POST['Username'];
//$Password = $_POST['Password'];
//$Password = md5($Password);
//$Password = password_hash($Password);


    //$s = "SELECT * FROM users WHERE Username = '$Username' && Password = '$Password'";
    //$result = mysqli_query($conn,$s);
    //$num = mysqli_num_rows($result);
    //if($num==1){
      // $_SESSION['Username']=$Username;
       
         //header('location:welcome.php');
    //} else{
        //echo "<div class= 'alert alert-success'>
     // <p> Passwords not the same</p>
      //</div>";
      //  header('location:registration.php');
      
    //}

    // LOGIN
if (isset($_POST['login'])) {
  if (empty($_POST['Username'])) {
      $errors['Username'] = 'Username or Password required';
  }
  if (empty($_POST['Password'])) {
      $errors['Password'] = 'Password required';
  }
  $Username = $_POST['Username'];
  $Password = $_POST['Password'];

  if (count($errors) === 0) {
      $query = "SELECT * FROM users WHERE Username=? OR email=? LIMIT 1";
      $stmt = $conn->prepare($query);
      $stmt->bind_param('ss', $Username, $Password);

      if ($stmt->execute()) {
          $result = $stmt->get_result();
          $user = $result->fetch_assoc();
          if (password_verify($Password, $user['Password'])) { // if password matches
              $stmt->close();

              $_SESSION['user_id'] = $user['user_id'];
              $_SESSION['Username'] = $user['Username'];
              $_SESSION['email'] = $user['email'];
              $_SESSION['Confirmed'] = $user['Confirmed'];
              $_SESSION['message'] = 'You are logged in!';
              $_SESSION['type'] = 'alert-success';
              header('location: welcome.php');
              exit(0);
          } else { // if password does not match
              $errors['login_fail'] = "Wrong username / password";
          }
      } else {
          $_SESSION['message'] = "Database error. Login failed!";
          $_SESSION['type'] = "alert-danger";
      }
  }
 


