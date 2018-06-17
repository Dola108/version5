<?php
	include('connection.php');
	//$val = $_GET["val"];
	if (!empty($_SESSION['uname'])) {
		$uname = $_SESSION['uname'];
		$_SESSION['uname'] = $uname;
	}
	if (isset($_POST['users'])) {
		$un = $_POST['users'];
		$un = substr($un, 1);
		
		header('Location: profile.php?un='.$un);
	}
	else {
		$val = $_POST['search'];
		$val = substr($val, 1);
		$val = "%23" . $val;

		header('Location: Tagboard.php?val='.$val);
	}
?>