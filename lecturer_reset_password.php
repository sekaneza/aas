<?php
	session_start();
	define('PATH','');
	require('elements/includes/connection.php');
	require("elements/includes/my_functions.php");

	if(isset($_POST['password'])){
		$success=$fail='';
		$password=$aas->real_escape_string($_POST['password']);

		$aas->query("UPDATE lecturers SET password='$password' WHERE ID={$_SESSION['lecturer_temp_ID']}");

		if(@$aas->affected_rows>0){
			$success="<div class='col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-success text-center'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Your password was successfully changed!</div>";
		}else{
			$fail="<div class='col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-danger text-center'><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Your password was not successfully changed!</div>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php
		require('elements/includes/head.php');
	?>
	<script type="text/javascript">
		$(function() {
			$("form").submit(function(){
				
				var password1=$("input[name='password']").val();
				var password2=$("input[name='cpassword']").val();

				if(password1!=password2){
					alert("Sorry, the password doesn't match");
					return false;
				}
				else{
					return true;
				}
			})
		})
	</script>
</head>
<body>
	<?php 
		require("elements/includes/header_nav.php"); 
	?>
	<section class="row rlm rrm">
		<div id="result" class="alm arm atm abm">
			<?php echo @$fail.@$success;?>
			<div class="well atm no_bg col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 smooth_shadow">
				<legend><label class="rbm">Reset password</label></legend>
				<form role="form" method="post" action="lecturer_reset_password.php">
					<div class="form-group">
						<label for="password" class="rbm">New password*</label>
						<input type="password" class="form-control" name="password" required><br>
						<label for="cpassword" class="rbm">Confirm password*</label>
						<input type="password" class="form-control" name="cpassword" required><br>
						<button type="submit" class="btn btn-warning pull-right">Submit</button>
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