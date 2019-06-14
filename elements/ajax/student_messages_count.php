<?php
session_start();
define('PATH','');
require("../includes/connection.php");
require("../includes/my_functions.php");

if (isset($_SESSION['student_ID'])) {
	$messages=$aas->query("SELECT count(ID) AS messages FROM messages WHERE student_ID={$_SESSION['student_ID']}")->fetch_assoc()['messages'];

	echo $messages;
}
else{
	echo "0";
}
?>