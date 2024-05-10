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
		// Check if username already exists
		$check_username = $this->db->query("SELECT * FROM users WHERE username = '".$username."'");
		if($check_username->num_rows > 0){
			return 2; // Username already exists
		} else {
			// Encrypt the password using MD5 encryption
			$password = md5($password);
			// Insert user data into the database
			$insert_query = "INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')";
			$insert = $this->db->query($insert_query);
			if($insert){
				return 1; // Registration successful
			} else {
				return 0; // Registration failed
			}
		}
	}

	function forgot_password(){
		extract($_POST);
		// Check if username exists
		$check_username = $this->db->query("SELECT * FROM users WHERE username = '".$username3."'");
		if($check_username->num_rows > 0){
			// Check if new password matches confirm password
			if($password3 == $confirm_password2){
				// Encrypt the new password using MD5 encryption
				$new_password = md5($password3);
				// Update the password in the database
				$update_query = "UPDATE users SET password = '".$new_password."' WHERE username = '".$username3."'";
				$update = $this->db->query($update_query);
				if($update){
					return 1; // Password reset successful
				} else {
					return 0; // Password reset failed
				}
			} else {
				return 2; // New password and confirm password do not match
			}
		} else {
			return 3; // Username does not exist
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
	
		// Handle profile picture upload
		if(isset($_FILES['profile']['tmp_name']) && $_FILES['profile']['tmp_name'] != ''){
			// Define upload directory and file name
			$upload_dir = './profile_image/';
			$profile_pic = $upload_dir . basename($_FILES['profile']['name']);
	
			// Move uploaded file to the upload directory
			if(move_uploaded_file($_FILES['profile']['tmp_name'], $profile_pic)){
				// Success: Set profile picture path in $data
				$profile_pic_path = $profile_pic;
			} else {
				// Error handling if file upload fails
				return 0; // Return 0 indicating failure
			}
		} else {
			// If no profile picture is uploaded, set it to NULL or handle it as required
			$profile_pic_path = NULL;
		}
	
		// Escape user inputs to prevent SQL injection
		$name = $this->db->real_escape_string($name);
		$username = $this->db->real_escape_string($username);
		$type = $this->db->real_escape_string($type);
	
		// Prepare SQL data
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", type = '$type' ";
		$data .= ", profile_pic = '$profile_pic_path' ";
	
		// Perform insert or update based on whether ID is provided
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users SET ".$data);
		} else {
			$save = $this->db->query("UPDATE users SET ".$data." WHERE id = ".$id);
		}
	
		// Check if query was successful
		if($save){
			return 1; // Success
		} else {
			return 0; // Error
		}
	}
	
		
}