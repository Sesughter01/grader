
 <?php
session_start();
//
require_once("connect.php");


if(isset($_POST['number_of_copies'])){


	$number_of_copies =mysqli_real_escape_string($conn,$_POST['number_of_copies']) ;
   
   if($number_of_copies<100){
     $s = "UPDATE custom_partners WHERE  = '$first_name' && last_name = '$last_name'";
    $result = mysqli_query($conn,$s);
    $num = mysqli_num_rows($result);
    if($num==1){
        echo "<div class= 'alert alert-success'>
        <p> User name already taken</p>
        </div>";
    } elseif($Password1!=$Password2){
        echo "<div class= 'alert alert-success'>
        <p> Passwords not the same</p>
        </div>";
    }else{
      $Password=md5($Password1);
        
    $mysql="INSERT INTO users(first_name,last_name,email,phone_number,Username,Church,Password,token) VALUES ('$first_name','$last_name','$email','$phone_number','$Username','$Church','$Password','$token')";
  
    $query = mysqli_query($conn,$mysql) or die(mysqli_error($conn));
    
    
    if ($query==true) {
       //Send email
       
    
        echo "<div class='alert alert-success'>
	
	<p>Thanks your data has been sent!</p>
	

    </div>";
    header('location:login.php');
    }
    else {
        echo "<div class='alert alert-success'>
	
        <p>Sorry,unable to save data!</p>

    </div>";
    }
	
}
 }

?>

require_once'C:/xampp/htdocs/partnership2021/vendor/autoload.php';
<div class="w3-container w3-row w3-black" style="background-size:100%;" >
    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
        <img src="/partnership2021/assets2/images2/custom_badge bg.png" style="width: 100%;" >
        <div class="w3-display-middle w3-display-hover">
          <button class="w3-button w3-black">GIVE NOW </button>
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
          <button class="w3-button w3-black">GIVE NOW </button>
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
            <button class="w3-button w3-black">GIVE NOW </button>
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
          <button class="w3-button w3-black">GIVE NOW </button>
        </div>
      </div>
        <p>Gold Partner<br><b>Above 1000 copies</b></p>
      </div>
      

    </div>

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
        <img src="/partnership2021/assets2/images2/platinum_badge bg.png" style="width:100%">

        <div class="w3-display-middle w3-display-hover">
          <button class="w3-button w3-black">GIVE NOW </button>
        </div>

        </div>
        <p>Platinum Partner<br><b>Above 3000 copies</b></p>
      </div>
      
    </div>
  </div>
 
