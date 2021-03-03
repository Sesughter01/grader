<?php include 'includes_2/controller/authcontroller.php' ?>
<?php

    // redirect user to login page if they're not logged in
    if (empty($_SESSION['id'])) {
      header('location:logout.php');
}

?>
<!DOCTYPE html>
<html>
   
    
  <head>
     
     
      <!-- Bootstrap CSS -->
      <?php include 'includes_2/head.php';?>
      
      <link rel="stylesheet" href="/partnership2021/vendors_p/css/myStyle.css">


       
     <title>ROR|Welcome</title>
     
     
       
   </head>
   <body class= "bg" onload="myMonth()">
      <div class=" w3-display-container">     
      <!-- Top menu on small screens -->
      <header class=" w3-bar w3-top w3-hide-large w3-black w3-xlarge">
        <div class=" w3-bar-item w3-padding-24 w3-wide"><img src="/partnership2021/assets2/images2/CE LOGOXX.png" style="width:40px; height: 40px;"></div>
        <a href="/partnership2021/project1/logout.php" class="w3-bar-item w3-button w3-padding-24 w3-right"><i class="fa fa-sign-out" aria-hidden="true" ></i></a>
        
          <p class="w3-display-middle">
            My Partnership Project
          </p>
      </header>
      </div>
      <header class="  w3-container w3-xlarge">

              
              
       </header>

              
            <!-- !PAGE CONTENT! -->
            <!--div class=" w3-main"-->

            <!-- Push down content on small screens-->
            <div class="w3-hide-large" ></div>
        
            <!-- Top header -->
            <header class="w3-Container w3-hide-small  w3-black w3-large" style="max-width:100%; height: 7em; padding: 1em">
            <div class="w3-right"><img src="/partnership2021/assets2/images2/CE LOGOXX.png" style="width:80px; height: 80px; margin-top:1px;"></div>
            <a href="/partnership2021/project1/logout.php" class="w3-bar-item w3-button w3-padding-24 w3-right"><i class="fa fa-sign-out" aria-hidden="true" ></i></a>
              <p class="w3-left" id="currentMonth">January</p>
              <p class="w3-responsive w3-padding-24 w3-right" id="pagetitle">My Partnership Project</hp>
            </header>
         <!-- Image header -->
               <div class="w3-large" >
                   <h3 style="color: aliceblue;margin-top:300px;margin-left:30px;"> Welcome, <?php echo $_SESSION['username']; ?></h3>
                  </div>
              <!--img src="/partnership2021/assets2/images2/pstgbuyi.jpg" alt="Pastor" style="width:100%"-->
                <div class=" w3-middle">
                 
              <a href="home.php" class="btn btn-primary btn-lg" style="color: aliceblue; margin-top:200px;margin-left:20px;">GET STARTED</a>
                 
              </div>
              >
     

   </body>














</html>