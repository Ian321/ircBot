<?php
	if (!isset($C_xd_t)) {
		$C_xd_t = 0;
		$C_xd_a = true;
	}
	$C_xd_n = time() - $C_xd_t;
	
	if (checkC("all", "!xD")) {
		echo "=> !xD (".$C_xd_n.")\n";
		if ($C_xd_a && $C_xd_n >= 15) {
			fwrite($sock, "PRIVMSG ".$channel." :pajaSWA\n");
			$C_xd_a = false;
			$C_xd_t = time();
		} elseif ($C_xd_n >= 15) {
			fwrite($sock, "PRIVMSG ".$channel." :pajaSWA &#160;\n");
			$C_xd_a = true;
			$C_xd_t = time();
		}
	}
?>