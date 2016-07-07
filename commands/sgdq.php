<?php
	if (!isset($C_sgdq_t)) {
		$C_sgdq_t = 0;
		$Lastsgdq = null;
	}

	$timeleft = strtotime("3 July 2016 18:30") - strtotime("now");
	$timeleftA = secondsToTimeString($timeleft);

	$C_sgdq_n = time() - $C_sgdq_t;
	if ((checkC("all", "sgdq") || checkC("all", "SGDQ")) && ($C_sgdq_t >= 30 || $Lastsgdq != $MSfrom)) {
		if ($timeleft >= 0) {
			echo "=> !sgdq ".$MSfrom." -> Starts in ".$timeleft." seconds.\n";
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", SGDQ will start in".$timeleftA." PogChamp\n");
			$Lastsgdq = $MSfrom;
			$C_sgdq_t = time();
		} else {
			$curGame = checkCurrentGame("gamesdonequick");
			echo "=> !sgdq ".$MSfrom." -> LIVE with ".$curGame."!\n";
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", SGDQ is live with ".$curGame." PogChamp\n");
			$Lastsgdq = $MSfrom;
			$C_sgdq_t = time();
		}
	}
?>
