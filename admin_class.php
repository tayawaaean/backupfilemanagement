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

    $qry = $this->db->query("SELECT * FROM users WHERE username = '".$username."' ");
    if($qry->num_rows > 0){
        $user = $qry->fetch_assoc();
        // Check if the stored password matches the input password after encoding it
        if($user['password'] == $password){
            if($user['type'] == 0){
                return 4; // User not yet approved
            }
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
		$user_id = $_SESSION['login_id'];
		$log_action = '';
		$log_description = '';
	
		if(empty($id)){
			$data .= ", user_id ='".$user_id."' ";
			
			$check = $this->db->query("SELECT * FROM folders where user_id ='".$user_id."' and name ='".$name."'")->num_rows;
			if($check > 0){
				return json_encode(array('status'=>2,'msg'=> 'Folder name already exists'));
			} else {
				$save = $this->db->query("INSERT INTO folders set ".$data);
				if($save){
					$log_action = 'Folder Created';
					$log_description = "Created folder {$name}";
	
					// Log the activity
					$user_data = $this->db->query("SELECT name, type FROM users WHERE id=".$user_id)->fetch_array();
					$user_name = $user_data['name'];
					$usertype = $user_data['type'];
					$job_title = ($usertype == 1) ? 'Admin' : 'Employee';
					$author = $user_name;
					$timestamp = date('Y-m-d H:i:s');
					$log_query = "INSERT INTO activity_log (Author, Action, DateTime, Job_title, Description) VALUES ('$author', '$log_action', '$timestamp', '$job_title', '$log_description')";
					$this->db->query($log_query);
	
					return json_encode(array('status'=>1));
				}
			}
		} else {
			$check = $this->db->query("SELECT * FROM folders where user_id ='".$user_id."' and name ='".$name."' and id !=".$id)->num_rows;
			if($check > 0){
				return json_encode(array('status'=>2,'msg'=> 'Folder name already exists'));
			} else {
				$save = $this->db->query("UPDATE folders set ".$data." where id =".$id);
				if($save){
					$log_action = 'Folder Updated';
					$log_description = "Updated folder {$name}";
	
					// Log the activity
					$user_data = $this->db->query("SELECT name, type FROM users WHERE id=".$user_id)->fetch_array();
					$user_name = $user_data['name'];
					$usertype = $user_data['type'];
					$job_title = ($usertype == 1) ? 'Admin' : 'Employee';
					$author = $user_name;
					$timestamp = date('Y-m-d H:i:s');
					$log_query = "INSERT INTO activity_log (Author, Action, DateTime, Job_title, Description) VALUES ('$author', '$log_action', '$timestamp', '$job_title', '$log_description')";
					$this->db->query($log_query);
	
					return json_encode(array('status'=>1));
				}
			}
		}
	}
	

	function delete_folder(){
		// Extract POST data
		extract($_POST);
	
		// Fetch the folder name and user_id from the folders table
		$folder_data = $this->db->query("SELECT name, user_id FROM folders WHERE id=".$id)->fetch_array();
		$folder_name = $folder_data['name'];
		$user_id = $folder_data['user_id'];
	
		// Fetch the user name and usertype from the users table
		$user_data = $this->db->query("SELECT name, type FROM users WHERE id=".$user_id)->fetch_array();
		$user_name = $user_data['name'];
		$usertype = $user_data['type'];
	
		// Determine the Job_title based on the usertype
		$job_title = ($usertype == 1) ? 'Admin' : 'Employee';
	
		// Delete the folder record from the database
		$delete = $this->db->query("DELETE FROM folders WHERE id=".$id);
	
		if($delete){
			// Insert an entry into the activity log
			$author = $user_name;  // Use the fetched user name as the author
			$activity = 'Folder Deleted';
			$description = "Deleted folder {$folder_name}";
			$timestamp = date('Y-m-d H:i:s');  // Current timestamp
			$log_query = "INSERT INTO activity_log (Author, Action, DateTime, Job_title, Description) VALUES ('$author', '$activity', '$timestamp', '$job_title', '$description')";
			$this->db->query($log_query);
	
			echo 1;
		}
	}
	
	
	function delete_file(){
		// Extract POST data
		extract($_POST);
	
		// Fetch the file path, user_id, description, filename, and folder_id from the database
		$file_data = $this->db->query("SELECT file_path, user_id, description, name, folder_id FROM files WHERE id=".$id)->fetch_array();
		$path = $file_data['file_path'];
		$user_id = $file_data['user_id'];
		$filename = $file_data['name'];
		$folder_id = $file_data['folder_id'];
	
		// Fetch the user name and usertype from the users table
		$user_data = $this->db->query("SELECT name, type FROM users WHERE id=".$user_id)->fetch_array();
		$user_name = $user_data['name'];
		$usertype = $user_data['type'];
	
		// Fetch the folder name from the folders table
		$folder_name = $this->db->query("SELECT name FROM folders WHERE id=".$folder_id)->fetch_array()['name'];
	
		// Determine the Job_title based on the usertype
		$job_title = ($usertype == 1) ? 'Admin' : 'Employee';
	
		// Delete the file record from the database
		$delete = $this->db->query("DELETE FROM files WHERE id=".$id);
	
		if($delete){
			// Delete the physical file from the server
			unlink('assets/uploads/'.$path);
	
			// Insert an entry into the activity log
			$author = $user_name;  // Use the fetched user name as the author
			$activity = 'Document Deleted';
			$description = "Deleted {$filename} in {$folder_name} folder";
			$timestamp = date('Y-m-d H:i:s');  // Current timestamp
			$log_query = "INSERT INTO activity_log (Author, Action, DateTime, Job_title, Description) VALUES ('$author', '$activity', '$timestamp', '$job_title', '$description')";
			$this->db->query($log_query);
	
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
					if($save){
						// Insert an entry into the activity log
						$user_id = $_SESSION['login_id'];
						$user_data = $this->db->query("SELECT name, type FROM users WHERE id=".$user_id)->fetch_array();
						$user_name = $user_data['name'];
						$usertype = $user_data['type'];
						$job_title = ($usertype == 1) ? 'Admin' : 'Employee';
						$author = $user_name;
						$activity = 'File Uploaded';
						$description = "Uploaded file {$file[0]}.{$file[1]} in folder ID {$folder_id}";
						$timestamp = date('Y-m-d H:i:s');
						$log_query = "INSERT INTO activity_log (Author, Action, DateTime, Job_title, Description) VALUES ('$author', '$activity', '$timestamp', '$job_title', '$description')";
						$this->db->query($log_query);
	
						return json_encode(array('status'=>1));
					}
				}
			}
		} else {
			$data = " description = '".$description."' ";
			if(isset($is_public) && $is_public == 'on')
				$data .= ", is_public = 1 ";
			else
				$data .= ", is_public = 0 ";
			$save = $this->db->query("UPDATE files set ".$data. " where id=".$id);
			if($save){
				// Insert an entry into the activity log
				$user_id = $_SESSION['login_id'];
				$user_data = $this->db->query("SELECT name, type FROM users WHERE id=".$user_id)->fetch_array();
				$user_name = $user_data['name'];
				$usertype = $user_data['type'];
				$job_title = ($usertype == 1) ? 'Admin' : 'Employee';
				$author = $user_name;
				$activity = 'Shared a File';
				$description = "Shared file ID {$id} with new description: {$description}";
				$timestamp = date('Y-m-d H:i:s');
				$log_query = "INSERT INTO activity_log (Author, Action, DateTime, Job_title, Description) VALUES ('$author', '$activity', '$timestamp', '$job_title', '$description')";
				$this->db->query($log_query);
		
				return json_encode(array('status'=>1));
			}
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
			// Insert an entry into the activity log
			$user_id = $_SESSION['login_id'];
			$user_data = $this->db->query("SELECT name, type FROM users WHERE id=".$user_id)->fetch_array();
			$user_name = $user_data['name'];
			$usertype = $user_data['type'];
			$job_title = ($usertype == 1) ? 'Admin' : 'Employee';
			$author = $user_name;
			$activity = 'File Renamed';
			$description = "Renamed file to {$file[0]}.{$file[1]} in folder ID {$folder_id}";
			$timestamp = date('Y-m-d H:i:s');
			$log_query = "INSERT INTO activity_log (Author, Action, DateTime, Job_title, Description) VALUES ('$author', '$activity', '$timestamp', '$job_title', '$description')";
			$this->db->query($log_query);
	
			return json_encode(array('status'=>1, 'new_name'=>$file[0].'.'.$file[1]));
		}
	}
	
	function save_user(){
		// Sanitize inputs
		$name = $this->db->real_escape_string($_POST['name']);
		$username = $this->db->real_escape_string($_POST['username']);
		$type = $this->db->real_escape_string($_POST['type']);
		$id = isset($_POST['id']) ? $this->db->real_escape_string($_POST['id']) : '';
	
		// Build data string
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", type = '$type' ";
	
		// Check if user exists
		$user_data = $this->db->query("SELECT type FROM users WHERE username = '$username'")->fetch_assoc();
		if(!$user_data){
			return 0; // User not found
		}
		$usertype = $user_data['type'];
	
		// Get current user data
		$user_id = $_SESSION['login_id'];
		$myuser_data = $this->db->query("SELECT name, type FROM users WHERE id = $user_id")->fetch_assoc();
		$Author = $myuser_data['name'];
		$job_title = ($myuser_data['type'] == 1) ? 'Admin' : 'Employee';
		$timestamp = date('Y-m-d H:i:s');
	
		if(empty($id)){
			// Insert new user
			$save = $this->db->query("INSERT INTO users SET ".$data);
		} else {
			// Update existing user
			$save = $this->db->query("UPDATE users SET ".$data." WHERE id = ".$id);
		}
		if($save){
			if ($usertype == 0) {
				$Action = "New User Approved";
				$mytype = ($myuser_data['type'] == 1) ? 'Admin' : 'Employee';
				$Description = $name . ' as ' . $mytype;
				$log_query = "INSERT INTO activity_log (Author, Job_title, DateTime, Action, Description) VALUES ('$Author', '$job_title', '$timestamp', '$Action', '$Description')";
				$this->db->query($log_query);
			} else {
				$Action = "Updated User";
				$Description = $name;
				$log_query = "INSERT INTO activity_log (Author, Job_title, DateTime, Action, Description) VALUES ('$Author', '$job_title', '$timestamp', '$Action', '$Description')";
				$this->db->query($log_query);
			}
			return 1; // Success
		}
		return 0; // Failed
	}
	

		
}