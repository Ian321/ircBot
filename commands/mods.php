<?php
	if (!isset($C_mods_t)) {
		$C_mods_t = 0;
	}
	$C_mods_n = time() - $C_mods_t;

	if (checkC("all", "mods")) {
		echo "\n=> MODS (".$C_mods_n.")";
		if ($C_mods_n >= 7) {
			echo var_dump($mods);
			fwrite($sock, "PRIVMSG ".$channel." :.w ".$C_User." List of ".$nick."'s mods: ".implode(", ", $mods)."\n");
			$C_mods_t = time();
		}
	}
?>
