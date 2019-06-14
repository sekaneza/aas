<?php
	session_start();
	define('PATH','');
	require("elements/includes/connection.php");
	require("elements/includes/my_functions.php");

	if (isset($_REQUEST['session']) && isset($_REQUEST['course_ID'])) {

		$count=1;
		$query=$aas->query("SELECT * FROM timetable WHERE course_ID={$_REQUEST['course_ID']} AND lecturer_ID={$_SESSION['lecturer_ID']} AND session='{$_REQUEST['session']}'");
		$course_title=$aas->query("SELECT title FROM courses WHERE ID={$_REQUEST['course_ID']}")->fetch_assoc()['title'];

        $students_list="
        <div class='alp arp abp abm'>
	        <div class='panel panel-warning table-responsive'>
				<div class='panel-heading'><h3 class='panel-title text-center'>".$course_title."</h3></div>
				<table class='table'>
					<tr>
						<th>No</th>
						<th>Reg & Names</th>
						<th>Dep</th>
						<th>Year</th>
						<th>Trimester</th>
					</tr>";

		while($row=$query->fetch_assoc()){
			$course_ID=$row['course_ID'];
			$dep_ID=$row['dep_ID'];
			$year=$row['year'];
			$trimester=$row['trimester'];
			$session=$row['session'];

			$query_students=$aas->query("SELECT * FROM students WHERE dep_ID=$dep_ID AND year=$year AND trimester=$trimester AND session='$session'");


				while ($student=$query_students->fetch_assoc()){
					$success=true;
					$ID=$student['ID'];
					$reg_num=$student['reg_num'];
					$fname=$student['fname'];
					$lname=$student['lname'];

					$students_list.="
						<tr class=''>
							<td>$count</td>
							<td class='alp'>
								<label class='checkbox alp'>
									<input value='$ID' type='checkbox' name='student_ID'>
									<b>$reg_num</b><br><small>$fname $lname</small>
								</label>
							</td>
							<td>".check_dep($student['dep_ID'])."</td>
							<td>".$student['year']."</td>
							<td>".$student['trimester']."</td>
						</tr>";
					$count++;
				}
			}			
			$students_list.="
				</table>
				<input value='".@$_REQUEST['course_ID']."' type='text' name='course_ID' hidden>
				
				<button name='send_att' class='btn btn-warning btn-block'>
					Send <span class='glyphicon glyphicon-send'></span>
				</button>
			</div>
		</div>";

		
	}
?>
<!DOCTYPE html>
<html>
<html>
<head>
    <?php include 'elements/includes/head.php';?>
</head>
<body>
    <?php include 'elements/includes/header_nav.php';?>

    <section class="row rlm rrm">
    	<div class="container">
    		<div class="breadcrumb"><?php echo check_session($_REQUEST['session'])." ".date("D d M,Y");?></div>
    		<?php
	    		if (@$success) {
	    			echo @$students_list;
	    		}
	    		else{
	    			echo "<div class='lead col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-warning text-center '><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Sorry, no student available!</div>";
	    		}
    		?>
    	</div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>

</body>
</html>