$(main);

var HOST="http://localhost/aas/";

function main(){
	back_top();
	attendance();

	$("section").css({"min-height":$(window).height()-$("header").height()-50});	
}

function back_top() {
	$(document).scroll(function(){
		if ($(window).height()*2<$(document).height()) {
			$("#back_top").removeClass("hidden");
		}
	});
	$("#back_top").click(function(){
		$("html,body").animate({scrollTop:0},300);
	});
}

function attendance() {
	$(document).on("click","input[name='student_ID']",function(){
		if($(this).parent().parent().parent().hasClass("present"))
		{
			$(this).parent().parent().parent().removeClass("present")
		}
		else
		{
			$(this).parent().parent().parent().addClass("present")
		}
	});

	$(document).on("click","button[name='send_att']",function(){
		
		$(".loading_ajax").removeClass("hidden");
		var course_ID = $("input[name='course_ID'").val();
		var obs='A';
		
		$.get(HOST+"elements/ajax/att_check.php?course_ID="+course_ID).done(function(data){
			
			if(data=='holiday'){
				$(".loading_ajax").addClass("hidden");
				alert("Sorry, today it is an holiday");
			}
			else{
				$(".loading_ajax").removeClass("hidden");
				$("input[name='student_ID']").each(function(){
					var this_el=$(this);

					if(this_el.parent().parent().parent().hasClass("present"))
					{
						obs="P";
					}
					else
					{
						obs="A";
					}

					var jqXHR=$.get({
						url:HOST+"mark_attendance.php",
						data:{
							"student_ID":$(this).val(),
							"course_ID":course_ID,
							"obs":obs
						}
					});

					jqXHR.done(function(data){
						$.get(HOST+"elements/ajax/att_check.php?course_ID="+course_ID+"&done").done(function(data){
							$(".loading_ajax").addClass("hidden");
						});
					});
				});
			}
		});
	});
}