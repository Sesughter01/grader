<?php
include 'db_connect.php';
$qry = $conn->query("SELECT r.*,concat(s.firstname,' ',s.middlename,' ',s.lastname) as name,s.student_code FROM results r inner join  students s on s.id = r.student_id where r.id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
?>
<div class="container-fluid" id="printable">
	<table width="100%">
		<tr>
			<td width="50%">Student ID #: <b><?php echo $student_code ?></b></td>
			<td id="award" width="50%">Award: <b></b></td>
			

			
			
		</tr>
		<?php 
			    $sumA =0;
			    $sumB =0;
			    $sumC =0;
			    $sumD =0;
			    $sumE =0;
			    $sumF =0;
				$class="";

				$items=$conn->query("SELECT r.*,m.module_code,m.module FROM result_items r inner join modules m on m.id = r.module_id where result_id = $id  order by m.module_code asc");

				while($row = $items->fetch_assoc()){
			    if($row['grade']=='A'){
					$sumA ++;
				}else if($row['grade']=='B'){
					$sumB ++;
				}
				else if($row['grade']=='C'){
					$sumC ++;
				}
				else if($row['grade']=='D'){
					$sumD ++;
				}
				else if($row['grade']=='E'){
					$sumE ++;
				}
				else if($row['grade']=='F'){
					$sumF ++;
				}
			}
			$qry_2 = $conn->query("SELECT r*,ri.module_id,ri.mark from results r inner join result_items ri on r.id = ri.result_id where r.id = ".$_GET['id']." and ri.module_id=8")->fetch_array();
			foreach($qry_2 as $k => $v){
				$$k = $v;
			}
			  if($marks >=70 && $module_id = 8 && $mark >=68 ){

			  }
			?>
			
		<tr>
			<td width="50%">Student Name: <b><?php echo ucwords($name) ?></b></td>
			<td id="class" width="50%">Award Classification: <b></b></td>
			
		</tr>
		<tr>
			<td class="text-left" width="10%">A: <b><?php echo $sumA ?></b></td>
			<td width="10%">B: <b><?php echo $sumB ?></b></td>
			<td width="10%">C: <b><?php echo $sumC ?></b></td>
			<td width="10%">D: <b><?php echo $sumD ?></b></td>
			<td width="10%">E: <b><?php echo $sumE ?></b></td>
			<td width="10%">F: <b><?php echo $sumF ?></b></td>
			
		</tr>
	</table>
	<hr>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Module Code</th>
				<th>Module</th>
				<th>Mark</th>
				<th>Grade</th>
				<th>C.Load</th>
				<th>C.U.E</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php 
    			$items=$conn->query("SELECT r.*,m.module_code,m.module FROM result_items r inner join modules m on m.id = r.module_id where result_id = $id  order by m.module_code asc");
    			while($row = $items->fetch_assoc()):
    		?>
    		<tr>
    			<td class="module_arr"><?php echo $row['module_code'] ?></td>
    			<td ><?php echo ucwords($row['module']) ?></td>
    			<td class="score" ><?php echo number_format($row['mark']) ?></td>
    			<td><?php echo ucwords($row['grade']) ?></td>
    			<td><?php echo ucwords($row['c_load']) ?></td>
    			<td id="cue"><?php echo $row['c_u_e'] ?></td>
    			<td><?php echo ucwords($row['status']) ?></td>
    		</tr>
			<?php endwhile; ?>
               
			<!-- <script>
                  
            			$(document).ready(function(){
            				calc_cue()
							
            			})


            		

			</script> -->

		</tbody>
		<tfoot>
			<tr>
				<th colspan="2">Average</th>
				<th id="average_score" class="text-center"><?php  echo number_format($marks,2) ?></th>
			</tr>
			<?php
			  $sum =0;
			   $items=$conn->query("SELECT r.*,m.module_code,m.module FROM result_items r inner join modules m on m.id = r.module_id where result_id = $id  order by m.module_code asc");
			    while($row = $items->fetch_assoc()){
                    
					$sum += $row['c_u_e'];
				}
					
				
			?>
			
			<tr class="tcueContainer">
				<th colspan="2">Total Credit Earned</th>
				<th id="tcue" class="text-center"><?php  echo number_format($sum,2) ?></th>
			</tr>
			
		</tfoot>
	</table>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-success" id="print"><i class="fa fa-print"></i> Print</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
<noscript>
	<style>
		table.table{
			width:100%;
			border-collapse: collapse;
		}
		table.table tr,table.table th, table.table td{
			border:1px solid;
		}
		.text-cnter{
			text-align: center;
		}
	</style>
	<h3 class="text-center"><b>Student Result</b></h3>
</noscript>
<script>
	$(document).ready(function(){
		
		award();
		classify();		
            			})


    function award(){
		var total = $('#tcue').text();
		var int_total = parseFloat(total);

		var award = "";
		if(int_total >=120 && int_total < 180 ){
			award = "PG Diploma in Computing";
		}else if(int_total >=180){
			award = "MSc in Computer Science";
		} else {
			award="";
		}
		$('#award b').text(award)
		return award;
	}
    // function classify(){
	// 	var avg = $('#average_score').text();
	// 	var module_desertation_arr = $('.module_arr').text();
	// 	var desertation_mod_str =  module_desertation_arr;
	// 	var desert_mod = "";
    //      var  desertation_mod_arr= desertation_mod_str.match(/.{1,4}/g).map(s => s.padEnd(4, "_"));
    //      console.log(desertation_mod_arr); // ["He", "ll", "oW", "or", "ld"]




	// 	var score_str = 0;
	// 	// var score_str = $('.score').text();
	// 	// var score_str_arr = score_str.match(/.{1,2}/g).map(s=>s.padEnd(2,"_"));
	// 	var int_score = 0;

	// 	var int_module_desertation = 0;
	// 	var int_avg = parseFloat(avg);
    //     //   console.log(typeof module_desertation);
    //     //   console.log(int_avg);
    //     //   console.log(int_score);
	// 	var my_class = "";
	// 	if(int_avg >=60 ){
	// 		for (mod in desertation_mod_arr){

	// 			if (mod == '7009'){
	// 				desert_mod = mod;
	// 				score = $('.score').text();
    //                 int_score=  parseFloat(score);
	// 				break;
	// 			}
	// 		}
			
	// 		// console.log(module_desertation);
	// 		my_class = "Merit";

	// 	}else if(int_avg >=70 && module_desertation == '7009' && int_score >= 68){
	// 		my_class = "Distinction";
	// 	} else {
	// 		my_class = "";
	// 	}
	// 	$('#class b').text(my_class)
	// 	return my_class;
	// }



	$('#print').click(function(){
		start_load()
		var ns = $('noscript').clone()
		var content = $('#printable').clone()
		ns.append(content)
		var nw = window.open('','','height=700,width=900')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			nw.close()
			end_load()
		},750)

	})
</script>