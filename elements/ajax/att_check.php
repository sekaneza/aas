<?php
	session_start();
	define('PATH','');
	require("../includes/connection.php");
	require("../includes/my_functions.php");

	$today=date("Y-m-d");

	$query=$aas->query("SELECT * FROM holidays WHERE `holidays`.`date`='$today'");

	if(!$query->num_rows){
		if(@$_REQUEST['course_ID'] && isset($_REQUEST['done'])){
			$aas->query("DELETE FROM att_check WHERE lecturer_ID={$_SESSION['lecturer_ID']} AND course_ID={$_REQUEST['course_ID']}");
			$aas->query("INSERT INTO att_check VALUES(null,{$_SESSION['lecturer_ID']},{$_REQUEST['course_ID']},null)");
		}
		elseif (@$_REQUEST['course_ID']){
			
			
			$check=$aas->query("SELECT * FROM att_check WHERE `att_check`.`date` BETWEEN '$today 00:00:00' AND '$today 23:59:59' AND lecturer_ID={$_SESSION['lecturer_ID']} AND course_ID={$_REQUEST['course_ID']}");

			if ($check->num_rows)
			{
				$aas->query("DELETE FROM attendance WHERE `attendance`.`date` BETWEEN '$today 00:00:00' AND '$today 23:59:59' AND lecturer_ID={$_SESSION['lecturer_ID']} AND course_ID={$_REQUEST['course_ID']}");
				
				$aas->query("DELETE FROM att_check WHERE lecturer_ID={$_SESSION['lecturer_ID']} AND course_ID={$_REQUEST['course_ID']}");
			}
		}
	}else{
		echo "holiday";
	}

?>