<?php
	function check_session($session){
		if($session == 'M'){
			return "<img src='elements/images/sun.png' width='20'></a>";
		}
		elseif ($session == "E") {
			return "<img src='elements/images/moon.png' width='20'></a>";
		}
	}

	function check_dep($dep_ID){
		if($dep_ID == 1){
			return "CE";
		}
		elseif ($dep_ID == 2) {
			return "BIT";
		}
		elseif ($dep_ID == 3) {
			return "BBM";
		}
	}
?>