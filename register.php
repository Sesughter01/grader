<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
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
if(isset($_SESSION['login_id']))
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
  			<div class="card col-md-4">
  				<div class="card-body">
  					<form id="reg-form" >
  						<div class="form-group">
  							<label for="firstname" class="control-label text-dark">First name</label>
  							<input type="text" id="firstname" name="firstname" class="form-control form-control-sm">
  						</div>
  						<div class="form-group">
  							<label for="lastname" class="control-label text-dark">Last name</label>
  							<input type="text" id="lastname" name="lastname" class="form-control form-control-sm">
  						</div>
  						<div class="form-group">
  							<label for="username" class="control-label text-dark">Username</label>
  							<input type="text" id="username" name="username" class="form-control form-control-sm">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label text-dark">Password</label>
  							<input type="password" id="password" name="password" class="form-control form-control-sm">
  						</div>
  						<div class="form-group">
  							<label for="cpass" class="control-label text-dark">Confirm Password</label>
  							<input type="password" id="cpass" name="cpass" class="form-control form-control-sm">
  						</div>
  						<div class="w-100 d-flex justify-content-center align-items-center">
                <button class="btn-sm btn-block btn-wave col-md-4 btn-primary m-0 mr-1">Register</button>
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
		$('#reg-form button[type="button"]').removeAttr('disabled').html('Register');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else{
					$('#reg-form').prepend('<div class="alert alert-danger">Fields must be filled or wrong data type.</div>')
					$('#reg-form button[type="button"]').removeAttr('disabled').html('Register');
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