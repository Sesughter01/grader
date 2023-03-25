<?php
include 'db_connect.php';
$qry = $conn->query("SELECT r.*,concat(s.firstname,' ',s.middlename,' ',s.lastname) as name FROM results r inner join students s on s.id = r.student_id where r.id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'new_result.php';
?>