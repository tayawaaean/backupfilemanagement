<?php
session_start();
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
		$password = md5($password); // Encrypt the input password using MD5 encryption
	
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' ");
		if($qry->num_rows > 0){
			$user = $qry->fetch_assoc();
			// Check if the stored password matches the input password after decoding it
			if($user['password'] == $password){
				foreach ($user as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
				return 1; // Login successful
			}else{
				return 2; // Incorrect password
			}
		}else{
			return 3; // User not found
		}
	}
	

	function register(){
		extract($_POST);
		// Encrypt the password using MD5 encryption
		$password = md5($password);
	
		// Check if the username already exists
		$check = $this->db->query("SELECT * FROM users where username ='".$username."'")->num_rows;
		if($check > 0){
			// If username already exists, return a status indicating failure
			return 2; // Status 2 indicates username already exists
		} else {
			// If username doesn't exist, proceed with the registration process
			$data = " name ='".$name."' ";
			$data .= ", username ='".$username."' ";
			$data .= ", password ='".$password."' ";
			// Set the type column to 0
			$data .= ", type = 0 ";
			// Insert the user data into the users table
			$save = $this->db->query("INSERT INTO users set ".$data);
			if($save){
				// If registration is successful, return a status indicating success
				return 1; // Status 1 indicates successful registration
			}
		}
	}
	
	function forgot_password(){
		extract($_POST);
	
		// Check if the username exists
		$check = $this->db->query("SELECT * FROM users where username ='".$username."'")->num_rows;
		if($check > 0){
			// If username exists, proceed with changing the password
			if($new_password === $confirm_new_password){
				// Encrypt the new password using MD5 encryption
				$new_password = md5($new_password);
	
				// Update the user's password in the database
				$update = $this->db->query("UPDATE users SET password ='".$new_password."' WHERE username ='".$username."'");
				if($update){
					// If password update is successful, return a status indicating success
					return 1; // Status 1 indicates successful password reset
				} else {
					// If password update fails, return a status indicating failure
					return 3; // Status 3 indicates password reset failed
				}
			} else {
				// If new password and confirm new password do not match, return a status indicating failure
				return 2; // Status 2 indicates new password and confirm new password mismatch
			}
		} else {
			// If username doesn't exist, return a status indicating failure
			return 4; // Status 4 indicates username does not exist
		}
	}
	
	

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	function save_folder(){
		extract($_POST);
		$data = " name ='".$name."' ";
		$data .= ", parent_id ='".$parent_id."' ";
		if(empty($id)){
			$data .= ", user_id ='".$_SESSION['login_id']."' ";
			
			$check = $this->db->query("SELECT * FROM folders where user_id ='".$_SESSION['login_id']."' and name  ='".$name."'")->num_rows;
			if($check > 0){
				return json_encode(array('status'=>2,'msg'=> 'Folder name already exist'));
			}else{
				$save = $this->db->query("INSERT INTO folders set ".$data);
				if($save)
				return json_encode(array('status'=>1));
			}
		}else{
			$check = $this->db->query("SELECT * FROM folders where user_id ='".$_SESSION['login_id']."' and name  ='".$name."' and id !=".$id)->num_rows;
			if($check > 0){
				return json_encode(array('status'=>2,'msg'=> 'Folder name already exist'));
			}else{
				$save = $this->db->query("UPDATE folders set ".$data." where id =".$id);
				if($save)
				return json_encode(array('status'=>1));
			}

		}
	}

	function delete_folder(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM folders where id =".$id);
		if($delete)
			echo 1;
	}
	function delete_file(){
		extract($_POST);
		$path = $this->db->query("SELECT file_path from files where id=".$id)->fetch_array()['file_path'];
		$delete = $this->db->query("DELETE FROM files where id =".$id);
		if($delete){
					unlink('assets/uploads/'.$path);
					return 1;
				}
	}

	function save_files(){
		extract($_POST);
		if(empty($id)){
		if($_FILES['upload']['tmp_name'] != ''){
					$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['upload']['name'];
					$move = move_uploaded_file($_FILES['upload']['tmp_name'],'assets/uploads/'. $fname);
		
					if($move){
						$file = $_FILES['upload']['name'];
						$file = explode('.',$file);
						$chk = $this->db->query("SELECT * FROM files where SUBSTRING_INDEX(name,' ||',1) = '".$file[0]."' and folder_id = '".$folder_id."' and file_type='".$file[1]."' ");
						if($chk->num_rows > 0){
							$file[0] = $file[0] .' ||'.($chk->num_rows);
						}
						$data = " name = '".$file[0]."' ";
						$data .= ", folder_id = '".$folder_id."' ";
						$data .= ", description = '".$description."' ";
						$data .= ", user_id = '".$_SESSION['login_id']."' ";
						$data .= ", file_type = '".$file[1]."' ";
						$data .= ", file_path = '".$fname."' ";
						if(isset($is_public) && $is_public == 'on')
						$data .= ", is_public = 1 ";
						else
						$data .= ", is_public = 0 ";

						$save = $this->db->query("INSERT INTO files set ".$data);
						if($save)
						return json_encode(array('status'=>1));
		
					}
		
				}
			}else{
						$data = " description = '".$description."' ";
						if(isset($is_public) && $is_public == 'on')
						$data .= ", is_public = 1 ";
						else
						$data .= ", is_public = 0 ";
						$save = $this->db->query("UPDATE files set ".$data. " where id=".$id);
						if($save)
						return json_encode(array('status'=>1));
			}

	}
	function file_rename(){
		extract($_POST);
		$file[0] = $name;
		$file[1] = $type;
		$chk = $this->db->query("SELECT * FROM files where SUBSTRING_INDEX(name,' ||',1) = '".$file[0]."' and folder_id = '".$folder_id."' and file_type='".$file[1]."' and id != ".$id);
		if($chk->num_rows > 0){
			$file[0] = $file[0] .' ||'.($chk->num_rows);
			}
		$save = $this->db->query("UPDATE files set name = '".$name."' where id=".$id);
		if($save){
				return json_encode(array('status'=>1,'new_name'=>$file[0].'.'.$file[1]));
		}
	}
	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", type = '$type' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}	
}