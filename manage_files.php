<?php 
include('db_connect.php');
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM files where id=".$_GET['id']);
	if($qry->num_rows > 0){
		foreach($qry->fetch_array() as $k => $v){
			$meta[$k] = $v;
		}
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-files">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
		<input type="hidden" name="folder_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] :'' ?>">
		<!-- <div class="form-group">
			<label for="name" class="control-label">File Name</label>
			<input type="text" name="name" id="name" value="<?php echo isset($meta['name']) ? $meta['name'] :'' ?>" class="form-control">
		</div> -->
		<?php if(!isset($_GET['id']) || empty($_GET['id'])): ?>
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text">Upload</span>
		  </div>
		  <div class="custom-file">
		    <input type="file" class="custom-file-input" name="upload" id="upload" onchange="displayname(this,$(this))">
		    <label class="custom-file-label" for="upload">Choose file</label>
		  </div>
		</div>
	<?php endif; ?>
		<div class="form-group">
			<label for="" class="control-label">Description</label>
			<textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo isset($meta['description']) ? $meta['description'] :'' ?></textarea>
		</div>
		<div class="form-group">
			<label for="is_public" class="control-label"><input type="checkbox" name="is_public" id="is_public"><i> Share to All Users</i></label>
		</div>
		<div class="form-group" id="msg"></div>

	</form>
</div>
<script src= "./js/files.js"></script>
<script src= "./js/act_log_files.js"></script>