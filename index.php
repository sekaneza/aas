<!DOCTYPE html>
<html>
<head>
    <?php include 'elements/includes/head.php';?>
</head>
<body>
    <?php include 'elements/includes/header_nav.php';?>

    <section class="row rlm rrm">
    	<div class="container">
    		<div>
				<div class="col-md-2">
					<img class="center-block img-responsive" src="elements/images/1.jpg">
					<img class="center-block img-responsive" src="elements/images/2.jpg">
					<img class="center-block img-responsive" src="elements/images/3.jpg">
					<img class="center-block img-responsive" src="elements/images/4.jpg">
					<img class="center-block img-responsive" src="elements/images/5.jpg">
				</div>
    			<div id="my_carousel" class="col-md-8 carousel slide abm" data-interval="3000" data-ride="carousel">
    				<ol class="carousel-indicators">
	    				<li data-target="#my_carousel" data-slide-to="0" class="active"></li>
	    				<li data-target="#my_carousel" data-slide-to="1"></li>
	    				<li data-target="#my_carousel" data-slide-to="2"></li>
	    				<li data-target="#my_carousel" data-slide-to="3"></li>
	    				<li data-target="#my_carousel" data-slide-to="4"></li>
    				</ol>
					<div class="carousel-inner">
					<?php
						$i=1;$active='';
					
						while($i<=5){
							if($i==1){$active='active';}else{$active='';}
							echo"<div class='item $active'>
									<img src='elements/images/$i.jpg' class='atp img-responsive center-block' alt='Picture'>
								</div>";
							$i++;
						}
					?>
					</div>
					<a class="carousel-control left" href="#my_carousel" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="carousel-control right" href="#my_carousel" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
				<div class="col-md-2">
					<img class="center-block img-responsive" src="elements/images/1.jpg">
					<img class="center-block img-responsive" src="elements/images/2.jpg">
					<img class="center-block img-responsive" src="elements/images/3.jpg">
					<img class="center-block img-responsive" src="elements/images/4.jpg">
					<img class="center-block img-responsive" src="elements/images/5.jpg">
				</div>
    		</div>
    		<div>
	    		<div class="col-xs-12 col-md-4 panel atm abm">
					<div class='panel-heading'>
						<img class="center-block" src="elements/images/1page-img.jpg">
					</div>
					<div class="well rbm">
						<p>
						 An automated attendance system that consists of a web system for
						 entire organization to record attendance. Each students has its own login.
						 On login the student can see a list of courses and choose course he/she want
						 to view his/her attendance also can send a message to the lecturer if she/he want permission
						 related to the attendance also when a student forgot a password this system can recovery a password.
						</p>
					</div>
				</div>
				<div class="col-xs-12 col-md-4 panel atm abm">
					<div class='panel-heading'>
						<img class="center-block" src="elements/images/2page-img4.jpg">
					</div>
					<div class="well rbm">
						<p>
						 Each lecturer has an own login. A lecturer may take the attendance and mark the present students
						 using checkbox provided in front of every student registration number and name also a lecturer may
						 check attendance history of students and he/she may view attendance percentage of how students attend
						 the course and may reply a message from students. All of information of attendance are stored in database.  .
						</p>
					</div>
				</div>
				<div class="col-xs-12 col-md-4 panel atm abm">
					<div class='panel-heading'>
						<img class="center-block abm abp" src="elements/images/icon3.png">
					</div>
					<div class="well rbm">
						<p>
						 specific objectives was to provide a database that displays the list
						 of students who are present and absent in class, To implement a user 
						 friendly system for students attendance and to develop a system that
						 would automatically record the student’s attendance. The researcher collected 
						 data through the interview, documentation and observation methods as data collection
						<br><br>
						</p>
					</div>
				</div>
			</div>
    	</div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>

</body>
</html>