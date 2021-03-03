<!DOCTYPE html>
<html>
  <head>
	<?php include 'includes_2/head.php';?>

  </head>

<body>
<?php include 'includes_2/monthly_records.php';?>
    <div class="container">
		<h2>Monthly Records</h2>
		<table class="table table-hovered table-striped table-bordered">
			<tr>
			    <th> Id</th>
				<th> UserId</th>
				<th>Transaction Date</th>
				<th>Transaction Amount</th>
				<th>Transaction Code</th>
				
			</tr>
			<?php 
			$sn=1;
			while($all=mysqli_fetch_array($query)){

			?>
			<tr>
				<td><?php echo $sn++; ?></td>
				<td><?php echo $all['id']; ?> </td>
				<td><?php echo $all['user_id']; ?></td>
				<td><?php echo $all['Transaction_date']; ?></td>
				<td><?php echo $all['Transaction_amount']; ?></td>
				<td><?php echo $all['Transaction_code']; ?></td>
				
				<td><a href="#" class= "btn btn-sm btn-primary"> View user <i class="fa fa-eye"></i></a></td>
			</tr>

			<?php
		}

		?>
	</div>
</body>
</html>
