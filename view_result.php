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
			
		</tr>
		<tr>
			<td width="50%">Student Name: <b><?php echo ucwords($name) ?></b></td>
			
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
				<th>C.U.E</th>
				<th>C.Load</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php 
    			$items=$conn->query("SELECT r.*,m.module_code,m.module FROM result_items r inner join modules m on m.id = r.module_id where result_id = $id  order by m.module_code asc");
    			while($row = $items->fetch_assoc()):
    		?>
    		<tr>
    			<td><?php echo $row['module_code'] ?></td>
    			<td><?php echo ucwords($row['module']) ?></td>
    			<td class="text-center"><?php echo number_format($row['mark']) ?></td>
    			<td><?php echo ucwords($row['grade']) ?></td>
    			<td><?php echo ucwords($row['c_u_e']) ?></td>
    			<td><?php echo ucwords($row['c_load']) ?></td>
    			<td><?php echo ucwords($row['status']) ?></td>
    		</tr>
			<?php endwhile; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2">Average</th>
				<th class="text-center"><?php  echo number_format($marks,2) ?></th>
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