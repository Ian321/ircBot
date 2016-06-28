<?php
	if (!isset($C_ping_t)) {
		$C_mods_t = 0;
	}
	$C_mods_n = time() - $C_mods_t;
	
	if (checkC("mods", "!mods")) {
		echo "=> MODS (".$C_mods_n.")\n";
		echo var_dump($mods);
		if ($C_mods_n >= 15) {
			fwrite($sock, "PRIVMSG ".$channel." :".$whoSend.", list of ".$nick."'s mods: ".implode(", ", $mods)."\n");
			$C_mods_t = time();
		}
	}
?>