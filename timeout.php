<?php
	if ($isMod) {
		$dataL = strtolower($dataE);
		foreach ($blacklist as $ban) {
			if (strpos($dataL, $ban)) {
				echo "=> Timed ".$whoSend." out.\n";
				fwrite($sock, "PRIVMSG ".$channel." :.timeout ".$whoSend." 3\n");
			}
		}
	}
?>