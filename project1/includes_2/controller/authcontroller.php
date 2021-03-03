<?php
//require_once 'sendEmails.php';
session_start();
$Username = "";
$email = "";
$errors = [];
//$Church="";
//$Password="";
//$Password_2="";

$hostname= "localhost";
$hostusername="root";
$hostpassword="";
$db="partners";

$conn = mysqli_connect($hostname, $hostusername, $hostpassword,$db);


// SIGN UP USER

    if (isset($_POST['Register'])) {
   
         // receive all input values from the form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email =  mysqli_real_escape_string($conn, $_POST['email']);
    $church =  mysqli_real_escape_string($conn, $_POST['church']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); //encrypt password
    
    $token = bin2hex(random_bytes(50)); // generate unique token
    
    
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array

        if (empty($_POST['name'])) {
            $errors['name'] = 'Name required';
        }
        
        
   
        if (empty($username)) {
            $errors['username'] = 'Username required';
        }
       
        if (empty($phone_number)) {
            $errors['phone_number'] = 'Phone number required';
        }
        
        if (empty($email)) {
            $errors['email'] = 'Email required';
        }
        if (empty($church)) {
            $errors['church'] = 'Church name required';
        }
    
        if (empty($password)) {
            $errors['password'] = 'Password required';
        }
        if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
            $errors['passwordConf'] = 'The two passwords do not match';
        }
   

    // Check if email already exists
    $sql = "SELECT * FROM partner_details WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
   
    if (mysqli_num_rows($result) > 0) {
      
        $errors['email'] = "Email already exists";
    }

    if (count($errors) === 0) {
        
       // $password = md5($password);
        $query = "INSERT INTO partner_details SET name=?,username=?, phone_number=? , email=?,church=?,Password=?, token=?";

       // mysqli_query($conn, $query);
         // $_SESSION['username'] = $username;
         // $_SESSION['success'] = "You are now logged in";
         // header('location: login.php');
    
         $stmt = $conn->prepare($query);
         $stmt->bind_param('sssssss',$name,$username,$phone_number,$email,$church,$password,$token);
          $result = $stmt->execute();

           if ($result) {
           $u = $conn->insert_id;
            $stmt->close();
           
            // TO DO: send verification email to user
           //  sendVerificationEmail($email, $token);

            $_SESSION['id'] = $u;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            
        
            header('location: login.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}

// LOGIN
if (isset($_POST['login'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username or email required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
       
    if (count($errors) === 0) {
        $query = "SELECT * FROM partner_details WHERE username =? OR email=? LIMIT 1";
        
        $stmt = $conn->prepare($query);
        
        $stmt->bind_param('ss', $username, $password);
         
        if ($stmt->execute()) {
         
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
       
            if ($password == $user['password']) { // if password matches
                
                $stmt->close();
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
            
                header('location: welcome.php');
                
            } else { // if password does not match
                $errors['login_fail'] = "Wrong username / password";
            }
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}
/*if (isset($_POST['login'])) {
    
     
        $username = mysqli_real_escape_string($conn, $_POST['username']);
       
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
if (empty($username)) {
    
    $errors['username'] = 'Username or email required';
      
        }
if (empty($password)) {
            $errors['password'] = 'Password or email required';
        }
    if (count($errors) === 0) {
        $password= md5($password);
     
        $query = "SELECT * FROM partner_details WHERE username='$username' ";
        
        $results = mysqli_query($conn, $query);
       
         
        if (mysqli_num_rows($results) == 1) {
          
            $_SESSION['id'] = $u;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['message'] = 'You are Registered!';
            $_SESSION['type'] = 'alert-success';
           
  	     //   $_SESSION['success'] = "You are now logged in";
  	        header('location: welcome.php');
            
        }else {
            $errors['login failed!'] = 'login failed!';
        }
    }
}*/

?>