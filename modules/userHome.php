<?php
// Developed by Rakesh M R

if ($_SESSION['userStatus']==='100') {
	echo "<script>window.location.href='?page=adminHome';</script>";
    exit;
}
else if ($_SESSION['userStatus']!='200') {
	echo "<script>window.location.href='?page=home';</script>";
    exit;
} 

?>
<div class="container">
	<div class="module">
		<label>User Name:</label><?php echo($_SESSION['userName']); echo '<br>'; print_r($_SESSION); ?>
	</div>
	<div class="module">
		<h4 style="color: blue;">My Tickets</h4>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Sl. No</th>
					<th>Movie Name</th>
					<th>Date</th>
					<th>Show Time</th>
					<th>Seat Count</th>
				</tr>
			</thead>
			<?php
				// List all tickets of a user

			?>
		</table>
	</div>
</div>