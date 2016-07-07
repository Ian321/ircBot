<?php
	if (!isset($C_ping_t)) {
		$C_mods_t = 0;
	}
	$C_mods_n = time() - $C_mods_t;

	if (checkC("all", "mods")) {
		echo "=> MODS (".$C_mods_n.")\n";
		if ($C_mods_n >= 15) {
			echo var_dump($mods);
			fwrite($sock, "PRIVMSG ".$channel." :.w ".$whoSend." List of ".$nick."'s mods: ".implode(", ", $mods)."\n");
			$C_mods_t = time();
		}
	}
?>
