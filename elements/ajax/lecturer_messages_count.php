<?php
session_start();
define('PAGE','sign in');define('PATH','');
require("../includes/connection.php");
require("../includes/my_functions.php");

if (isset($_SESSION['lecturer_ID'])) {
	$messages=$aas->query("SELECT count(ID) AS messages FROM messages WHERE lecturer_ID={$_SESSION['lecturer_ID']}")->fetch_assoc()['messages'];

	echo $messages;
}
else{
	echo "0";
}
?>