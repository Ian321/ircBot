<?php
	if (checkC("admin", "!+banlist")) {
		unset($varsIN[0]);
		$stringB = implode(" ", $varsIN);
		$varsIN[0] = $MSfrom;
		echo "=> Added to blacklist: ".$stringB."\n";
		file_put_contents($pathIs.'/blacklist.txt', $stringB."\n", FILE_APPEND);
		if ($showS) {
			fwrite($sock, "PRIVMSG ".$channel." :Added \"".$stringB."\" to the blacklist.\n");
		};
	}
?>