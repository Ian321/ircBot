<?php
	if (checkC("admin", "+mod")) {
		if (substr($varsIN[1], 0, 1) === '@') {
			$varsIN[1] = ltrim($varsIN[1], '@');
		}
		$varsIN[1] = strtolower($varsIN[1]);
		echo "\n=> Added mod: ".$varsIN[1];
		file_put_contents($pathIs.'/mods.txt', $varsIN[1]."\n", FILE_APPEND);
		updateList();
	}
?>
