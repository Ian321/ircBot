<?php
	if (!isset($C_xd_t)) {
		$C_xd_t = 0;
		$C_xd_a = true;
	}
	$C_xd_n = time() - $C_xd_t;
	
	if (strpos($data, $channel.' :!xD') !== false) {
		echo "==> !xD\n";
		if ($C_xd_a && $C_xd_n >= 15) {
			fwrite($sock, "PRIVMSG ".$channel." :pajaSWA\n");
			$C_ping_a = false;
			$C_ping_t = time();
		} elseif ($C_xd_n >= 15) {
			fwrite($sock, "PRIVMSG ".$channel." :pajaSWA &#160;\n");
			$C_ping_a = true;
			$C_ping_t = time();
		}
	}
?>