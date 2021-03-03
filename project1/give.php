<?php include 'includes_2/controller/authcontroller.php' ?>
<?php

    // redirect user to login page if they're not logged in
    if (empty($_SESSION['id'])) {
      header('location:logout.php');
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/partnership2021/vendors_p/css/myStyle.css">

        <!--Vendors/ Bootstrap CSS -->
        <?php include 'includes_2/head.php';?>
        <script src="/partnership2021/vendors_p/myJs.js"></script>
        <script src="/partnership2021/vendors_p/disable.js"></script>
    </head>
    <body class="img2 img-fluid "  onload="myMonth()">
    
    

      <!--Partnership Plans-->
      
      
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
     <header class="w3-Container w3-hide-small  w3-black w3-large" style="max-width:100%; height: 6em; padding: 1em">
     <div class="w3-right"><img src="/partnership2021/assets2/images2/CE LOGOXX.png" style="width:80px; height: 80px; margin-top:1px;"></div>
     <a href="/partnership2021/project1/logout.php" class="w3-bar-item w3-button w3-padding-24 w3-right"><i class="fa fa-sign-out" aria-hidden="true" ></i></a>
       <p class="w3-left" id="currentMonth">January</p>
       <p class="w3-responsive w3-padding-24 w3-right" id="pagetitle">My Partnership Project</hp>
     </header>
   
     <!--div class="img2 img-fluid " -->
         <form action="pay.php" method="POST">
             <div class="container give-box" >
                <div class="form-row  "   >
           
                <div class="form-group col-sm-12 col-sm-4 col-md-4">
                     <input type="text" name="username" class="form-control" placeholder="Enter Username" > 
                </div>

                 <div class="form-group  col-sm-3 col-sm-3 col-md-4" >
                        
                     <input type="email" name="email" class="form-control" placeholder="Enter your email"> 
                        
                 </div>  
               
                 <div class="form-group col-sm-3 col-sm-3 col-md-4" >
                        
                            <input id="noc" type="number" name="number_of_copies" onchange="moneyValue()" class="form-control" placeholder="Enter No.of copies" > 
                        
                 </div>  
                 <div class="form-group  col-sm-3 col-sm-3 col-md-4" >
                        
                    <input id="amt" type="number" name="amount"  class="form-control" placeholder="Enter amount"> 
                        
                 </div>
                </div>  
                
             </div>
            
      <!-- Custom Partner-->  
                <div class="container"> 
                   <div class="row " style="margin-right:20px;">        
                        <div class="col-md-2 text-center"  style="margin-left:38px;margin-right:38px"> 
                            <div class="card card-warning card-pricing" id= "customid" style="width:250px;height:150px;margin-bottom:200px">
                                <div class="card-heading btn-secondary">
                                   <i class="fa fa-money"></i>
                                    <h3> Custom Partner</h3>
                                </div>
                                    <div class="card-body text-center">
                                       <p id="moneyValue1"><strong> Less than 100 copies</strong></p>
                                    </div>
                                      <ul class="list-group text-center">
                                          <li class="list-group-item"><i class="fa fa-check"></i>Update emails</li>
                                          <li class="list-group-item"><i class="icon-check-empty"></i>Monthly magazine</li>
                                          <li class="list-group-item"><i class="icon-check-empty"></i>IPPC Qualified</li>
                                       </ul>
                                  <div class="card-footer">
                                    <label class="btn btn-secondary btn-block">
                                       <input type="radio" onclick="disAble_bsg()" name="options" id="customPartner" value="< 200 copies">Give as Custom Partner
                                    </label>
                                 </div>
                         </div>
                     </div>
                     <!-- Bronze Partner-->           
                     <div class="col-sm-2 text-center"  style="margin-left:38px;margin-right:38px">
                            <div class="card card-warning card-pricing" id= "bronzeid" style="width:250px;height:150px;margin-bottom:200px">
                                <div class="card-heading btn-primary">
                                   <i class="fa fa-money"></i>
                                    <h3> Bronze Partner</h3>
                            </div>
                                    <div class="card-body text-center">
                                       <p id="moneyValue2"><strong>100-500 copies</strong></p>
                                    </div>
                                      <ul class="list-group text-center" >
                                          <li class="list-group-item"><i class="fa fa-check"></i>Update emails</li>
                                          <li class="list-group-item"><i class="fa fa-check"></i>Monthly magazine</li>
                                          <li class="list-group-item"><i class="fa fa-check"></i>IPPC Qualified</li>
                                       </ul>
                                <div class="card-footer" >
                                    <label class="btn btn-primary btn-block">
                                       <input type="radio" onclick="disAble_csg()" name="options" id="bronzePartner" value="200-500 copies">Give as Bronze Partner
                                    </label>
                             </div>
                         </div>
                     </div>
                     <!-- Silver Partner-->           
                     <div class="col-sm-2 text-center"  style="margin-left:38px;margin-right:38px">
                            <div class="card card-warning card-pricing" id= "silverid" style="width:250px;height:150px;margin-bottom:200px">
                                <div class="card-heading btn-success">
                                   <i class="fa fa-money"></i>
                                    <h3> Silver Partner</h3>
                            </div>
                                    <div class="card-body text-center" >
                                       <p id="moneyValue3"><strong> 501-1000 copies</strong></p>
                                    </div>
                                      <ul class="list-group text-center">
                                          <li class="list-group-item"><i class="fa fa-check"></i>Update emails</li>
                                          <li class="list-group-item"><i class="fa fa-check"></i>Monthly magazine</li>
                                          <li class="list-group-item"><i class="fa fa-check"></i>IPPC Qualified</li>
                                       </ul>
                                <div class="card-footer" >
                                    <label class="btn btn-success btn-block" >
                                       <input type="radio" onclick="disAble_bcg()" name="options" id="silverPartner" value="501-2000 copies">Give as Silver Partner
                                    </label>
                             </div>
                         </div>
                     </div>
                     <br/>
                     <!-- Gold Partner-->           
                     <div class="col-sm-2 text-center"  style="margin-left:38px;margin-right:38px">
                            <div class="card card-warning card-pricing" id= "goldid" style="width:250px;height:150px;margin-bottom:200px">
                                <div class="card-heading btn-warning">
                                   <i class="fa fa-money"></i>
                                    <h3> Gold Partner</h3>
                            </div>
                                    <div class="card-body text-center">
                                       <p id="moneyValue4"><strong> Above 1000 copies</strong></p>
                                    </div>
                                      <ul class="list-group text-center">
                                          <li class="list-group-item"><i class="fa fa-check"></i>Update emails</li>
                                          <li class="list-group-item"><i class="fa fa-check"></i>Monthly magazine</li>
                                          <li class="list-group-item"><i class="fa fa-check"></i>IPPC Qualified</li>
                                       </ul>
                                <div class="card-footer">
                                    <label class="btn btn-warning btn-block">
                                       <input type="radio" onclick="disAble_bcs()" name="options" id="goldPartner" value=">2000 copies">Give as Gold Partner
                                    </label>
                             </div>
                         </div>
                     </div>
                         <br/>
                          
                          <div class="row">
                            <div class="col-sm-3 ">
                                <button type="submit" name="pay" class="btn btn-primary" style="width:250px;margin-bottom:10px;margin-left:50px;">Give Now</button>
                            </div>
                            </form> 
                        </div>
        
                   </div>
                </div>
                     
              
               </div>
              
            
               <?php include 'includes_2/footer.php';?>
       
    </body>
</html>
