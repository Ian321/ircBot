<?php
	if (!isset($C_php_t)) {
		$C_php_t = 0;
		$C_php_a = true;
	}
	$C_php_n = time() - $C_php_t;

	if (checkC("all", "php")) {
		echo "\n=> !php (".$C_php_n.")";
		if ($C_php_a && $C_php_n >= 7) {
			fwrite($sock, "PRIVMSG ".$channel." :I run on php pajaHop\n");
			$C_php_t = time();
			$C_php_a = false;
		} elseif($C_php_n >= 5) {
			fwrite($sock, "PRIVMSG ".$channel." :I run on php pajaHop \n");
			$C_php_a = true;
		}
	}
?>
