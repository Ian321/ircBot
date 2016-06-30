<?php
	if (!isset($C_kill_t)) {
		$C_hug_t = 0;
		$LastHug = null;
	}
	
	$C_hug_n = time() - $C_hug_t;
	if (checkC("all", "!hug") && ($C_hug_t >= 30 || $LastHug != $MSfrom."-".$varsIN[1])) {
		if (strpos($varsIN[1], '.') !== false) {
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", you can't hug links OMGScoots\n");
		} elseif (strlen($varsIN[1]) > 25) {
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", this string is too long OMGScoots\n");
		} elseif ($varsIN[1] == $MSfrom) {
			echo "=> !hug ".$MSfrom." -> ".$varsIN[1]."\n";
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom." hugs himself FeelsBadMan\n");
		} else {
			echo "=> !hug ".$MSfrom." -> ".$varsIN[1]."\n";
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom." hugs ".$varsIN[1]." <3 VoHiYo\n");
			$LastHug = $MSfrom."-".$varsIN[1];
			$C_hug_t = time();
		}

	}
?>
