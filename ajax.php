<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'update_user'){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == 'upload_file'){
	$save = $crud->upload_file();
	if($save)
		echo $save;
	// var_dump($_FILES);
}
if($action == 'remove_file'){
	$delete = $crud->remove_file();
	if($delete)
		echo $delete;
}

if($action == 'save_upload'){
	$save = $crud->save_upload();
	if($save)
		echo $save;
}
if($action == 'delete_file'){
	$delete = $crud->delete_file();
	if($delete)
		echo $delete;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'assign_file'){
	$assign_file = $crud->assign_file();
	if($assign_file)
		echo $assign_file;
}
if($action == 'delete_assign_file'){
	$delete = $crud->delete_assign_file();
	if($delete)
		echo $delete;
}

if($action == 'update_staffs'){
	$update_staffs = $crud->update_staffs();
	if($update_staffs)
		echo $update_staffs;
}

if($action == 'update_sch'){
	$update_sch = $crud->update_sch();
	if($update_sch)
		echo $update_sch;
}

ob_end_flush();
?>
