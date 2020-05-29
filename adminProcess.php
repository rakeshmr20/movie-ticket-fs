<?php
// Developed by Rakesh M R
include_once 'utils/fileHandler.php';
if ($_SESSION['userStatus']!='100') {
	echo "<script>window.location.href='/movie-ticket-fs/index.php?page=home';</script>";
    exit;
}

$movieFH = new FileProcess('database/movies.txt');
$upcomingFH = new FileProcess('database/upcoming.txt');

function postVal($vname)
{
	return strval($_POST[$vname]);
}
if (isset($_POST['addMovie'])) {
	$updateData = ''.uniqid().'~'.postVal('mname').'~'.postVal('Genre').'~'.postVal('dname').'~'.postVal('description').'~'.postVal('image').'~'.postVal('imdb').'~'.postVal('price').'~';
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
	$updateData = ''.uniqid().'~'.postVal('umname').'~'.postVal('uGenre').'~'.postVal('udname').'~'.postVal('udescription').'~'.postVal('uimage').'~';
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

?>