<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);

		
		$hash_pass = md5($password);
		if($user_type == 1){

			$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where username = '".$username."' and password = '".$hash_pass."' and user_type= $user_type");
		if($qry->num_rows > 0){
			$val_qry =$qry->fetch_array();
			foreach ( $val_qry as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
				
			}
				return 1;
		}else{
			return 2;
		}
		}
		if ($user_type == 3){
			$qry = $this->db->query("SELECT s.*,concat(u.firstname,u.middlename,u.lastname) as name,u.user_type,u.username FROM students s inner join  users u on s.user_id = u.id where u.username = '".$username."' and u.password = '".$hash_pass."'  and  u.user_type= ".$user_type);
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
						// $_SESSION['login_student_id'] = $id;
				}
					return 1;
			}else{
				return 2;
			}
		}

	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM students where student_code = '".$student_code."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['rs_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($cpass) && !empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' " .(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function signup(){
		extract($_POST);
		$data = "";
		$std_data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','student_code')) && !is_numeric($k)){
				if($k =='password'){
					if(empty($v))
						continue;
					$v = md5($v);

				}
				// "$firstname = 'jon'"
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
       foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password','user_type','username','email')) && !is_numeric($k)){
				
				if(empty($std_data)){
					$std_data .= " $k='$v' ";
				}else{
					$std_data .= ", $k='$v' ";
				}
				
			}
		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");

		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}
        if(isset($student_code) && !empty($student_code)){

			$check2 = $this->db->query("SELECT * FROM students where student_code ='$student_code' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
			if($check2 > 0){
				return 2;
				exit;
		}
        if(!isset($user_id) && !empty($student_code)){

			$check3 = $this->db->query("SELECT * FROM users ")->num_rows;
			$std_data .= ", user_id = ".$check3++;
		}
	}
	if(!empty($student_code)){
			$save2 = $this->db->query("INSERT INTO students set $std_data");
		
		}
		if($save){
			if(empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if(!in_array($key, array('id','cpass','password')) && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				 $_SESSION['login_id'] = $id;
					$_SESSION['login_user_type'] = $user_type;
			return 1;
		}
		if($save2 ){
			if(empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if(!in_array($key, array('id','cpass','password')) && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			
			

			$_SESSION['login_student_id'] = $id;
				 $_SESSION['login_id'] = $id;
					$_SESSION['login_user_type'] = $user_type;
			return 1;
		}
	}
    
	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_FILES['img']['tmp_name'] != '')
			$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function save_my_settings(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if(!is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['cover']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", cover_img = '$fname' ";

		}
		$chk = $this->db->query("SELECT * FROM my_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE my_settings set $data where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO my_settings set $data");
		}
		if($save){
			foreach($_POST as $k => $v){
				if(!is_numeric($k)){
					$_SESSION['system'][$k] = $v;
				}
			}
			if($_FILES['cover']['tmp_name'] != ''){
				$_SESSION['system']['cover_img'] = $fname;
			}
			return 1;
		}
	}
	function save_image(){
		extract($_FILES['file']);
		if(!empty($tmp_name)){
			$fname = strtotime(date("Y-m-d H:i"))."_".(str_replace(" ","-",$name));
			$move = move_uploaded_file($tmp_name,'../assets/uploads/'. $fname);
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
			$hostName = $_SERVER['HTTP_HOST'];
			$path =explode('/',$_SERVER['PHP_SELF']);
			$currentPath = '/'.$path[1]; 
			if($move){
				return $protocol.'://'.$hostName.$currentPath.'/assets/uploads/'.$fname;
			}
		}
	}
	
	function save_module(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$chk = $this->db->query("SELECT * FROM modules where module_code ='$module_code' and id != '$id' ");
		if($chk->num_rows > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO modules set $data");
		}else{
			$save = $this->db->query("UPDATE modules set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_module(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM modules where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_student(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','areas_id')) && !is_numeric($k)){
				if($k == 'description')
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$chk = $this->db->query("SELECT * FROM students where student_code ='$student_code' and id != '$id' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO students set $data");
		}else{
			$save = $this->db->query("UPDATE students set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_student(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM students where id = $id");
		if($delete){
			return 1;
		}
	}

	function save_result(){
		extract($_POST);
		$data = "";

		// var_dump($_POST);
		// exit();
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','mark','module_id','grade','c_u_e','status','c_load')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$chk = $this->db->query("SELECT *FROM results r where student_id ='$student_id'  and id != '$id' ");
		if($chk->num_rows > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO results set $data");
		}else{
			$save = $this->db->query("UPDATE results set $data where id = $id");
		}
		if($save){
				$id = empty($id) ? $this->db->insert_id : $id;
				$this->db->query("DELETE FROM result_items where result_id = $id");
				foreach($module_id as $k => $v){
					$data= " result_id = $id ";
					$data.= ", module_id = $v ";
					$data.= ", mark = '{$mark[$k]}' ";
					$data.= ", grade = '{$grade[$k]}' ";
					$data.= ", c_u_e = '{$c_u_e[$k]}' ";
					$data.= ", c_load = '{$c_load[$k]}' ";
					$data.= ", status = '{$status[$k]}' ";
					$this->db->query("INSERT INTO result_items set $data");
				}
				return 1;
		}
	}
	function delete_result(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM results where id = $id");
		if($delete){
			return 1;
		}
	}
	
}
?>