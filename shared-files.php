<link rel="stylesheet" href= "./css/home.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<style>
	.custom-menu {
        z-index: 1000;
	    position: absolute;
	    background-color: #ffffff;
	    border: 1px solid #0000001c;
	    border-radius: 5px;
	    padding: 8px;
	    min-width: 13vw;
}
a.custom-menu-list {
    width: 100%;
    display: flex;
    color: #4c4b4b;
    font-weight: 600;
    font-size: 1em;
    padding: 1px 11px;
}
	span.card-icon {
    position: absolute;
    font-size: 3em;
    bottom: .2em;
    color: #ffffff80;
}
.file-item{
	cursor: pointer;
}
a.custom-menu-list:hover,.file-item:hover,.file-item.active {
    background: #80808024;
}
table th,td{
	/*border-left:1px solid gray;*/
}
a.custom-menu-list span.icon{
		width:1em;
		margin-right: 5px
}
</style>
<div class="dash-content">
    <div class="overview">
        <div class="title">
            <h2>Shared Files</h2>
        </div>
        <hr>
    </div>
    <div class="container">
	<?php include('db_connect.php') ;
	$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  f.is_public = 1 order by date(f.date_updated) desc");

	?>
        <div class="activity">
            <div class="title">
                <div class="act">
                    <span class="material-symbols-outlined">history</span>
                    <span class="text">Shared Files</span>
                </div>
            	<div class="buttons">
                    <button id="dropdown1" class="dropdown-button">
                        <i class='bx bx-user' ></i>
                    </button>                            
                    <ul class="menu">
                        <li>Aean Gabrielle Tayawa</li>
                        <li>Dexter John Perdido</li>
                        <li>Kenric Catiwa</li>
                    </ul>
                    <button id="dropdown2" class="dropdown-button">
                        <i class='bx bxs-calendar' ></i>
                    </button>                            
                    <ul class="menu">
						<li>January</li>
						<li>February</li>
						<li>March</li>
						<li>April</li>
						<li>May</li>
						<li>June</li>
						<li>July</li>
						<li>August</li>
						<li>September</li>
						<li>October</li>
						<li>November</li>
						<li>December</li>
                    </ul>
                </div>
				<div class="bottom-search">
					<div class="search">
						<i class="uil uil-search"></i>
						<input type="text" placeholder="Search...">
					</div>
				</div>
            </div>
			<div class="table-container">
				<div class="dashboard-table-wrapper">
					<table class="table">
						<thead>
							<tr>
							<th>Uploader</th>
							<th>Filename</th>
							<th>Date</th>
							<th>Description</th>
							</tr>
						</thead>
						<tbody>
						<?php 
					while($row=$files->fetch_assoc()):
						$name = explode(' ||',$row['name']);
						$name = isset($name[1]) ? $name[0] ." (".$name[1].").".$row['file_type'] : $name[0] .".".$row['file_type'];
						$img_arr = array('png','jpg','jpeg','gif','psd','tif');
						$doc_arr =array('doc','docx');
						$pdf_arr =array('pdf','ps','eps','prn');
						$icon ='fa-file';
						if(in_array(strtolower($row['file_type']),$img_arr))
							$icon ='fa-image';
						if(in_array(strtolower($row['file_type']),$doc_arr))
							$icon ='fa-file-word';
						if(in_array(strtolower($row['file_type']),$pdf_arr))
							$icon ='fa-file-pdf';
						if(in_array(strtolower($row['file_type']),['xlsx','xls','xlsm','xlsb','xltm','xlt','xla','xlr']))
							$icon ='fa-file-excel';
						if(in_array(strtolower($row['file_type']),['zip','rar','tar']))
							$icon ='fa-file-archive';

					?>
						<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
							<td><i><?php echo ucwords($row['uname']) ?></i></td>
							<td><large><span><i class="fa <?php echo $icon ?>"></i></span><b> <?php echo $name ?></b></large>
							<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">

							</td>
							<td><i><?php echo date('Y/m/d h:i A',strtotime($row['date_updated'])) ?></i></td>
							<td><i><?php echo $row['description'] ?></i></td>
						</tr>
							
					<?php endwhile; ?>
					</table>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="menu-file-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Download</a>
</div>
<script>
	//FILE
	$('.file-item').bind("contextmenu", function(event) { 
    event.preventDefault();

    $('.file-item').removeClass('active')
    $(this).addClass('active')
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu file'></div>")
        custom.append($('#menu-file-clone').html())
        custom.find('.download').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});

	
	$("div.file.custom-menu .download").click(function(e){
		e.preventDefault()
		window.open('download.php?id='+$(this).attr('data-id'))
	})

	

})
	$(document).bind("click", function(event) {
    $("div.custom-menu").hide();
    $('#file-item').removeClass('active')

});
	$(document).keyup(function(e){

    if(e.keyCode === 27){
        $("div.custom-menu").hide();
    $('#file-item').removeClass('active')

    }
})
</script>
<script src= "./js/home.js"></script>