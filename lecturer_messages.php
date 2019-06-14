<?php
	session_start();
	define('PATH','');
	require("elements/includes/connection.php");
	require("elements/includes/my_functions.php");

	if(isset($_REQUEST['delete_message'])){
		$aas->query("DELETE FROM messages WHERE ID={$_REQUEST['delete_message']}");
	}

	if(isset($_REQUEST['to_student']) && isset($_REQUEST['message'])){

		$message=$aas->real_escape_string($_REQUEST['message']);
		$date=date('D-M-Y');

		$aas->query("INSERT INTO messages VALUES(null,{$_SESSION['lecturer_ID']},{$_REQUEST['to_student']},'','$message','$date','reply')");

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
				if (!isset($_REQUEST['reply'])){
					$query_messages=$aas->query("SELECT * FROM messages WHERE lecturer_ID={$_SESSION['lecturer_ID']}");

					if ($query_messages->num_rows) {
						echo"
					    <div class='no_bg panel panel-primary table-responsive'>
							<div class='panel-heading'><h3 class='panel-title text-center'>Message(s)</h3></div>
							<table class='table table-bordered table-striped'>";

						while ($row = $query_messages->fetch_assoc()) {
							$student=$aas->query("SELECT * FROM students WHERE ID={$row['student_ID']}")->fetch_assoc();
							$obs=($row['obs']=='send')?'From':'To';
							$reply=($obs=='To')?'hidden':'';

							echo"
								<tr class='message_header'>
									<td>
										<b>".$obs.":</b><br>".$student['fname']." ".$student['lname']."
										<br>
										<b>Date</b><br>".$row['date']."
										<a href='lecturer_messages.php?delete_message={$row['ID']}' class='pull-right btn btn-primary'><span class='glyphicon glyphicon-trash'></span>
										</a>
									</td>
								</tr>
								<tr hidden>
									<td>
										<p class='text-center well'>".$row['message']."</p>
										
										<form class='$reply' method='post' action='lecturer_messages.php'>
											<input type='text' name='to_student' value='".$student['ID']."' hidden>
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
    	</div>
    </section>

    <footer class="row rlm rrm">
        <?php include 'elements/includes/footer.php';?>
    </footer>

</body>
</html>