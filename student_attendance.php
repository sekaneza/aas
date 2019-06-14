<?php
	session_start();
	define('PATH','');
	require("elements/includes/connection.php");
	require("elements/includes/my_functions.php");

	if (isset($_REQUEST['course_ID'])) {

		$count=1;
        $student_attendance="
        <div class='alp arp abp abm'>
	        <div class='well rbp rtp no_bg'>
	        	<p><b>P</b> : present</p>
	        	<p><b>A</b> : Absent</p>
	        </div>
	        <div class='panel panel-default table-responsive'>
				<div class='panel-heading'><h3 class='panel-title text-center'>".$_SESSION['student_fname']." ".$_SESSION['student_lname']."</h3></div>
				<table class='table'>
					<tr>
						<th>No</th>
						<th>Date</th>
						<th>Dep</th>
						<th>Year</th>
						<th>Trimester</th>
						<th>Att</th>
					</tr>";


		$query=$aas->query("SELECT * FROM attendance WHERE course_ID={$_REQUEST['course_ID']} AND student_ID={$_SESSION['student_ID']}");
		$student=$aas->query("SELECT * FROM students WHERE ID={$_SESSION['student_ID']}")->fetch_assoc();

		while ($row=$query->fetch_assoc()){
			$success=true;
			$student_attendance.="
				<tr class='".($row['obs']=='P'?'present':'')."'>
					<td>$count</td>
					<td>".substr($row['date'], 0,(strrpos($row['date'], ' ')))."</td>
					<td>".check_dep($row['dep_ID'])."</td>
					<td>".$student['year']."</td>
					<td>".$student['trimester']."</td>
					<td>".$row['obs']."</td>
				</tr>";
			$count++;
		}
			$student_attendance.="
				</table>
			</div>
		</div>";

	}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'elements/includes/head.php';?>
</head>
<body>
    <?php include 'elements/includes/header_nav.php';?>

    <section class="row rlm rrm">
    	<div class="container">
    		<?php
				if (@$success) {
					echo @$student_attendance;
				}
				else{
					echo "<div class='lead col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-warning text-center '><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Sorry, no attendance for this course!</div>";
				}
    		?>
    	</div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>

</body>
</html>