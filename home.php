<link rel="stylesheet" href= "./css/home.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

<div class="dash-content">
    <div class="overview">
        <div class="title">
            <h2>Dashboard</h2>
        </div>
        <hr>
        <?php if($_SESSION['login_type'] == 1): ?>
    <div class="boxes">
        <div class="box box1">
            <i class='bx bxs-user'></i>
            <span class="text">
                <span class="number"><?php echo $totalUsers; ?></span>
                <span class="text">Total Users</span>
            </span>
        </div>
        <div class="box box2">
            <i2 class="material-symbols-outlined">folder_open</i2>
            <span class="text">
                <span class="number"><?php echo $totalFiles;?></span>
                <span class="text">Total Files</span>
            </span>
        </div>
        <div class="box box3">
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
        <div class="box box1">
            <i class='bx bxs-user'></i>
            <span class="text">
                <span class="number">12</span>
                <span class="text">Total Files</span>
            </span>
        </div>
        
        <div class="box box3">
            <i class="material-symbols-outlined">app_registration</i>
            <span class="text">
                <span class="number">4</span>
                <span class="text">Folders</span>
            </span>
        </div>
		<div class="box box2">
            <i2 class="material-symbols-outlined">folder_open</i2>
            <span class="text">
                <span class="number">1,028</span>
                <span class="text">Shared Files</span>
            </span>
        </div>
    </div>
<?php endif; ?>

    </div>
    <div class="container">
        <div class="activity">
            <div class="title">
                <div class="act">
                    <span class="material-symbols-outlined">history</span>
                    <span class="text">Activity Log</span>
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
						<i class='bx bxs-calendar'></i>
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
						<input id="searchInput" type="text" placeholder="Search...">
					</div>
				</div>
            </div>
			<div class="table-container">
				<div class="dashboard-table-wrapper">
					<table class="table">
						<thead>
							<tr>
								<th>Author</th>
								<th>Date</th>
								<th>Time</th>
								<th>Action</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Aean Gabrielle Tayawa</td>
								<td>May 30,2022</td>
								<td>4:38 pm</td>
								<td>New User Approved</td>
								<td>
									<div class="description">
										Admin Aean Gabrielle Tayawa accepted Dexter John Perdido to be a new user.
									</div>
									<div class="full-description">
										Admin Aean Gabrielle Tayawa accepted Dexter John Perdido to be a new user.
									</div>
								</td>
							</tr>
							<tr>
								<td>Dexter John Perdido</td>
								<td>June 08,2022</td>
								<td>5:12 pm</td>
								<td>Document Deleted</td>
								<td>
									<div class="description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
									<div class="full-description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
								</td>
							</tr>
							<tr>
								<td>Kenric Catiwa</td>
								<td>June 08,2022</td>
								<td>5:12 pm</td>
								<td>Document Upload</td>
								<td>
									<div class="description">
										User Kenric Catiwa uploaded the document Ma'am Abbie Assignment.pdf
									</div>
									<div class="full-description">
										User Kenric Catiwa uploaded the document MMSU Waiver.pdf
									</div>
								</td>
							</tr>
							<tr>
								<td>Dexter John Perdido</td>
								<td>June 08,2022</td>
								<td>5:12 pm</td>
								<td>Document Deleted</td>
								<td>
									<div class="description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
									<div class="full-description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
								</td>
							</tr>
							<tr>
								<td>Dexter John Perdido</td>
								<td>June 08,2022</td>
								<td>5:12 pm</td>
								<td>Document Deleted</td>
								<td>
									<div class="description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
									<div class="full-description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
								</td>
							</tr>
							<tr>
								<td>Dexter John Perdido</td>
								<td>June 08,2022</td>
								<td>5:12 pm</td>
								<td>Document Deleted</td>
								<td>
									<div class="description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
									<div class="full-description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
								</td>
							</tr>
							<tr>
								<td>Dexter John Perdido</td>
								<td>June 08,2022</td>
								<td>5:12 pm</td>
								<td>Document Deleted</td>
								<td>
									<div class="description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
									<div class="full-description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
								</td>
							</tr>
							<tr>
								<td>Dexter John Perdido</td>
								<td>June 08,2022</td>
								<td>5:12 pm</td>
								<td>Document Deleted</td>
								<td>
									<div class="description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
									<div class="full-description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
								</td>
							</tr>
							<tr>
								<td>Dexter John Perdido</td>
								<td>June 08,2022</td>
								<td>5:12 pm</td>
								<td>Document Deleted</td>
								<td>
									<div class="description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
									<div class="full-description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
								</td>
							</tr>
							<tr>
								<td>Dexter John Perdido</td>
								<td>June 08,2022</td>
								<td>5:12 pm</td>
								<td>Document Deleted</td>
								<td>
									<div class="description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
									<div class="full-description">
										User Dexter John Perdido deleted the document MMSU Waiver.docx
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
document.getElementById('dropdown2').addEventListener('change', function() {
    var selectedMonth = this.value;
    filterTableByDate(selectedMonth);
});

function filterTableByDate(selectedMonth) {
    var tableRows = document.querySelectorAll('.table tbody tr');
    tableRows.forEach(function(row) {
        var dateCell = row.querySelector('td:nth-child(2)').textContent;
        var month = dateCell.split(' ')[0]; // Extract the month from the date cell
        if (month !== selectedMonth) {
            row.style.display = 'none'; // Hide rows that do not match the selected month
        } else {
            row.style.display = ''; // Show rows that match the selected month
        }
    });
}

</script>

