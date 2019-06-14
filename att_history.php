<?php
	session_start();
	define('PATH','');
	require("elements/includes/connection.php");
	require("elements/includes/my_functions.php");

	if (isset($_REQUEST['session']) && isset($_REQUEST['course_ID']) && isset($_REQUEST['day']) && isset($_REQUEST['month'])) {

		$count=1;
		$date=date("Y")."-".$_REQUEST['month']."-".$_REQUEST['day'];
		$course_title=$aas->query("SELECT title FROM courses WHERE ID={$_REQUEST['course_ID']}")->fetch_assoc()['title'];

        $students_list="
        <div class='alp arp abp abm'>
	        <div class='well rbp rtp no_bg'>
	        	<p><b>P</b> : present</p>
	        	<p><b>A</b> : Absent</p>
	        </div>
	        <div class='panel panel-default table-responsive'>
				<div class='panel-heading'><h3 class='panel-title text-center'>".$course_title."</h3></div>
				<table class='table'>
					<tr>
						<th>No</th>
						<th>Reg & Names</th>
						<th>Dep</th>
						<th>Obs</th>
					</tr>";


		$query=$aas->query("SELECT * FROM attendance WHERE course_ID={$_REQUEST['course_ID']} AND lecturer_ID={$_SESSION['lecturer_ID']} AND session='{$_REQUEST['session']}' AND `attendance`.`date` BETWEEN '$date 00:00:00' AND '$date 23:59:59'");

		while ($row=$query->fetch_assoc()){
			$success=true;
			$ID=$row['ID'];
			$reg_num=$row['reg_num'];
			$fname=$aas->query("SELECT fname FROM students WHERE reg_num='$reg_num'")->fetch_assoc()['fname'];
			$lname=$aas->query("SELECT lname FROM students WHERE reg_num='$reg_num'")->fetch_assoc()['lname'];

			$students_list.="
				<tr class='".($row['obs']=='P'?'success':'')."'>
					<td>$count</td>
					<td class=''>
						<b>$reg_num</b><br><small>$fname $lname</small>
					</td>
					<td>".check_dep($row['dep_ID'])."</td>
					<td>".$row['obs']."</td>
				</tr>";
			$count++;
		}
			$students_list.="
				</table>
			</div>
		</div>";

		if (@!$success) {
			$fail= "<div class='lead col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-warning text-center '><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Sorry, no attendance marked on this date!</div>";
		}

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
	    	<?php
				if (@$success) {
		    		echo"<div class='breadcrumb'>".check_session($_REQUEST['session'])." ".$_REQUEST['day']."/".$_REQUEST['month']."/".date("Y")."</div>";
					echo @$students_list;
				}
	    	?>
	    	<?php if (!@$success){?>
	    	<?php echo @$fail;?>
	    	<div class="well no_bg table-bordered col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 smooth_shadow">
	    		<legend><label class="rbm">Attendance history</label></legend>
	    		<form method="post" action="att_history.php">
	    			<div class="form-group">
	    				<label>Date</label><br>
	    				<div class="col-xs-12 col-sm-6 table-bordered abp abm" style="background:#f8f8f8;">
	    					<label>Day</label><br>
	    					<select name="day">
	    						<option value="" hidden>----</option>
	    						<?php for($i=1;$i<=31;$i++): ?>
	    						<option value="<?php echo $i;?>"><?php echo $i;?></option>
	    						<?php endfor;?>
	    					</select>
	    				</div>
	    				<div class="col-xs-12 col-sm-6 table-bordered abp abm" style="background:#f8f8f8;">
	    					<label>Month</label><br>
	    					<select name="month">
	    						<option hidden="hidden">----</option>
	    						<option value="1">January</option>
	    						<option value="2">February</option>
	    						<option value="3">March</option>
	    						<option value="4">April</option>
	    						<option value="5">May</option>
	    						<option value="6">June</option>
	    						<option value="7">July</option>
	    						<option value="8">August</option>
	    						<option value="9">September</option>
	    						<option value="10">October</option>
	    						<option value="11">November</option>
	    						<option value="12">December</option>
	    					</select>
	    				</div>
	    				<input type="text" name="session" value="<?php echo $_REQUEST['session'];?>" hidden>
	    				<input type="text" name="course_ID" value="<?php echo $_REQUEST['course_ID'];?>" hidden>
	    				<button type="submit" class="btn btn-primary">View</button>
	    			</div>
	    		</form>
	    	</div>
	    	<?php }?>
    	</div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>

</body>
</html>