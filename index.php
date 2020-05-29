<!DOCTYPE html>
<?php
if (!isset($_SESSION['userId'])) {
  session_start();
}
$title = "Book Your Ticket";
$_SESSION['page'] =  "home";
if (isset($_GET['page'])) {
	$_SESSION['page'] = $_GET['page'];
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="description" content="Online Movie Tickets Management System">
  	<meta name="author" content="Preethi">
	<title><?php echo($title); ?></title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" type="text/css" href="include/main.css">
  	<script type="text/javascript" src="include/main.js"></script>
</head>
<body>
<div class="container">
	<?php include_once 'header.php'; ?>

	<?php 
		if ($_SESSION['page'] == "home") { 
			include_once 'modules/showing.php';
			// include_once 'modules/upcoming.php';
		}
		else {
			include_once 'modules/'.$_SESSION['page'].'.php';
		}
	?>
	<?php include 'footer.php'; ?>

</div>
</body>
</html>