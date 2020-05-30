<?php
// Developed by Rakesh M R
include 'utils/fileHandler.php';
if ($_SESSION['userStatus']==='100') {
	echo "<script>window.location.href='?page=adminHome';</script>";
    exit;
}
else if ($_SESSION['userStatus']!='200') {
	echo "<script>window.location.href='?page=home';</script>";
    exit;
} 
$ticketFH = new FileProcess('database/tickets.txt');
?>
<div class="container">
	<div class="module text-center bg-warning">
		<label>User Name:</label><?php echo($_SESSION['userName']); echo '<br>'; //print_r($_SESSION); ?>
		<label>Total Tickets:</label><?php echo($ticketFH->countUserTickets($_SESSION['userId'])); ?>
	</div>
	<div class="module">
		<h4 style="color: blue;">My Tickets</h4>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Sl. No</th>
					<th>Movie Name</th>
					<th>Date</th>
					<th>Seat Count</th>
					<th>Price</th>
					<th>Theatre</th>
					<th>Show Time</th>
				</tr>
			</thead>
			<?php
				// List all tickets of a user
				$userTicket = $ticketFH->getUserTickets($_SESSION['userId']);
				// print_r($userTicket);
				$tr = '';
				echo '<tbody>';
				foreach ($userTicket as $key => $ticket) {
					$td = '<td>'.++$key.'</td>';
					for ($i=0; $i < count($ticket); $i++) { 
						if ($i == 0 || $i == 1) {
							continue;
						} else {
							$td = $td.'<td>'.$ticket[$i].'</td>';
						}
					}
					$tr = $tr.'<tr>'.$td.'</tr>';
				}
				echo $tr.'</tbody>';
			?>
		</table>
	</div>
	<div class="module">
		<label class="errorMessage" style="font-size: 15pt;">* One user can book maximum 10 tickets only.</label>
	</div>
</div>