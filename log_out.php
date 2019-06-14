<?php 
	session_start();
	if(@$_SESSION['student_ID']){
		unset($_SESSION['student_ID']);
		header('Location:index.php');
	}
	elseif (@$_SESSION['lecturer_ID']) {
		unset($_SESSION['lecturer_ID']);
		header('Location:index.php');
	}
	else{
		header('Location:index.php');
	}
	exit();
?>