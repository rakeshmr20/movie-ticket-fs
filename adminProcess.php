<?php
// Developed by Rakesh M R
include_once 'utils/fileHandler.php';
// if ($_SESSION['userStatus']!='100') {
// 	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=home';</script>";
//     exit;
// }
// print_r($_SESSION['userStatus']);

$movieFH = new FileProcess('database/movies.txt');
$upcomingFH = new FileProcess('database/upcoming.txt');
$theatreFH = new FileProcess('database/theatres.txt');
$timeFH = new FileProcess('database/timings.txt');

function postVal($vname)
{
	return strval($_POST[$vname]);
}

if (isset($_POST['addMovie'])) {
	$target_dir = "upload/";
	// $t_file = $target_dir . basename($_FILES["imageFile"]["name"]);
	$imageFileType = strtolower(pathinfo(basename($_FILES["imageFile"]["name"]),PATHINFO_EXTENSION));
	$fileName = strval(sha1(uniqid())) .'.'. $imageFileType;
	$target_file = $target_dir . $fileName;
	if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
    	// echo "The file ". basename( $_FILES["imageFile"]["name"]). " has been uploaded.";
	  } else {
	    // echo "Sorry, there was an error uploading your file.";
	}
	$updateData = ''.uniqid().'~'.postVal('mname').'~'.postVal('Genre').'~'.postVal('dname').'~'.postVal('description').'~'.$fileName.'~'.postVal('imdb').'~'.postVal('price').'~';
	$updateData = $updateData.strval(sha1($updateData)).'|';
	// print_r($updateData);
	$resultUpdate = $movieFH->appendFile($updateData);
	if ($resultUpdate) {
		$_SESSION['errMsg'] = 'Updated Successfully.';
	} else {
		$_SESSION['errMsg'] = 'Problem Occured. Please try again..!';
	}
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=adminHome';</script>";
    exit;
}

if (isset($_POST['addUpcoming'])) {
	$target_dir = "upload/";
	// $t_file = $target_dir . basename($_FILES["imageFile"]["name"]);
	$imageFileType = strtolower(pathinfo(basename($_FILES["imageFile"]["name"]),PATHINFO_EXTENSION));
	$fileName = strval(sha1(uniqid())) .'.'. $imageFileType;
	$target_file = $target_dir . $fileName;
	if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
    	// echo "The file ". basename( $_FILES["imageFile"]["name"]). " has been uploaded.";
	  } else {
	    // echo "Sorry, there was an error uploading your file.";
	}
	$updateData = ''.uniqid().'~'.postVal('umname').'~'.postVal('uGenre').'~'.postVal('udname').'~'.postVal('udescription').'~'.$fileName.'~';
	$updateData = $updateData.strval(sha1($updateData)).'|';
	// print_r($updateData);
	$resultUpdate = $upcomingFH->appendFile($updateData);
	if ($resultUpdate) {
		$_SESSION['errMsg'] = 'Updated Successfully.';
	} else {
		$_SESSION['errMsg'] = 'Problem Occured. Please try again..!';
	}
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=adminHome';</script>";
    exit;
}

if (isset($_POST['addTheatre'])) {
	$updateData = ''.uniqid().'~'.postVal('tname').'~'.postVal('seats').'~';
	$updateData = $updateData.strval(sha1($updateData)).'|';
	// print_r($updateData);
	$resultUpdate = $theatreFH->appendFile($updateData);
	if ($resultUpdate) {
		$_SESSION['errMsg'] = 'Updated Successfully.';
	} else {
		$_SESSION['errMsg'] = 'Problem Occured. Please try again..!';
	}
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=adminHome';</script>";
    exit;
}

if (isset($_POST['addTimings'])) {
	$updateData = ''.uniqid().'~'.postVal('stime').'~';
	$updateData = $updateData.strval(sha1($updateData)).'|';
	// print_r($updateData);
	$resultUpdate = $timeFH->appendFile($updateData);
	if ($resultUpdate) {
		$_SESSION['errMsg'] = 'Updated Successfully.';
	} else {
		$_SESSION['errMsg'] = 'Problem Occured. Please try again..!';
	}
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=adminHome';</script>";
    exit;
}

if (isset($_POST['delMovie'])) {
	unlink('upload/'.$movieFH->deleteSingleData($_POST['delId']));
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=adminHome';</script>";
    exit;
}
if (isset($_POST['delUpcoming'])) {
	unlink('upload/'.$upcomingFH->deleteSingleData($_POST['delId']));
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=adminHome';</script>";
    exit;
}
if (isset($_POST['delTime'])) {
	$timeFH->deleteSingleData($_POST['delId']);
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=adminHome';</script>";
    exit;
}
if (isset($_POST['delTheatre'])) {
	$theatreFH->deleteSingleData($_POST['delId']);
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=adminHome';</script>";
    exit;
}

?>