<?php
	session_start();
	define('PATH','');
	require("elements/includes/connection.php");
	require("elements/includes/my_functions.php");

	if (isset($_REQUEST['day']) && isset($_REQUEST['month'])) {
		$year=date("Y");
		$holiday=$year."-".$_REQUEST['month']."-".$_REQUEST['day'];

		$query=$aas->query("SELECT * FROM holidays WHERE `holidays`.`date`='$holiday'");
		
		if (!$query->num_rows) {
			$aas->query("INSERT INTO holidays VALUES(null,'$holiday')");
			if ($aas->affected_rows) {
				$success= "<div class='lead col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-success text-center '><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> The holiday was successfully added</div>";
			}
			else{
				$fail= "<div class='lead col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-warning text-center '><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Sorry, the holiday was not successfully added</div>";
			}
		}
		else{
			$fail= "<div class='lead col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 alert alert-warning text-center '><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Sorry, the holiday has been added</div>";
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
	    	<?php echo @$fail.@$success;?>
	    	<div class="well no_bg table-bordered col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 smooth_shadow">
	    		<legend><label class="rbm">Holiday</label></legend>
	    		<form method="post" action="holidays.php">
	    			<div class="form-group">
	    				<label>Date</label><br>
	    				<div class="col-xs-12 col-sm-6 table-bordered abp abm" style="background:#f8f8f8;">
	    					<label>Day</label><br>
	    					<select name="day">
	    						<option value="" hidden>----</option>
	    						<?php for($i=1;$i<=31;$i++){
	    							$zero=$i<10?"0":'';

	    						?>
	    						<option value="<?php echo $zero.$i;?>"><?php echo $zero.$i;?></option>
	    						<?php }?>
	    					</select>
	    				</div>
	    				<div class="col-xs-12 col-sm-6 table-bordered abp abm" style="background:#f8f8f8;">
	    					<label>Month</label><br>
	    					<select name="month">
	    						<option hidden="hidden">----</option>
	    						<option value="01">January</option>
	    						<option value="02">February</option>
	    						<option value="03">March</option>
	    						<option value="04">April</option>
	    						<option value="05">May</option>
	    						<option value="06">June</option>
	    						<option value="07">July</option>
	    						<option value="08">August</option>
	    						<option value="09">September</option>
	    						<option value="10">October</option>
	    						<option value="11">November</option>
	    						<option value="12">December</option>
	    					</select>
	    				</div>
	    				<button type="submit" class="btn btn-primary">Add</button>
	    			</div>
	    		</form>
	    	</div>
    	</div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>

</body>
</html>