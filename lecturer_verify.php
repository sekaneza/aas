<?php
	session_start();
	define('PAGE','Create account');define('PATH','');
	require('elements/includes/connection.php');
	require("elements/includes/my_functions.php");

	if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['uname'])){
		$success=$fail='';
		$fname=$aas->real_escape_string($_POST['fname']);
		$lname=$aas->real_escape_string($_POST['lname']);
		$uname=$aas->real_escape_string($_POST['uname']);

		//check if the account already exists
		$query=$aas->query("SELECT * FROM lecturers WHERE fname='$fname' AND lname='$lname' AND uname='$uname'");

		if(@$query->num_rows){
			$_SESSION['lecturer_temp_ID']=$query->fetch_assoc()['ID'];
			header("location:lecturer_reset_password.php");
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
				<legend><label class="rbm"><span class="glyphicon glyphicon-user"></span> Lecturer verification</label></legend>
				<form role="form" method="post" action="lecturer_verify.php">
					<div class="form-group">
						<label for="fname" class="rbm">First name*</label>
						<input type="text" class="form-control" name="fname" required><br>
						<label for="lname" class="rbm">Last name*</label>
						<input type="text" class="form-control" name="lname" required><br>
						<label for="uname" class="rbm">Username*</label>
						<input type="text" class="form-control" name="uname" required><br>
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
