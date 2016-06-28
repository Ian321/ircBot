<?php
	if (checkC("admin", "!+mod")) {
		$sendVar1 = explode("<br", explode("PRIVMSG ".$channel." :!+mod ", $dataE)[1])[0];
		echo "=> Added mod: ".$sendVar1."\n";
		file_put_contents($pathIs.'/mods.txt', $sendVar1."\n", FILE_APPEND);
		if ($showS) {
			fwrite($sock, "PRIVMSG ".$channel." :Added ".$sendVar1." to the list of mods.\n");
		};
	}
?>