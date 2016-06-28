<?php
	if (checkC("admin", "!-mod")) {
		$sendVar1 = explode("<br", explode("PRIVMSG ".$channel." :!-mod ", $dataE)[1])[0];
		echo "=> Removed mod: ".$sendVar1."\n";
		if(($key = array_search($sendVar1, $mods)) !== false) {
			unset($mods[$key]);
		}
		file_put_contents($pathIs.'/mods.txt', implode("\n", $mods)."\n");
		if ($showS) {
			fwrite($sock, "PRIVMSG ".$channel." :Removed ".$sendVar1." to the list of mods.\n");
		}
	}
?>