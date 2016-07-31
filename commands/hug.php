<?php
	if (!isset($C_hug_t)) {
		$C_hug_t = 0;
		$LastHug = null;
	}

	$C_hug_n = time() - $C_hug_t;
	if (checkC("all", "hug") && ($C_hug_n >= 15 || $LastHug != $C_User."-".$varsIN[1])) {
		if (substr($varsIN[1], 0, 1) === '@') {
			$varsIN[1] = ltrim($varsIN[1], '@');
		}
		if (strpos($varsIN[1], '.') !== false) {
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", you can't hug links OMGScoots\n");
		} elseif (strlen($varsIN[1]) > 25) {
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", this string is too long OMGScoots\n");
		} elseif (! checkArabic($varsIN[1])) {
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", no Arabic ANELE\n");
		} elseif ($varsIN[1] == $C_User) {
			echo "\n=> !hug ".$C_User." -> ".$varsIN[1];
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User." hugs themself FeelsBadMan\n");
			$LastHug = $C_User."-".$varsIN[1];
			$C_hug_t = time();
		} else {
			echo "\n=> !hug ".$C_User." -> ".$varsIN[1];
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User." hugs ".$varsIN[1]." <3 VoHiYo\n");
			$LastHug = $C_User."-".$varsIN[1];
			$C_hug_t = time();
		}

	}
?>
