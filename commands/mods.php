<?php
	if (!isset($C_ping_t)) {
		$C_mods_t = 0;
		$C_mods_a = true;
	}
	$C_mods_n = time() - $C_mods_t;
	
	if (checkC("mods", "!mods")) {
		echo "=> MODS (".$C_mods_n.")\n";
		if ($C_mods_a && $C_mods_n >= 15) {
			echo var_dump($mods);
			fwrite($sock, "PRIVMSG ".$channel." :List of ".$nick."'s mods: ".implode(", ", $mods)."\n");
			$C_mods_a = false;
			$C_mods_t = time();
		} elseif ($C_mods_n >= 15) {
			echo var_dump($mods);
			fwrite($sock, "PRIVMSG ".$channel." :List of ".$nick."'s mods: ".implode(", ", $mods)."&#160;\n");
			$C_mods_a = true;
			$C_mods_t = time();
		}
	}
?>