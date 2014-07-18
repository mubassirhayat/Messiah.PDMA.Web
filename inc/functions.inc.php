<?php
	ob_start();
	//PHP Functions are here
	function get_current_url(){
		//Through this function we can get the current url of our webpage
		$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	
	function mysql_prep($value) {
		// Function for skiping slashes
		$magic_quotes_active = get_magic_quotes_gpc();
		$php_version = function_exists("mysql_real_escape_string");
		
		if ($php_version) {
			if ($magic_quotes_active) {
				$value = stripslashes($value);
			}
			$value = mysql_real_escape_string($value);
		}
		else {
			if (!$magic_quotes_active) {
				$value = addslashes($value);
			}
		}
		return $value;
	}
	
	function redirect_to( $location = NULL ) {
		// Function to redirect to other pages
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}
	
	function check_query($result_set) {
		// Function for checking wether the query is correct or not!!!
		if (!$result_set) {
			die("Database Query Failed: " . mysql_error());
		}
	}
	
	function edit_and_delete_operations($urlVal){
		$query = "SELECT * FROM tbl_ope";
		$operation = mysql_query($query); 
		check_query($operation);
		while ($sel_ope = mysql_fetch_array($operation)) {
			if ($sel_ope['ope_id'] == 3) {
				echo "<a href=\"cnt.php?grp=". urlencode($_GET['grp']) . "&table=". urlencode($_GET['table']) . "&ope=" . urlencode($sel_ope['ope_id']) . "&data=" . urlencode($urlVal) . "\">" . $sel_ope['ope_name'] . "</a> | ";
			}
			else if ($sel_ope['ope_id'] == 4) {
				echo "<a onclick=\"return confirm('Are you Sure?');\" href=\"cnt.php?grp=". urlencode($_GET['grp']) . "&table=". urlencode($_GET['table']) . "&ope=" . urlencode($sel_ope['ope_id']) . "&data=" . urlencode($urlVal) . "\">" . $sel_ope['ope_name'] . "</a><br />";
			}
		}
	}
	
	
?>