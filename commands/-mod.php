<?php
	if (checkC("admin", "!-mod")) {
		$varsIN[1] = strtolower($varsIN[1]);
		echo "=> Removed mod: ".$varsIN[1]."\n";
		if(($key = array_search($varsIN[1], $mods)) !== false) {
			unset($mods[$key]);
		}
		file_put_contents($pathIs.'/mods.txt', implode("\n", $mods)."\n");
		if ($showS) {
			fwrite($sock, "PRIVMSG ".$channel." :Removed ".$varsIN[1]." to the list of mods.\n");
		}
	}
?>