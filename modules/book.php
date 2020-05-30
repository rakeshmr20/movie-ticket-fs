<?php
// Developed by Rakesh M R
if (!isset($_SESSION['userStatus'])) {
	echo "<script>window.location.href='?page=login';</script>";
    exit;
}

include 'utils/fileHandler.php';
$movieFH = new FileProcess('database/movies.txt');
$theatreFH = new FileProcess('database/theatres.txt');
$timeFH = new FileProcess('database/timings.txt');
$ticketFH = new FileProcess('database/tickets.txt');
$movieId = null;
$userId = null;
// print_r($_SESSION);
if ($_SESSION['userStatus']=='100') {
	echo "<script>alert('Admin can\'t book tickets. Sorry..!');</script>";
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=adminHome';</script>";
    exit;;
}
if (isset($_GET['movieId']) && isset($_GET['userId'])) {
	$movieId = $_GET['movieId'];
	$userId = $_GET['userId'];
	$movieData = $movieFH->getSingleData($movieId);
	// print_r($userId);
	// print_r($movieData);
}
if ($ticketFH->countUserTickets($userId) >=10) {
	echo "<script>alert('Max. Ticket booked from this user. Sorry..!');</script>";
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=userHome';</script>";
    exit;
}
function postVal($vname)
{
	return strval($_POST[$vname]);
}
if (isset($_POST['bookTicket'])) {
	echo "booking ...";
	$updateData = ''.uniqid().'~'.postVal('userId').'~'.postVal('movieId').'~'.postVal('tdate').'~'.postVal('tcount').'~'.postVal('price').'~'.postVal('theatre').'~'.postVal('stime').'~';
	$updateData = $updateData.strval(sha1($updateData)).'|';
	// print_r($updateData);
	$resultUpdate = $ticketFH->appendFile($updateData);
	if ($resultUpdate) {
		$_SESSION['errMsg'] = 'Updated Successfully.';
	} else {
		$_SESSION['errMsg'] = 'Problem Occured. Please try again..!';
	}
	echo "<script>alert('Ticket Booked Successfully.');</script>";
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=userHome';</script>";
    exit;
}
?>
<div class="container module">
	<div class="row">
		<div class="col-md-4 posterImage">
			<div class="input-container cover">
			    <img src='<?php echo "upload/".$movieData[5]; ?>'>
			</div>
		</div>
		<div class="col-md-6">
			<form action="" name="addMovie-form" method="post" enctype="multipart/form-data" style="max-width:500px;margin:auto">
			    <h2 class="page-title">Book Tickets</h2>
			    <input type="hidden" name="userId" value="<?php echo($userId); ?>">
			    <input type="hidden" name="movieId" value="<?php echo($movieId); ?>">
			    <div class="input-container">
			      <label>Movie Name: </label><label class="text-primary"><?php echo($movieData[1]); ?></label>
			    </div>
			    <div class="input-container">
			      <label>Director: </label><label class="text-primary"><?php echo($movieData[3]); ?></label>
			    </div>
			    <div class="input-container">
			      <label>IMDB: </label><label class="text-primary"><?php echo($movieData[6]); ?></label>
			    </div>
			    <div class="input-container">
			      <label>Description: </label><label class="text-primary"><?php echo($movieData[4]); ?></label>
			    </div>
			    <div class="input-container">
			      <label>Date: </label><input type="date" name="tdate" min='<?php echo(date("Y-m-d")); ?>' value='<?php echo(date("Y-m-d")); ?>'>
			    </div>
			    <div class="input-container">
			    	<input type="hidden" id="basicPrice" value="<?php echo($movieData[7]); ?>">
			    	<label>Seats: </label><input type="number" id="tcount" name="tcount" min="1" max='<?php echo(10-$ticketFH->countUserTickets($userId)); ?>' onchange="changePrice()" oninput="changePrice()" value="1"> &nbsp;
			      	<label>Price: </label><input type="text" id="price" name="price" value="<?php echo($movieData[7]); ?>" readonly>
			    </div>
			    <div class="input-container">
			      <label>Theatre: </label>
			      <select name="theatre">
			      	<?php 
			      		$allTheatres = $theatreFH->getAllData();
			      		foreach ($allTheatres as $trkey => $singleTheatre) {
			      			echo "<option value='".$singleTheatre[1]."'>".$singleTheatre[1]."</option>";
			      		}
			      	 ?>
			      </select>
			    </div>
			    <div class="input-container">
			      <label>Show Time: </label>
			      <select name="stime">
			      	<?php 
			      		$timeData = $timeFH->getAllData();
			      		foreach ($timeData as $tkey => $aTime) {
			      			echo "<option value='".$aTime[1]."'>".$aTime[1]."</option>";
			      		}
			      	?>
			      </select>
			    </div>
			    <div class="input-container">
			    	<input type="submit" class="btn login" value="Book Tickets" name="bookTicket">
			    </div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function changePrice() {
		var price = document.getElementById("basicPrice").value;
		var seats = document.getElementById("tcount").value;
		document.getElementById("price").value = parseInt(price)*parseInt(seats);
	}
</script>