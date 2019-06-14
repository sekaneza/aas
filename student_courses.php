<?php
    session_start();
    define('PATH','');
    require("elements/includes/connection.php");
    require("elements/includes/my_functions.php");
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
                $query=$aas->query("SELECT course_ID FROM timetable WHERE dep_ID={$_SESSION['student_dep']} AND year={$_SESSION['student_year']} AND trimester={$_SESSION['student_trimester']} AND session='{$_SESSION['session']}'");
                            
                if ($query->num_rows) {
                    while ($row = $query->fetch_assoc()) {
                        $course_ID=$row['course_ID'];
                        $course_title=$aas->query("SELECT title FROM courses WHERE ID=$course_ID")->fetch_assoc()['title'];
            ?>
                        <div class="alp arp atm">
                            <div class="panel panel-default table-responsive">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center">
                                        <a href="<?php echo $_REQUEST['page'];?>.php?course_ID=<?php echo $course_ID;?>"><?php echo $course_title;?></a>
                                    </h3>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }else{
            ?>
                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-warning text-center">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Sorry, You don't have any course to study!
                </div>
            <?php };?>
        </div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>

</body>
</html>