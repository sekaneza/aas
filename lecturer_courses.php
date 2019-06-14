<?php
	session_start();
	define('PATH','');
	require("elements/includes/connection.php");
	require("elements/includes/my_functions.php");

	$query=$aas->query("SELECT DISTINCT course_ID FROM timetable WHERE lecturer_ID={$_SESSION['lecturer_ID']}");
				
	if (isset($_REQUEST['delete_course'])) {
		$aas->query("DELETE FROM timetable WHERE course_ID={$_REQUEST['delete_course']} AND lecturer_ID={$_SESSION['lecturer_ID']}");
	}

    if (isset($_REQUEST['my_courses']) || isset($_REQUEST['delete_course'])){
        $delete_course="";
    }
    else{
        $delete_course="hidden";
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
            <?php if($query->num_rows):?>
        		<?php while($row=$query->fetch_assoc()){?>
    			<div class="alp arp atm atp">
    				<div class="panel panel-primary table-responsive">
                        <a href="lecturer_courses.php?delete_course=<?php echo $row['course_ID'];?>" class="<?php echo $delete_course;?> pull-right btn btn-primary "><span class="glyphicon glyphicon-trash"></span></a>
    					<div class="panel-heading"><h3 class="panel-title text-center"><?php echo $aas->query("SELECT title FROM courses WHERE ID={$row['course_ID']}")->fetch_assoc()['title'];?></h3></div>
    					<table class="table table-hover table-striped">
    						<tr>
    							<td class="text-center">
    								<a href="<?php echo $_REQUEST['page'];?>.php?course_ID=<?php echo $row['course_ID'];?>&session=M"><img src="elements/images/sun.png" width="20"> Session</a>
    							</td>
    							<td class="text-center">
    								<a href="<?php echo $_REQUEST['page'];?>.php?course_ID=<?php echo $row['course_ID'];?>&session=E"><img src="elements/images/moon.png" width="20"> Session</a>
    							</td>
    						</tr>
    					</table>
    				</div>
    			</div>
                <?php }?>
    		<?php else:?>
    			<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-warning text-center">
    				<span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Sorry, You don't have any course to teach!
    			</div>
    		<?php endif;?>
    	</div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>

</body>
</html>