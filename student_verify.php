<?php
	session_start();
	define('PATH','');
	require('elements/includes/connection.php');
	require("elements/includes/my_functions.php");

	if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['reg_num']) && isset($_POST['year']) && isset($_POST['trimester']) && isset($_POST['dep_ID'])){
		$success=$fail='';
		$fname=$aas->real_escape_string($_POST['fname']);
		$lname=$aas->real_escape_string($_POST['lname']);
		$reg_num=$aas->real_escape_string($_POST['reg_num']);
		$year=$aas->real_escape_string($_POST['year']);
		$trimester=$aas->real_escape_string($_POST['trimester']);
		$dep_ID=$_POST['dep_ID'];

		//check if the account already exists
		$query=$aas->query("SELECT * FROM students WHERE fname='$fname' AND lname='$lname' AND reg_num='$reg_num' AND year=$year AND trimester=$trimester AND dep_ID=$dep_ID");

		if(@$query->num_rows){
			$_SESSION['student_temp_ID']=$query->fetch_assoc()['ID'];
			header("location:student_reset_password.php");
		}else{
			$fail="<div class='col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-danger text-center'><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Sorry, this account doesn't exist</div>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php
		require('elements/includes/head.php');
	?>
</head>
<body>
	<?php 
		require("elements/includes/header_nav.php"); 
	?>
	<section class="row rlm rrm">
		<div id="result" class="alm arm atm abm">
			<?php echo @$fail.@$success;?>
			<div class="well atm no_bg col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 smooth_shadow">
				<legend><label class="rbm"><span class="glyphicon glyphicon-user"></span> Student verification</label></legend>
				<form role="form" method="post" action="student_verify.php">
					<div class="form-group">
						<label for="fname" class="rbm">First name*</label>
						<input type="text" class="form-control" name="fname" required><br>
						<label for="lname" class="rbm">Last name*</label>
						<input type="text" class="form-control" name="lname" required><br>
						<label for="reg_num" class="rbm">Registration*</label>
						<input type="text" class="form-control" name="reg_num" required><br>
						<label for="year" class="rbm">Year of study*</label>
						<input type="text" class="form-control" name="year" required><br>
						<label for="trimester">Trimester*</label>
						<input type="text" class="form-control" id="trimester" name="trimester" required><br>
						<label for="dep_ID" class="rbm">Department*</label>
						<select class="form-control rlp rrp rtp rbp" id="dep_ID" name="dep_ID"><br>
							<option value="" hidden="hidden"></option>
							<option value="1">CE</option>
							<option value="2">BIT</option>
							<option value="3">BBM</option>
						</select><br>
						<button type="submit" class="btn btn-warning pull-right">Check</button>
					</div>
				</form><br>
			</div>
		</div>
	</section>

	<footer class="row rlm rrm">
		<?php
			include('elements/includes/footer.php');
		?>
	</footer>
</body>
</html>
