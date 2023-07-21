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
		$qry = $this->db->query("SELECT *,concat(firstname,' ',middlename,' ',lastname) as name FROM users where email = '".$email."' and password = '".md5($password)."'");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key == 'isActive' && $value == 0) {
					session_destroy();
					return 4;
				}
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			//[id, firstname, password, name, isActive]
			// loop 1: password
			// loop 2: name
			// loop 3: isActive
			return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				} 
				else{
					$data .= ", $k='$v' ";
				}
				
			}
		}

		if (!isset($isActive)) {
			$data .= ", isActive=0";
		}

		//firstname={a, && isActive = 1}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
			// return "INSERT INTO users set $data";
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
			// return "UPDATE users set $data where id = $id";
		}

		if($save){
			return $save;
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
	function upload_file(){
		extract($_FILES['file']);
		// var_dump($_FILES);
		if($tmp_name != ''){
				$fname = strtotime(date('y-m-d H:i')).'_'.$name;
				$move = move_uploaded_file($tmp_name,'assets/uploads/'. $fname);
		}
		if(isset($move) && $move){
			return json_encode(array("status"=>1,"fname"=>$fname));
		}
	}
	function remove_file(){
		extract($_POST);
		if(is_file('assets/uploads/'.$fname))
			unlink('assets/uploads/'.$fname);
		return 1;
	}
	function delete_file(){
		extract($_POST);
		$doc = $this->db->query("SELECT * FROM documents where document_id= $id")->fetch_array();
		$query = "UPDATE documents SET is_deleted = 1 where document_id = $id"; //buat soft delete and tambah column is_deleted di table
		echo $query;
		$delete = $this->db->query($query);
		if($delete){
			foreach(json_decode($doc['file_json']) as $k => $v){
				if(is_file('assets/uploads/'.$v))
				unlink('assets/uploads/'.$v);
			}
			return 1;
		}
	}
	function save_upload(){
		extract($_POST);
		// var_dump($_FILES);
		$data = " title ='$title' ";
		$data .= ", description ='".htmlentities(str_replace("'","&#x2019;",$description))."' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
		$data .= ", file_json ='".json_encode($fname)."' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO documents set $data ");
		}else{
			$data .= ", updated_at='".date('Y-m-d H:i:s')."'";
			$save = $this->db->query("UPDATE documents set $data where document_id = $id");
		}
		if($save){
			return 1;
		}
	}
	function assign_file() {
		extract($_POST);
		$data = "recipient = '$recipient' ";
		$data .= ", document_id = '$document_id' ";
		$data .= ", created_by = '$user_id';";
		$query = "INSERT INTO shared_files SET $data"; //"recipient = '$recipient', document_id = '$document_id';";
		echo $query;
		$assign_file = $this->db->query($query);
		if($assign_file) {
			return 1;
		}
	}

	function delete_assign_file(){
		extract($_POST);
		// $delete = $this->db->query("DELETE FROM shared_files  where recipient = ".$id);
		$query = "UPDATE shared_files SET is_deleted = 1 WHERE id = $id";
		echo $query;
		$delete = $this->db->query($query);
		if($delete) {
			return 1;
		}
	}

	function update_staffs(){
		extract($_POST);
		$query = "UPDATE staff_info SET";
		$query .= " edu = '$edu' ,";
		$query .= " adm = '$adm' ,";
		$query .= " it = '$it' ,";
		$query .= " eng = '$eng' , ";
		$query .= " tsec_schl = '$tsec_schl' ,";
		$query .= " tpm_schl = '$tpm_schl' ,";
		$query .= " tcsec_schl = '$tcsec_schl' ,";
		$query .= " tcpm_schl = '$tcpm_schl' ,";
		$query .= " tot_student = '$tot_student' ";
		$query .= " where id = $id";
		
		echo $query;		
		$update_staffs = $this->db->query($query);
		if ($update_staffs) {
			return 1;
		}
	}

		
	
}