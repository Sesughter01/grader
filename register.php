<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM my_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register | <?php echo $_SESSION['system']['name'] ?></title>
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_user_type']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    position: fixed;
	    top:5%;
	    left: 0;
      align-items:center !important;
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		display: flex;
	}

</style>

<body class="bg-dark">


  <main id="main" >
  	
  <div class="align-self-center w-100">
		<h4 class="text-white text-center"><b><?php echo $_SESSION['system']['name'] ?> - Admin</b></h4>
  		<div id="register-center" class="bg-dark row justify-content-center">
  			<div class="container bg-light rounded-lg col-md-6 p-md-2 ">
  				<div class="p-sm-2">
  					<form id="reg-form" >
              <!-- <div class="container mx-auto"> -->


                <div class=" d-lg-flex justify-content-center align-items-center p-sm-2 mx-auto">
                  <div class="  col-12 col-lg-6 ">
                    <label for="firstname" class="control-label text-dark">First name</label>
                    <input type="text" id="firstname" name="firstname" class="form-control form-control-sm">
                  </div>
                  <div class=" col-12 col-lg-6">
                    <label for="lastname" class="control-label text-dark">Last name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control form-control-sm">
                  </div>
  
  
                </div>
                <div class="d-lg-flex justify-content-center align-items-center p-sm-2 mx-auto">
                    <div class="col-12 col-lg-6 ">
                      <label for="middlename" class="control-label text-dark">Middle name</label>
                      <input type="text" id="middlename" name="middlename" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 col-lg-6 ">
                      <label for="username" class="control-label text-dark">Username</label>
                      <input type="text" id="username" name="username" class="form-control form-control-sm">
                    </div>
              </div>
                <div class="d-lg-flex justify-content-center align-items-center p-sm-2 mx-auto">
                  <div class=" col-12 col-lg-6  ">
                    <label for="password" class="control-label text-dark">Password</label>
                    <input type="password" id="password" name="password" class="form-control form-control-sm">
                    <small id="pass_match" data-status=''></small>
                  </div>
                  <div class=" col-12 col-lg-6 ">
                    <label for="cpass" class="control-label text-dark">Confirm Password</label>
                    <input type="password" id="cpass" name="cpass" class="form-control form-control-sm">
                  </div>
                </div>
                <div class=" justify-content-center align-items-center p-sm-2 mx-auto">
                  <div class="col-12  ">
                    <label for="email" class="control-label text-dark">Email</label>
                    <input type="email" id="email" name="email" class="form-control form-control-sm">
                  </div>
                  <div class=" col-12  ">
                  <label for="user_type" class="control-label">User Role</label>
                    <select name="user_type" id="user_type" class="custom-select custom-select-sm">
                      <option value="3" <?php echo isset($user_type) && $user_type == 3 ? 'selected' : '' ?>>Student</option>
                      <option value="2" <?php echo isset($user_type) && $user_type == 2 ? 'selected' : '' ?>>Registrar</option>
                      <option value="1" <?php echo isset($user_type) && $user_type == 1 ? 'selected' : '' ?>>Admin</option>
                    </select>
                  </div>
                  
                </div>

              <!-- </div> -->
              <div class="w-100 d-flex justify-content-center align-items-center my-2">
                  <button id="reg-btn" class="btn-sm btn-block btn-wave col-md-4 btn-primary m-0 mr-1">Register</button>
                  <button class="btn-sm btn-block btn-wave col-md-4 btn-success m-0" type="button" id="view_result">View Result</button>
                </div>
            
  					</form>
                      <a href="./login.php" class="back-to-top">Already have an account? Login</a>
  				</div>
  			</div>
  		</div>
  </div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<div class="modal fade" id="view_student_results" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="vsr-frm">
            <div class="form-group">
                <label for="student_code" class="control-label text-dark">Student ID #:</label>
                <input type="text" id="student_code" name="student_code" class="form-control form-control-sm">
              </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#view_student_results form').submit()">View</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>

</body>
<?php include 'footer.php' ?>
<script>
  $('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
			}else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})
  $('#view_result').click(function(){
    $('#view_student_results').modal('show')
  })
	$('#reg-form').submit(function(e){
		e.preventDefault()
		$('#reg-form button[type="button"]').attr('disabled',true).html('Signing up...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=signup',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#reg-form #reg-btn ').removeAttr('disabled').html('Register');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else{
					$('#reg-form').prepend('<div class="alert alert-danger">Fields must be filled or wrong data type.</div>')
					$('#reg-form #reg-btn').removeAttr('disabled').html('Register');
					$('#reg-form #reg-btn + button[type="button"]').removeAttr('disabled').html('View Result');
				}
			}
		})
	})
  $('#vsr-frm').submit(function(e){
    e.preventDefault()
   start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login2',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load()
      },
      success:function(resp){
        if(resp == 1){
          location.href ='student_results.php';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Student ID # is incorrect.</div>')
           end_load()
        }
      }
    })
  })
  $('#vsr-frm').submit(function(e){
    e.preventDefault()
   start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login2',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load()
      },
      success:function(resp){
        if(resp == 1){
          location.href ='student_results.php';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Student ID # is incorrect.</div>')
           end_load()
        }
      }
    })
  })
	$('.number').on('input keyup keypress',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9 \,]/, '');
        val = val.toLocaleString('en-US')
        $(this).val(val)
    })
</script>	
</html>