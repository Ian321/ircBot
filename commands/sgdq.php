<?php
	if (!isset($C_sgdq_t)) {
		$C_sgdq_t = 0;
		$Lastsgdq = null;
	}

	$timeleft = strtotime("3 July 2016 18:30") - strtotime("now");
	$hours = floor($timeleft / 3600);
	$mins = floor($timeleft / 60 % 60);
	$secs = floor($timeleft % 60);
	$timeleftA = " ";

	if ($hours >= 2) {
		$timeleftA .= $hours." hours";
	} elseif ($hours >= 1) {
		$timeleftA .= $hours." hour";
	}
	if ($hours >= 1 && $mins >= 1 && $secs >= 1) {
		$timeleftA .= ", ";
	} elseif ($hours >= 1 && ($mins >= 1 || $secs >= 1)) {
		$timeleftA .= " and ";
	} elseif ($hours >= 1) {
		$timeleftA .= ".";
	}
	if ($mins >= 2) {
		$timeleftA .= $mins." minutes";
	} elseif ($mins >= 1) {
		$timeleftA .= $mins." minute";
	}
	if ($mins >= 1 && $secs >= 1) {
		$timeleftA .= " and ";
	} elseif ($mins >= 1) {
		$timeleftA .= ".";
	}
	if ($secs >= 2) {
		$timeleftA .= $secs." seconds.";
	} elseif ($secs >= 1) {
		$timeleftA .= $secs." second.";
	}

	$C_sgdq_n = time() - $C_sgdq_t;
	if ((checkC("all", "!sgdq") || checkC("all", "!SGDQ")) && ($C_sgdq_t >= 30 || $Lastsgdq != $MSfrom)) {
		if ($timeleft >= 0) {
			echo "=> !sgdq ".$MSfrom." -> Starts in ".$timeleft." seconds.\n";
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", SGDQ will start in".$timeleftA." PogChamp\n");
			$Lastsgdq = $MSfrom;
			$C_sgdq_t = time();
		} else {
			$cAPIGame = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/gamesdonequick'));
			$curGame = nl2br($cAPIGame->stream->channel->game);
			echo "=> !sgdq ".$MSfrom." -> LIVE with ".$curGame."!\n";
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", SGDQ is live with ".$curGame." PogChamp\n");
			$Lastsgdq = $MSfrom;
			$C_sgdq_t = time();
		}
	}
?>
