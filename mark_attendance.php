<?php
	session_start();
	define('PATH','');
	require("elements/includes/connection.php");
	require("elements/includes/my_functions.php");

	if (@$_REQUEST['student_ID'] && @$_REQUEST['course_ID'] && @$_REQUEST['obs']) {
		
		$student=$aas->query("SELECT * FROM students WHERE ID={$_REQUEST['student_ID']}")->fetch_assoc();

		$aas->query("INSERT INTO attendance VALUES(null,{$student['ID']},'{$student['reg_num']}',{$student['dep_ID']},{$_REQUEST['course_ID']},'{$student['session']}',{$_SESSION['lecturer_ID']},null,'{$_REQUEST['obs']}')");
	}
?>