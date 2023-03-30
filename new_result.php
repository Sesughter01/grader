  <?php if(!isset($conn)){ include 'db_connect.php'; } 
  

?>  
<!-- <//?php $id = 564 ?> -->
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-result">
              <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
              <div class="row justify-content-center">
               <div class="col-md-6">
              <div id="msg" class=""></div>
               <div class="form-group">
                  <label for="" class="control-label">Student</label>
                  <select name="student_id" id="student_id" class="form-control select2 select2-sm" required>
                  <option></option> 
                  <?php 
                        $students = $conn->query("SELECT s.*,concat(firstname,' ',middlename,' ',lastname) as name FROM students s  order by concat(firstname,' ',middlename,' ',lastname) asc ");
                        // $students = $conn->query("SELECT s.*,concat(firstname,' ',middlename,' ',lastname) as name FROM students s" );
						// var_dump($students);
						// exit();
                        while($row = $students->fetch_array()):

							
                  ?> 
				        
                        <option value="<?php echo $row['id'] ?>"  data-student_id='<?php echo $row['id'] ?>'  data-student='<?php echo $row['name'] ?>'  <?php echo isset($student_id) && $student_id == $row['id'] ? "selected" : '' ?>>
						     
						       <?php echo $row['student_code'].' | '.ucwords($row['name']) ?>
							   
					    </option>
                  <?php endwhile; ?>
                </select>
                <small id="student"><?php echo isset($student) ? "Current Student: ".$student : "" ?></small> 
                <input type="hidden" name="student_id" value="<?php echo isset($student_id) ? $student_id: '' ?>"> 
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="d-flex justify-content-center align-items-center">
            	<div class="form-group col-sm-4">
	                <label for="" class="control-label">Module</label>
	                <select name="" id="module_id" class="form-control select2 select2-sm input-sm">
	                  <option></option> 
	                  <?php 
	                        $modules = $conn->query("SELECT * FROM modules order by module asc ");
	                        while($row = $modules->fetch_array()):
	                  ?>
	                        <option value="<?php echo $row['id'] ?>" data-json='<?php echo json_encode($row) ?>'><?php echo $row['module_code'].' | '.ucwords($row['module']) ?></option>
	                  <?php endwhile; ?>
	                </select>
	                <!-- <select name="" id="c_load" class="form-control select2 select2-sm input-sm">
	                  <option></option>  -->
	                  <?php 
	                        $modules = $conn->query("SELECT * FROM modules order by module asc ");
	                        while($row = $modules->fetch_array()):
	                  ?>
					      <input type="hidden" class="form-control form-control-sm text-right number" value="<?php echo $row['credits'] ?>" id="credits">
	                        <!-- <option value="<//?php echo $row['id'] ?>" data-json='<//?php echo json_encode($row) ?>'><//?php echo $row['credits'] ?></option> -->
	                  <?php endwhile; ?>
	                <!-- </select> -->
	            </div>
	            <div class="form-group col-sm-3">
	                <label for="" class="control-label">Mark</label>
	                <input type="number" class="form-control form-control-sm text-right number" id="mark" maxlength="6">
	            </div>
				<!-- <input type="hidden" class="form-control form-control-sm text-right number" id="c_load" value="<//?php echo $row['id'] ?>"> -->

	            <button class="btn btn-sm btn-primary bg-gradient-primary" type="button" id="add_mark">Add</button>
            </div>
        </div>
    	<hr>
    	<div class="col-md-8 offset-md-2">
            <table class="table table-bordered" id="mark-list">
            	<thead>
            		<tr>
            			<th>Module Code</th>
            			<th>Module</th>
            			<th>Mark</th>
            			<th>Grade</th>
            			<th>Credit Load</th>
            			<th>C_U_E</th>
            			<th>Status</th>

            			<th></th>
            		</tr>
            	</thead>
            	<tbody>
            		<?php if(isset($id)): ?>
            		<?php 
            			$items=$conn->query("SELECT r.*,m.module_code,m.module,m.id as mid FROM result_items r inner join modules m on m.id = r.module_id where result_id = $id order by m.module_code asc");
						
            			while($row = $items->fetch_assoc()):
							
            		?>
            		<tr data-id="<?php echo $row['mid'] ?>">
            			<td><input type="hidden" name="module_id[]" value="<?php echo $row['module_id'] ?>"><?php echo $row['module_code'] ?></td>
            			<td><?php echo ucwords($row['module']) ?></td>
            			<td><input type="hidden" name="mark[]" value="<?php echo $row['mark'] ?>"><?php echo $row['mark'] ?></td>
						
            			<td><input type="hidden" id="grade" name="grade[]" value="<?php echo $row['grade'] ?>"><?php echo $row['grade'] ?></td>
            			<td><input type="hidden" name="c_u_e[]" value="<?php echo $row['c_u_e'] ?>"><?php echo $row['c_u_e'] ?></td>
            			<td><input type="hidden"  name="c_load[]" value="<?php echo $row['c_load'] ?>"><?php echo $row['c_load'] ?></td>
            			<td><input type="hidden" name="status[]" value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></td>
            			<td class="text-center"><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove() && calc_ave()"><i class="fa fa-times"></i></button></td>
            		</tr>
            		<?php endwhile; ?>
            		<script>
            			$(document).ready(function(){
            				calc_ave()
							grade()
							cue()
            			})


            		</script>
            		<?php endif; ?>

            	</tbody>
            	<tfoot>
            		<!-- <tr>
					    <th colspan="2">Grade</th>
            			<th id="grade" class="text-center"></th>
            			
            			<th></th>
            		</tr> -->
            		<!-- <tr>
					   
            			<th colspan="2">C_U_E</th>
            			<th id="cue" class="text-center"></th>
            			
            			<th></th> 
            		</tr>-->
            		<tr>
					   
					
            			<th colspan="6">Average</th>
            			<th id="average" class="text-center"></th>
            			<!-- <th></th> -->
            		</tr>
            	</tfoot>
            </table>
            <input type="hidden" name="marks" value="<?php echo isset($marks) ? $marks : '' ?>">
            <!-- <input type="hidden" name="status" value="<//?php echo isset($status) ? $status : '' ?>">  -->
            <!-- <input type="hidden" name="cue" value="<//?php echo isset($cue) ? $cue : '' ?>">  -->
          </div>
        </div>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-result">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=results">Cancel</a>
  		</div>
  	</div>
	</div>
</div>
<script>
	$('#student_id').change(function(){
		var student_id = $('#student_id option[value="'+$(this).val()+'"]').attr('data-student_id');
		var _student = $('#student_id option[value="'+$(this).val()+'"]').attr('data-student');
		$('[name="student_id"]').val(student_id);
		$('#student').text("Current student: "+_student);
	})
	$('#add_mark').click(function(){
		var module_id = $('#module_id').val()
		var mark = $('#mark').val()
		
	   
		var mygrade = grade();
		var mycue = cue();
		var mystatus = status();
		//  cue();
	    // console.log(credit_load);
		
		if(module_id == '' && mark == ''){
			alert_toast("Please select module & enter a mark before adding to list.","error");
			return false;
		}
		var sData = $('#module_id option[value="'+module_id+'"]').attr('data-json')
			sData = JSON.parse(sData)
		if($('#mark-list tr[data-id="'+module_id+'"]').length > 0){
			alert_toast("Module already on the list.","error");
			return false;
		}
		var tr = $('<tr data-id="'+module_id+'"></tr>')
		tr.append('<td><input type="hidden" name="module_id[]" value="'+module_id+'">'+sData.module_code+'</td>')
		tr.append('<td>'+sData.module+'</td>')
		tr.append('<td class="text-center"><input type="hidden" name="mark[]" value="'+mark+'">'+mark+'</td>')
		tr.append('<td class="text-center"><input type="hidden" id="grade" name="grade[]" value="'+mygrade+'" >'+mygrade+'</td>')
		tr.append('<td class="text-center"><input type="hidden"  name="c_load[]" value="'+sData.credits+'">'+sData.credits+'</td>')
		tr.append('<td class="text-center"><input type="hidden" id="c_u_e" name="c_u_e[]" value="'+mycue+'" >'+mycue+'</td>')
		tr.append('<td class="text-center"><input type="hidden" id="status" name="status[]" value="'+mystatus+'" >'+mystatus+'</td>')
		tr.append('<td class="text-center"><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest(\'tr\').remove() && calc_ave()"><i class="fa fa-times"></i></button></td>')
		$('#mark-list tbody').append(tr)
		$('#module_id').val('').trigger('change')
		$('#mark').val('')
		calc_ave()
		// grade()
		// var mycue = cue();
		
	
	})
	function calc_ave(){
		var total = 0;
		var i = 0;
		$('#mark-list [name="mark[]"]').each(function(){
			i++;
			total = total + parseFloat($(this).val())
		})
		// $('#average').text(parseFloat(total/i).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2}))
		// $('[name="marks"]').val(parseFloat(total/i).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2}))
		$('#average').text(parseFloat(total/i))
		$('[name="marks"]').val(parseFloat(total/i))
	}

	function grade(){
		
         var grade = '';
		 
		 var new_mark = $('#mark').val();
		 num_mark = parseInt(new_mark);
		//  console.log(typeof(num_mark));
		 if(num_mark<50){
            grade = 'F';
			
		 }else if(num_mark >= 50 && num_mark <=59 ){
			grade = 'C';
			
		 }else if(num_mark >= 60 && num_mark <=69){
			grade = 'B';
			
		 }else if(num_mark >= 70){
			grade = 'A'
			
		 }
		
		
		// $('[name="status"]').val(gradStatus[1])
		return grade;
		
	}

	function status(){
          var status = '';
         
         var new_mark = $('#mark').val();
         num_mark = parseInt(new_mark);
        //  console.log(typeof(num_mark));
         if(num_mark<50){
           
            status = 'failed';
         }else if(num_mark >= 50 && num_mark <=59 ){
           
            status = 'passed';
         }else if(num_mark >= 60 && num_mark <=69){
           
            status = 'passed';
         }else if(num_mark >= 70){
           
            status = 'passed';
         }
        
        //   $('[name="status"]').val(gradStatus[1])
         return status;
        
    }

	function cue(){
		var module_id = $('#module_id').val();
		var new_mark = $('#mark').val();
		var num_mark = parseFloat(new_mark);

		var smData = $('#module_id option[value="'+module_id+'"]').attr('data-json');
			smData = JSON.parse(smData)
		    var credit_load = smData.credits;
		console.log(credit_load);
        var cue = 0;
        if(num_mark<50){
			cue = 0;
		}else{
			cue = credit_load;
		}
		
        return cue;
    }	

$('#manage-result').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			
			url:'ajax.php?action=save_result',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
              location.href = 'index.php?page=results'
					},2000)
				}else if(resp == 2){
          $('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Student Code already exist.</div>')
          end_load()
        }
			}
		})
	})
  function displayImgCover(input,_this) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#cover').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>