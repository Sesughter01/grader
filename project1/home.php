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
  <?php include 'includes_2/head.php';?>
  <script src="C:\xampp\node_modules\chart.js\dist/Chart.js"></script>
  
</head>

<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}

		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
	</style>

</style>
<body class="w3-content" style="max-width:1200px" onload="myMonth()">

   <?php include 'includes_2/navbar.php';?>


<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide"><img src="/partnership2021/assets2/images2/CE LOGOXX.png" style="width:90px; height: 90px;"></div>
  <a href="/partnership2021/project1/logout.php" class="w3-bar-item w3-button w3-padding-24 w3-right" ><i class="fa fa-sign-out" aria-hidden="true" ></i></a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
  <p class="w3-display-middle">
      My Partnership Project
    </p>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:150px"></div>
  
  <!-- Top header -->
  <header class="w3-container  w3-hide-small  w3-black w3-large" style="width:934.8px; height: 6em; padding: 1em">
  <div class="w3-right"><img src="/partnership2021/assets2/images2/CE LOGOXX.png" style="width:80px; height: 80px; margin-top:1px;"></div>
  <a href="/partnership2021/project1/logout.php" class="w3-bar-item w3-button w3-padding-24 w3-right"><i class="fa fa-sign-out" aria-hidden="true" ></i></a>
    <p class="w3-left" id="currentMonth">January</p>
    <p class="w3-responsive w3-padding-24 w3-right" id="pagetitle">My Partnership Project</hp>
  </header>

  <!-- Image header -->
  <div class="w3-display-container w3-container">

    <img src="/partnership2021/assets2/images2/My_Rhapsody_images1.png" alt="Rhapsody" style="width:100%">
    <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
      <!--h1 class="w3-jumbo w3-hide-small" style="color: blue;">New arrivals</h1-->
      <!--h1 class="w3-hide-large w3-hide-medium">New arrivals</h1-->
      <!--h1 class="w3-hide-small">COLLECTION 2016</h1-->
      <p><a href="#Categories" class="w3-button w3-black w3-padding-large w3-large" style="margin-top: 180px;">1 MILLION COPIES</a></p>
     
	<br>
	<br>

    </div>
  </div>

  <div style="width: 75%;margin-left:5px">
  <p id="randomizeData"><strong>300,000 Copies Done</strong> </p>
		<!--canvas id="canvas"></canvas-->
		<progress id="animationProgress" max="1" value="0.3" style="width: 100%;"></progress>
	</div>

  <!-- Product grid -->
  <div class="w3-container w3-row w3-black" style="background-size:100%;" >
    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
        <img src="/partnership2021/assets2/images2/custom_badge bg.png" style="width: 100%;" >
        <div class="w3-display-middle w3-display-hover">
          <a href="give.php" class="w3-button w3-black" >GIVE NOW </a>
        </div>
        
      </div>
      <p>Custom Partner<br><b> Lower than 100 copies</b></p>
      </div>
    
    </div>
    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
        <img src="/partnership2021/assets2/images2/bronze_badge.png" style="width: 100%;" >
        <div class="w3-display-middle w3-display-hover">
          <a href="give.php" class="w3-button w3-black">GIVE NOW </a>
        </div>
        
      </div>
      <p>Bronze Partner<br><b>100-500 copies</b></p>
      </div>
    
    </div>

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="/partnership2021/assets2/images2/silver_badge bg.png" style="width:100%">
          
          <div class="w3-display-middle w3-display-hover">
            <a href="give.php" class="w3-button w3-black">GIVE NOW </a>
          </div>
        </div>
        <p>Silver Partner<br><b>501-1000 copies</b></p>
      </div>
      
    </div>

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
        <img src="/partnership2021/assets2/images2/gold_badge bg.png" style="width:100%">
        <div class="w3-display-middle w3-display-hover">
          <a href="give.php" class="w3-button w3-black">GIVE NOW </a>
        </div>
      </div>
        <p>Gold Partner<br><b>Above 1000 copies</b></p>
      </div>
      

    </div>

    <!--div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
        <img src="/partnership2021/assets2/images2/platinum_badge bg.png" style="width:100%">

        <div class="w3-display-middle w3-display-hover">
          <a href="give.php" class="w3-button w3-black" >GIVE NOW </a>
        </div>

        </div>
        <p>Platinum Partner<br><b>Above 3000 copies</b></p>
      </div>
      
    </div-->
  </div>
 

  <!-- Subscribe section -->
  <div class="w3-container w3-black w3-padding-32" style="width:950px;margin-top:5px">
    <h1>Specify</h1>
    <p>Specify your actual number of copies:</p>
    <p><input class="w3-input w3-border" type="text" placeholder="Enter number of copies" style="width:100%"></p>
    <button type="button" name="number_of_copies" class="w3-button w3-red w3-margin-bottom">Give Now</button>
  </div>
  <?php include 'includes_2/footer.php';?>
  

  <!-- End page content -->
</div>

<!-- Newsletter Modal -->
<div id="newsletter" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide">NEWSLETTER</h2>
      <p>Join our mailing list for updates on new strategies to involve others in your Partnership .</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('newsletter').style.display='none'">Subscribe</button>
    </div>
  </div>
</div>
<?php
  // toggling through the aside sidebar menu
   if(isset($_GET['page'])){
       if($_GET['page']=="february"){
          echo "<h1>my february partnership details here</h1>";
       } else if($_GET['page']=="match"){
          echo"<h1>my match partnership details here</h1>";
       }
   } else{
        echo "";
   }
  

?>
    <?php include 'includes_2/scripts.php';?>


</body>
</html>
