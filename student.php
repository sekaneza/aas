<?php
	session_start();
	define('PAGE','sign in');define('PATH','');
	require("elements/includes/connection.php");
	require("elements/includes/my_functions.php");
	
	if(isset($_REQUEST['reg_num']) && isset($_REQUEST['password'])){
        $reg_num=$aas->real_escape_string($_REQUEST['reg_num']);
        $password=$aas->real_escape_string($_REQUEST['password']);
        
        $query=$aas->query("SELECT * FROM students WHERE reg_num='$reg_num' AND password='$password'");

        if(@$query->num_rows){
            $student = $query->fetch_assoc();
            $_SESSION['student_ID']=$student['ID'];
            $_SESSION['reg_num'] = $student['reg_num'];
            $_SESSION['student_fname'] = $student['fname'];
            $_SESSION['student_lname'] = $student['lname'];
            $_SESSION['student_dep'] = $student['dep_ID'];
            $_SESSION['student_year'] = $student['year'];
            $_SESSION['student_trimester'] = $student['trimester'];
            $_SESSION['session'] = $student['session'];
			
			$success="<div class='alert alert-success text-center'>Welcome {$_SESSION['student_fname']} {$_SESSION['student_lname']}</div>";
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
    		<?php if(!isset($_SESSION['student_ID'])){?>
    	    <div class="well no_bg table-bordered col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 smooth_shadow">
    	        <legend><label class="rbm"><span class='glyphicon glyphicon-user'></span> Student</label></legend>
                <form role="form" method="post" action="student.php">
                    <div class="form-group">
                        <label for="reg_num">Registration number</label>
                        <input type="text" class="form-control" id="reg_num" name="reg_num" required><br>
                         <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required><br>
                        <button type="submit" class="btn btn-primary pull-right">Log in</button>
                        <a href="student_verify.php" class="">forgot password?</a>
                    </div>
                </form>
    	    </div>
    		<?php }else{
    			include 'elements/includes/student_menu.php';
    		}?>
    	</div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>

</body>
</html>