<?php
	if (checkC("admin", "+mod")) {
		$varsIN[1] = strtolower($varsIN[1]);
		echo "=> Added mod: ".$varsIN[1]."\n";
		file_put_contents($pathIs.'/mods.txt', $varsIN[1]."\n", FILE_APPEND);
		updateList();
		if ($showS) {
			fwrite($sock, "PRIVMSG ".$channel." :Added ".$varsIN[1]." to the list of mods.\n");
		};
	}
?>
