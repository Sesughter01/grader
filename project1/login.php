
<?php include 'includes_2/controller/authcontroller.php' ?>

<!DOCTYPE html>
<html lang="en">
    <head>
   
        <title>Partner Login</title>
      

        <!--Vendors/ Bootstrap CSS -->
        <?php include 'includes_2/head.php';?>
        <link rel="stylesheet" href="/partnership2021/vendors_p/css/myStyle.css">

    </head>
    <body class="bg " >
      
    
       <!--div class="container pt-3"-->
           <div class="login-box">
            <!--div class="row"-->

                        <div class="col-sm-6">
                         <h2 style="color: aliceblue;">Login Here</h2>
                         <?php include('errors.php'); ?>
                        </div>
                    
                 <form action="login.php" method="post">
              

                    <div class="form-group col-12 col-sm-3 col-lg-4">
                         <label style="color: aliceblue;">Username</label>
                        <input type="text" name="username" class="form-control"> 
                    </div>
                    <div class="form-group col-12 col-sm-3 col-lg-4">
                            <label style="color: aliceblue;">Password</label>
                            <input type="password" name="password" class="form-control" > 
                    </div>
                 <button type="submit" name="login" class="btn btn-primary" style="color: aliceblue;margin:10px">Login</button>
                        
                </form>
                    <br>
                    <div class="form-group ">
                        <p style="color: aliceblue;">Not registered?</p>
                        </div>
                        <a href="registration.php" class=" btn btn-primary btn-lg" style="color: aliceblue; margin:10px">Register</a>
                       
                </div>

            </div>
           </div>
       </div>
       
       <?php include 'includes_2/footer.php';?>
    </body>
</html>
