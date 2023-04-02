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
			<td width="30%">Student ID #: <b><?php echo $student_code ?></b></td>
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
			$qry_2 = $conn->query("SELECT r.*,ri.module_id,ri.mark FROM results r inner join result_items ri on r.id = ri.result_id where ri.module_id = 8 and r.id = ".$_GET['id'] )->fetch_assoc();
			foreach($qry_2 as $k => $v){
				$$k = $v;
			}
			  if($marks >=70 && $module_id = 8 && $mark >=68 ){
                   $class = "Distinction";
			  }else if ($marks >=60 && $module_id = 8 && $mark >=58){
				$class = "Merit";
			  }
			?>
			
		<tr>
			<td width="50%">Student Name: <b><?php echo ucwords($name) ?></b></td>
			<td id="class" width="50%">Award Classification: <b><?php echo $class ?></b></td>
			
		</tr>
		<tr>
			<td></td>
			<td class="text-center" width="10%">A: <b><?php echo $sumA ?></b></td>
			<td class="text-center"  width="10%">B: <b><?php echo $sumB ?></b></td>
			<td class="text-center" width="10%">C: <b><?php echo $sumC ?></b></td>
			<td class="text-center" width="10%">D: <b><?php echo $sumD ?></b></td>
			<td class="text-center" width="10%">E: <b><?php echo $sumE ?></b></td>
			<td  class="text-center" width="10%">F: <b><?php echo $sumF ?></b></td>
			
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