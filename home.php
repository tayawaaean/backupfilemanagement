<link rel="stylesheet" href= "./css/home.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<style>
    #TotalUsers, #PendingRegister, #TotalFiles, #UserTotalFiles, #SharedFiles, #Folders{
        cursor: pointer; /* Change cursor to pointer on hover */
    }
</style>

<div class="dash-content">
    <div class="overview">
        <div class="title">
            <h2>Dashboard</h2>
        </div>
        <hr>
        <?php if($_SESSION['login_type'] == 1): ?>
    <div class="boxes">
        <div class="box box1" id="TotalUsers">
            <i class='bx bxs-user'></i>
            <span class="text">
                <span class="number"><?php echo $totalUsers; ?></span>
                <span class="text">Total Users</span>
            </span>
        </div>
        <div class="box box2" id="TotalFiles">
            <i2 class="material-symbols-outlined">folder_open</i2>
            <span class="text">
                <span class="number"><?php echo $totalFiles;?></span>
                <span class="text">Total Files</span>
            </span>
        </div>
        <div class="box box3" id="PendingRegister">
            <i class="material-symbols-outlined">app_registration</i>
            <span class="text">
                <span class="number"><?php echo $totalPendingRegister; ?></span>
                <span class="text">Pending Register</span>
            </span>
        </div>
    </div>
<?php endif; ?>
<?php if($_SESSION['login_type'] == 2): ?>
<div class="boxes">
	<div class="box box1" id="UserTotalFiles">
    <i class='bx bxs-file'></i> <!-- Changed icon to 'bxs-file' -->
    <span class="text">
        <span class="number"><?php echo $totalFiles; ?></span>
        <span class="text">Total Files</span>
    </span>
</div>
	<div class="box box2" id="SharedFiles">
		<i2 class="material-symbols-outlined">share</i2> <!-- Changed icon to 'share' -->
        <span class="text">
            <span class="number"><?php echo $totalSharedFiles; ?></span>
            <span class="text">Shared Files</span>
        </span>
        </div>
		<div class="box box3" id="Folders">
		<i class="material-symbols-outlined">folder_open</i>
            <span class="text">
                <span class="number"><?php echo $totalFolders; ?></span>
                <span class="text">Folders</span>
            </span>
        </div>
    </div>
<?php endif; ?>

<div class="container">
    <div class="activity">
        <div class="title">
            <div class="act">
                <span class="material-symbols-outlined">history</span>
                <span class="text">Activity Log</span>
            </div>
            <div class="buttons">
                <button id="dropdown1" class="dropdown-button">
                    <i class='bx bx-user'></i>
                </button>
                <ul class="menu" id="Author">
                    <li data-author="None">None</li>
                    <?php if($_SESSION['login_type'] == 1): ?>   
                    <?php 
                        $result = $conn->query("SELECT DISTINCT Author FROM activity_log");
                        while ($row = $result->fetch_assoc()): 
                    ?>
                    <li data-author="<?php echo $row['Author']?>"><?php echo $row['Author']?></li>
                    <?php endwhile?>
                    <?php endif; ?>
                </ul>
                <button id="dropdown2" class="dropdown-button">
                    <i class='bx bxs-calendar'></i>
                </button>
                <ul class="menu">
                    <li data-month="None">None</li>
                    <li data-month="January">January</li>
                    <li data-month="February">February</li>
                    <li data-month="March">March</li>
                    <li data-month="April">April</li>
                    <li data-month="May">May</li>
                    <li data-month="June">June</li>
                    <li data-month="July">July</li>
                    <li data-month="August">August</li>
                    <li data-month="September">September</li>
                    <li data-month="October">October</li>
                    <li data-month="November">November</li>
                    <li data-month="December">December</li>
                </ul>
            </div>
            <div class="bottom-search">
                <div class="search">
                    <i class="uil uil-search"></i>
                    <input id="custom-search" type="text" placeholder="Search...">
                </div>
            </div>
        </div>
        <div class="button-container">
    	<button id="edit-toggle" class="edit-button">Edit</button>
    		<div class="edit-controls">
		<button id="select-all-btn" class="select-button">Select All</button>
        <button id="delete-selected" class="delete-button">Delete Selected</button>
        <button id="delete-all" class="delete-button">Delete All</button>
    </div>
</div>

        <div class="table-container">
            <div class="dashboard-table-wrapper">
                <?php if($_SESSION['login_type'] == 1): ?>
                    <table class="table" id="ActivityLog">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all" style="display: none;"></th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $nameQuery = $conn->query("SELECT name FROM users");
                            if ($nameQuery && $nameQuery->num_rows > 0) {
                                $name = $nameQuery->fetch_assoc()['name'];
                                $result = $conn->query("SELECT * FROM activity_log");
                                while ($row = $result->fetch_assoc()): 
                                    $dateTime = $row['DateTime'];
                                    $date = date("F j, Y", strtotime($dateTime));
                                    $time = date("h:i A", strtotime($dateTime));
                            ?>
                            <tr>
                                <td><input type="checkbox" class="select-row" data-id="<?php echo $row['id']; ?>" style="display: none;"></td>
                                <td><?php echo $row['Author']?></td>
                                <td><?php echo date('F j, Y', strtotime($row['DateTime'])); ?></td>
                                <td><?php echo $time?></td>
                                <td><?php echo $row['Action']?></td>
                                <td>
                                    <div class="description">
                                        <?php if($row['Action'] === "New User Approved") { ?>
                                            <?php echo $row['Author'],' ', 'approved the registration of' ,' ',$row['Description'],' ','.'?>
                                        <?php } else if ($row['Action'] === "File Uploaded") {?>
                                            <?php echo $row['Author'],' ',$row['Description'],' folder.'?>
                                        <?php } else if ($row['Action'] === "Folder Deleted") {?>
                                            <?php echo $row['Author'],' ',' ',$row['Description']?>
                                        <?php } else if ($row['Action'] === "Shared a File") {?>
                                            <?php echo $row['Author'],' ',' ',$row['Description']?>
                                        <?php } else if ($row['Action'] === "Folder Created") {?>
                                            <?php echo $row['Author'],' ',' ',$row['Description']?>
                                        <?php } else if ($row['Action'] === "Folder Updated") {?>
                                            <?php echo $row['Author'],' ',' ',$row['Description']?>
                                        <?php } else if ($row['Action'] === "File Renamed") {?>
                                            <?php echo $row['Author'],' ',' ',$row['Description']?>
                                        <?php } else if ($row['Action'] === "Document Deleted") {?>
                                            <?php echo $row['Author'],' ','deleted the document',' ',$row['Description'],'.'?>
                                        <?php } else if ($row['Action'] === "Updated User") {?>
                                            <?php echo $row['Author'],' ','Update user',' ',$row['Description'],'.'?>
                                        <?php }?>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php endif; ?>
				<?php if($_SESSION['login_type'] == 2): ?>
					<table class="table" id="ActivityLog">
						<thead>
							<tr>
								<th><input type="checkbox" id="select-all" style="display: none;"></th>
								<th>Author</th>
								<th>Date</th>
								<th>Time</th>
								<th>Action</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							
							// Retrieve the name from the users table based on the username
							$nameQuery = $conn->query("SELECT name FROM users WHERE id ='$loginId'"); //Uncomment if you want to show only the users log
							// $nameQuery = $conn->query("SELECT name FROM users"); //Comment this if you switch to show users log only
							if ($nameQuery && $nameQuery->num_rows > 0) {
								$name = $nameQuery->fetch_assoc()['name'];

								// Fetch activity log entries based on the author's name
								$result = $conn->query("SELECT * FROM activity_log WHERE Author = '$name'"); //Uncomment if you want to show only the users log
								// $result = $conn->query("SELECT * FROM activity_log"); //Comment this if you switch to show users log only
								while ($row = $result->fetch_assoc()): 
									$dateTime = $row['DateTime'];
									$date = date("F j, Y", strtotime($dateTime));
									$time = date("h:i A", strtotime($dateTime));
							?>
								<tr>
									<td><input type="checkbox" class="select-row" data-id="<?php echo $row['id']; ?>" style="display: none;"></td>
									<td><?php echo $row['Author']?></td>
									<td><?php echo date('F j, Y', strtotime($row['DateTime'])); ?></td>
									<td><?php echo $time?></td>
									<td><?php echo $row['Action']?></td>
									<td>
									<div class="description">
									<?php if($row['Action'] === "New User Approved") { ?>
											<?php echo $row['Author'],' ', 'accepted' ,' ',$row['Description'],' ','to be a new user.'?>
											<?php } else if ($row['Action'] === "File Uploaded") {?>
											<?php echo $row['Author'],' ',$row['Description'],' folder.'?>
											<?php } else if ($row['Action'] === "Folder Deleted") {?>
											<?php echo $row['Author'],' ',' ',$row['Description']?>
											<?php } else if ($row['Action'] === "Shared a File") {?>
											<?php echo $row['Author'],' ',' ',$row['Description']?>
											<?php } else if ($row['Action'] === "Folder Created") {?>
											<?php echo $row['Author'],' ',' ',$row['Description']?>
											<?php } else if ($row['Action'] === "Folder Updated") {?>
											<?php echo $row['Author'],' ',' ',$row['Description']?>
											<?php } else if ($row['Action'] === "File Renamed") {?>
											<?php echo $row['Author'],' ',' ',$row['Description']?>
											<?php } else if ($row['Action'] === "Document Deleted") {?>
											<?php echo $row['Author'],' ','deleted the document',' ',$row['Description'],'.'?>
											<?php }?>
										</div>
									</td>
								</tr>
								<?php endwhile; ?>
								<?php } // <-- Missing closing bracket for if block ?>
							</tbody>
                    </table>
				<?php endif; ?>
				</div>
            </div>
        </div>
    </div>
</div>



<script>document.addEventListener('DOMContentLoaded', function () {
    const editToggle = document.getElementById('edit-toggle');
    const selectAllCheckbox = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.select-row');
    const deleteSelectedButton = document.getElementById('delete-selected');
    const deleteAllButton = document.getElementById('delete-all');
    const editControls = document.querySelector('.edit-controls');
    const selectAllBtn = document.getElementById('select-all-btn');

    editToggle.addEventListener('click', function () {
        const isEditing = editToggle.textContent === 'Done';

        editToggle.textContent = isEditing ? 'Edit' : 'Done';
        editControls.style.display = isEditing ? 'none' : 'block';
        selectAllCheckbox.style.display = isEditing ? 'none' : 'inline-block';
        checkboxes.forEach(checkbox => {
            checkbox.style.display = isEditing ? 'none' : 'inline-block';
        });
    });

    selectAllBtn.addEventListener('click', function () {
        const allSelected = Array.from(checkboxes).every(checkbox => checkbox.checked);
        checkboxes.forEach(checkbox => {
            checkbox.checked = !allSelected;
        });
        selectAllCheckbox.checked = !allSelected;
    });

    selectAllCheckbox.addEventListener('change', function () {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    deleteSelectedButton.addEventListener('click', function () {
        const selectedIds = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.dataset.id);
        
        if (selectedIds.length > 0) {
            if (confirm('Are you sure you want to delete selected logs?')) {
                fetch('delete_logs.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ ids: selectedIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        selectedIds.forEach(id => {
                            document.querySelector(`.select-row[data-id="${id}"]`).closest('tr').remove();
                        });
                    } else {
                        alert('Failed to delete selected logs.');
                    }
                });
            }
        } else {
            alert('No logs selected.');
        }
    });

    deleteAllButton.addEventListener('click', function () {
        if (confirm('Are you sure you want to delete all logs?')) {
            fetch('delete_logs.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ deleteAll: true })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('.table tbody tr').forEach(row => row.remove());
                } else {
                    alert('Failed to delete all logs.');
                }
            });
        }
    });
});


</script>

<script>
// Selecting the dropdown buttons and menus
const dropdown1 = document.getElementById('dropdown1');
const dropdown2 = document.getElementById('dropdown2');
const menu1 = dropdown1.nextElementSibling;
const menu2 = dropdown2.nextElementSibling;
const options1 = menu1.querySelectorAll('li');
const options2 = menu2.querySelectorAll('li');

// Function to close dropdown menus
function closeDropdowns() {
    menu1.classList.remove('menu-open');
    menu2.classList.remove('menu-open');
}

// Adding click event listener to the document body
document.body.addEventListener('click', (event) => {
    const isClickInsideDropdown1 = dropdown1.contains(event.target) || menu1.contains(event.target);
    const isClickInsideDropdown2 = dropdown2.contains(event.target) || menu2.contains(event.target);
    
    if (!isClickInsideDropdown1 && !isClickInsideDropdown2) {
        closeDropdowns();
    }
});

// Adding click event listener to the first dropdown button
dropdown1.addEventListener('click', () => {
    menu1.classList.toggle('menu-open'); // Toggle visibility directly on menu1
    menu2.classList.remove('menu-open'); // Close menu2
});

// Adding click event listeners to each option of the first dropdown
options1.forEach(option => {
    option.addEventListener('click', () => {
        closeDropdowns();
        options1.forEach(opt => {
            opt.classList.remove('active-mm');
        });
        option.classList.add('active-mm');
    });
});

// Adding click event listener to the second dropdown button
dropdown2.addEventListener('click', () => {
    menu2.classList.toggle('menu-open'); // Toggle visibility directly on menu2
    menu1.classList.remove('menu-open'); // Close menu1
});

// Adding click event listeners to each option of the second dropdown
options2.forEach(option => {
    option.addEventListener('click', () => {
        closeDropdowns();
        options2.forEach(opt => {
            opt.classList.remove('active-mm');
        });
        option.classList.add('active-mm');
    });
});
</script>

<script>
	$(document).ready(function() {
    var table = $('#ActivityLog').DataTable({
        responsive: true,
        dom: '<li<"entries-info">>frt<"bottom-search"f>t<"bottom"ip>',  
        "language": {
            "info": "Showing _START_ to _END_ of _TOTAL_ entries"
        },
        "order": [[1, 'desc'], [2, 'desc']], // Sort by Date column (index 1) and Time column (index 2) in descending order
        "columnDefs": [{
            "targets": 4,
            "orderable": false
        }, {
            "targets": 1,
            "type": "date-eu", // Use "date-eu" type for the date column
            "render": function(data, type, row) {
                // Parse the date string to a Date object for proper sorting
                return type === 'sort' ? new Date(data) : data;
            }
        }, {
            "targets": 2,
            "type": "time", // Use "time" type for the time column
            "render": function(data, type, row) {
                // Parse the time string to a time object for proper sorting
                return type === 'sort' ? moment(data, 'h:mm A').toDate() : data;
            }
        }],
    });
var currentAuthor = '';
var currentMonth = '';
$('#Author li').click(function() {
    var selectedAuthor = $(this).data('author');

    if (selectedAuthor === 'None') {
        currentAuthor = '';
    } else {
        currentAuthor = selectedAuthor;
    }

    filterData();
});

$('.menu li').click(function() {
    var selectedMonth = $(this).data('month');

    if (selectedMonth === 'None') {
        currentMonth = '';
    } else {
        currentMonth = selectedMonth;
    }

    filterData();
});

$('#ActivityLog th:eq(1)').click(function() {
    var order = table.order()[0]; // Get the current order
    var newOrder = order[1] === 'asc' ? 'asc' : 'desc'; // Toggle between asc and desc

    table.order([1, newOrder]).draw(); // Apply the new order to the date column
});

function filterData() {
    if (currentAuthor === '' && currentMonth === '') {
        table.search('').columns().search('').draw();
    } else {
        table.columns(0).search(currentAuthor).columns(1).search(currentMonth).draw();
    }
}
	$('#custom-search').on('keyup', function() {
		table.search(this.value).draw();
	});
});

</script>

<?php if($_SESSION['login_type'] == 2): ?>

<script>
	document.getElementById('UserTotalFiles').addEventListener('click', function() {
        window.location.href = '/backupfilemanagement/index.php?page=files';
    });

	document.getElementById('SharedFiles').addEventListener('click', function() {
        window.location.href = '/backupfilemanagement/index.php?page=shared-files';
    });

	document.getElementById('Folders').addEventListener('click', function() {
        window.location.href = '/backupfilemanagement/index.php?page=files';
    });
</script>


<?php endif; ?>

<?php if($_SESSION['login_type'] == 1): ?>

<script>
	document.getElementById('TotalUsers').addEventListener('click', function() {
        window.location.href = '/backupfilemanagement/index.php?page=users';
    });

	document.getElementById('PendingRegister').addEventListener('click', function() {
        window.location.href = '/backupfilemanagement/index.php?page=users';
    });

	document.getElementById('TotalFiles').addEventListener('click', function() {
        window.location.href = '/backupfilemanagement/index.php?page=files';
    });
</script>


<?php endif; ?>