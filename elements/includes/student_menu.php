<script type="text/javascript">
	$(document).ready(function() {
		$(".badge").load("elements/ajax/student_messages_count.php");
	});
</script>

<div class="alp arp atm">
	<div class="panel panel-default shadow">
		<div class="panel-heading">
			<h3 class="panel-title text-center">
				<a href="student_courses.php?page=student_attendance">My attendance</a>
			</h3>
		</div>
	</div>
</div>
<div class="alp arp atm">
	<div class="panel panel-default shadow">
		<div class="panel-heading">
			<h3 class="panel-title text-center">
				<a href="student_messages.php">
					Message
	                <span class="glyphicon glyphicon-envelope"></span>
	                <span class="badge" style="vertical-align:top">0</span>
				</a>
			</h3>
		</div>
	</div>
</div>