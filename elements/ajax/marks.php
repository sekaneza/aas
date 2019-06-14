<?php
	session_start();
	define('PAGE','sign in');define('PATH','');
	require("../includes/connection.php");
	require("../includes/my_functions.php");

	$query=$cms->query("SELECT * FROM marks WHERE reg_num='{$_REQUEST['reg_num']}' AND course_ID={$_REQUEST['course_ID']}");

	if ($query->num_rows) {
		$cms->query("UPDATE marks SET total={$_REQUEST['marks']} WHERE reg_num='{$_REQUEST['reg_num']}' AND course_ID={$_REQUEST['course_ID']} ");
	}
	else {
		$cms->query("INSERT INTO marks VALUES(null,'{$_REQUEST['reg_num']}',{$_REQUEST['course_ID']},{$_REQUEST['marks']})");
	}
	
	
	if ($cms->affected_rows>0){
		echo 1;
	}
	else{
		echo 0;
	}

?>