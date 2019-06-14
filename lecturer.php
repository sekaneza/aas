<?php
	session_start();
	define('PAGE','sign in');define('PATH','');
	require("elements/includes/connection.php");
	require("elements/includes/my_functions.php");
	
	if(isset($_REQUEST['uname']) AND isset($_REQUEST['password'])){
		$uname=$aas->real_escape_string($_REQUEST['uname']);
		$password=$aas->real_escape_string($_REQUEST['password']);
		
		$query=$aas->query("SELECT ID FROM lecturers WHERE uname='$uname' AND BINARY password='$password'");
		if(@$query->num_rows){
		 	$_SESSION['lecturer_ID']=$query->fetch_assoc()['ID'];
		 	$_SESSION['lecturer_uname']=$uname;
			
			$success="<div class='alert alert-success text-center'>Welcome $uname</div>";
		}
		else{
			$fail="<div class='alert alert-danger text-center '><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Sorry, this account doesn't exist. Please try again!</div>";
		}
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
    	<div class="container atm abm">
    		<?php echo @$success.@$fail;?>
    		<?php if(!isset($_SESSION['lecturer_ID'])){?>
    	    <div class="well no_bg table-bordered col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 smooth_shadow">
    	        <legend><label class="rbm"><span class='glyphicon glyphicon-user'></span> Lecturer</label></legend>
    	        <form role="form" method="post" action="lecturer.php">
    	            <div class="form-group">
    	                <label for="uname">Username</label>
    	                <input type="text" class="form-control" id="uname" name="uname" required><br>
    	                <label for="password">Password</label>
    	                <input type="password" class="form-control" id="password" name="password" required><br>
    	                <button type="submit" class="btn btn-primary pull-right">Log in</button>
    	                <a href="lecturer_verify.php" class="">forgot password?</a>
    	            </div>
    	        </form>
    	    </div>
    		<?php }else{
    			include 'elements/includes/lecturer_menu.php';
    		}?>
    	</div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>
</body>
</html>