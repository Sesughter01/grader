
<?php include 'includes_2/controller/authcontroller.php' ?>
<!DOCTYPE html>
<html>
<head>
    <title style="color: aliceblue;">Register Here</title>
      
    
    <?php include 'includes_2/head.php';?>
    <!--h3 class="text-center form-title">Register</h3--> <!-- or Login -->

    <link rel="stylesheet" href="/partnership2021/vendors_p/css/myStyle.css">
    
</head>
<body class="bg " >
<div class="w3-display-container w3-container">
  <!--img src="/partnership2021/assets2/images2/pstgbuyi.jpg" alt="Pastor" style="width:100%"-->
</div>
<div class="container">
    <div class="registration-box" >
<h2 style="color: aliceblue;">Partner Registration</h2>

	<form action="registration.php" method="post">
  <?php include('errors.php'); ?>

  <div class="form-row  ">
    <div class="form-group col-12 col-sm-3 col-lg-4">
	    <label for ="Name" style="color: aliceblue;">Name</label>
		   <input type="text" name="name" class="form-control" placeholder="Enter name" id = "name" >
    </div>
   
    <div class="form-group col-12 col-sm-3 col-lg-4">
	     <label for = "username" style="color: aliceblue;"> Username</label>
		   <input type="text" name="username" class="form-control" id = "username" placeholder="Enter username">
    </div>
    <div class="form-group col-12 col-sm-3 col-lg-4">
	     <label for = "phone_number" style="color: aliceblue;"> Phone number</label>
		    <input type="text" name="phone_number" class="form-control" id = "phoneNumber" placeholder="Enter Phone number">
    </div>
    </div>
    <div class="form-row  ">
    <div class="form-group col-12 col-sm-3 col-lg-4">
       <label for = "email" style="color: aliceblue;"> email</label>
		   <input type="text" name="email" class="form-control" id = "email" placeholder="email" > 
    </div>
   
     <div class="form-group col-12 col-sm-3 col-lg-4">
        <label for = "church" style="color: aliceblue;"> Church </label>
		    <input type="text" name="church" class="form-control" id="church" placeholder="church"> 
     </div>     
     <div class="form-group col-12 col-sm-3 col-lg-4">
        <label for = "pswd" style="color: aliceblue;"> Password </label>
        <input type="password" name="password" class="form-control" id="pswd1" placeholder="Password"> 
     </div>  
     <div class="form-group col-12 col-sm-3 col-lg-4">
        <label for = "pswd" style="color: aliceblue;"> Confirm Password </label>
		<input type="password" name="passwordConf" class="form-control" id="pswd2" placeholder="Confirm Password"> 
     </div> 
    </div>
	
        <button type="submit" name="Register" class="btn btn-primary btn-lg" style="color: aliceblue; margin-bottom:10px">Submit</button> 
        <p style="color: aliceblue">Already a User?</p>
        <a href="login.php" class="btn btn-primary btn-lg" style="color: aliceblue; margin-bottom:10px">Login</a>
	    
	</form>
  </div>
  </div>
</div>

<?php include 'includes_2/footer.php';?>
</body>
</html>