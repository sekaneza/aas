<?php
	session_start();
	define('PATH','');
	require("elements/includes/connection.php");
	require("elements/includes/my_functions.php");

	if(isset($_REQUEST['delete_message'])){
		$aas->query("DELETE FROM messages WHERE ID={$_REQUEST['delete_message']}");
	}

	if(isset($_REQUEST['phone']) || (isset($_REQUEST['lecturer']) && isset($_REQUEST['message']))){

		$phone=$_REQUEST['phone'] ? ($_REQUEST['country_code'].$_REQUEST['phone']) : null;
		$lecturer_ID=$_REQUEST['lecturer'];
		$message=$aas->real_escape_string($_REQUEST['message']);
		$date=date('D-M-Y');

		$aas->query("INSERT INTO messages VALUES(null,$lecturer_ID,{$_SESSION['student_ID']},'$phone','$message','$date','send')");

		if($aas->affected_rows>0){
		    $success="<div class='alert alert-success lead text-center'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Message sent successfully</div>";
		} else {
		    $fail="<div class='alert alert-danger lead text-center'><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Message not sent. Please try again</div>";
		}
	}
	if(isset($_REQUEST['to_lecturer']) && isset($_REQUEST['message'])){

		$message=$aas->real_escape_string($_REQUEST['message']);
		$date=date('D-M-Y');

		$aas->query("INSERT INTO messages VALUES(null,{$_REQUEST['to_lecturer']},{$_SESSION['student_ID']},'','$message','$date','send')");

		if($aas->affected_rows>0){
		    $success="<div class='alert alert-success lead text-center'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Message sent successfully</div>";
		} else {
		    $fail="<div class='alert alert-danger lead text-center'><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Message not sent. Please try again</div>";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
    <?php include 'elements/includes/head.php';?>
    <script type="text/javascript">
	$(document).ready(function() {
		$(document).on("click",".message_header",function(){
			$(this).next("tr").fadeToggle(100);
		});
	})
</script>
</head>
<body>
    <?php include 'elements/includes/header_nav.php';?>

    <section class="row rlm rrm">
		<div class="container">
			<?php echo @$fail.@$success;?>
			<?php
				if (!isset($_REQUEST['compose'])){
					$query_messages=$aas->query("SELECT * FROM messages WHERE student_ID={$_SESSION['student_ID']}");

					if (@$query_messages->num_rows) {
						echo"
						<a href='student_messages.php?compose' class='btn btn-primary'>Compose</a><br><br>
					    <div class='no_bg panel panel-primary table-responsive'>
							<div class='panel-heading'><h3 class='panel-title text-center'>Message(s)</h3></div>
							<table class='table table-bordered table-striped'>";

						while ($row = $query_messages->fetch_assoc()) {
							$lecturer=$aas->query("SELECT * FROM lecturers WHERE ID={$row['lecturer_ID']}")->fetch_assoc();
							$obs=($row['obs']=='send')?'To':'From';
							$reply=($row['obs']=='reply')?'':'hidden';

							echo"
								<tr class='message_header'>
									<td>
										<b>".$obs.":</b><br>".$lecturer['fname']." ".$lecturer['lname']."
										<br>
										<b>Date</b><br>".$row['date']."
										<a href='student_messages.php?delete_message={$row['ID']}' class='pull-right btn btn-primary'><span class='glyphicon glyphicon-trash'></span>
										</a>
									</td>
								</tr>
								<tr hidden>
									<td>
										<p class='text-center well'>".$row['message']."</p>
										
										<form class='$reply' method='post' action='student_messages.php'>
											<input type='text' name='to_lecturer' value='".$lecturer['ID']."' hidden>
											<textarea class='form-control' name='message' rows='5' required='require'></textarea>
											<button type='submit' class='btn btn-primary btn-block'>Reply <span class='glyphicon glyphicon-share-alt'></span></button>
										</form>
									</td>
								</tr>";
							}
								echo"
								</table>
							</div>";
						}
					}
				?>
				<?php if (!@$query_messages->num_rows):?>
				<div class="well no_bg">
					<legend><label class="rbm">Message</label></legend>
					<form method="post" action="student_messages.php">
						<label class="rbm">Phone number</label>
						<div class="input-group" style="width:100%;">
							<span class="input-group-btn" style="width:auto;">
								<select class="form-control rlp rrp rtp rbp" name="country_code">
									<option value="+250">+250</option>
									<option value="+243">+243</option>
								</select>
							</span>
							<input type="tel" class="form-control" name="phone">
						</div>
						<br>
						<label class="rbm">Lecturer</label>
						<select class="form-control rlp rrp rtp rbp" name="lecturer">
							<option value="" hidden></option>
							<?php
								$query=$aas->query("SELECT * FROM lecturers");

								while ($lecturers = $query->fetch_assoc()) {
									echo "<option value='{$lecturers['ID']}'>{$lecturers['fname']} {$lecturers['lname']}</option>";
								}
							?>
						</select><br>
						<label class="rbm">Message</label>
						<textarea class="form-control" name="message" rows="5" required="require"></textarea>
						<button type="submit" class="btn btn-primary btn-block" title="send"><span class="glyphicon glyphicon-send"></span></button>
					</form>
				</div>
			<?php endif;?>
		</div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>

</body>
</html>