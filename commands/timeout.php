<?php
	if ($isMod) {
		$dataL = strtolower($dataE);
		foreach ($blacklist as $ban) {
			if (strpos($dataL, $ban)) {
				echo "=> Timed ".$MSfrom." out.\n";
				fwrite($sock, "PRIVMSG ".$channel." :.timeout ".$MSfrom." 3\n");
			}
		}
	}
?>