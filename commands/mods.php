<?php
	if (strpos($data, $admin."@".$admin.".tmi.twitch.tv PRIVMSG ".$channel.' :!mods') !== false) {
		echo "=> MODS\n"
		echo var_dump($mods);
		if ($showS) {
			fwrite($sock, "PRIVMSG ".$channel." :List of mods: ".implode(", ", $mods)."\n");
		};
	}
?>