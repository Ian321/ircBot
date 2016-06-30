<?php
	if (checkC("admin", "!+banlist")) {
		$varsIN0 = $varsIN[0];
		unset($varsIN[0]);
		$stringB = implode(" ", $varsIN);
		$varsIN[0] = $varsIN0;
		echo "=> Added to blacklist: ".$stringB."\n";
		file_put_contents($pathIs.'/blacklist.txt', $stringB."\n", FILE_APPEND);
		if ($showS) {
			fwrite($sock, "PRIVMSG ".$channel." :Added \"".$stringB."\" to the blacklist.\n");
		};
	}
?>