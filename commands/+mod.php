<?php
	if (checkC("admin", "+mod")) {
		$varsIN[1] = strtolower($varsIN[1]);
		echo "\n=> Added mod: ".$varsIN[1];
		file_put_contents($pathIs.'/mods.txt', $varsIN[1]."\n", FILE_APPEND);
		updateList();
	}
?>
