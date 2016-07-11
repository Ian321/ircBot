<?php
	if (checkC("admin", "-mod")) {
		$varsIN[1] = strtolower($varsIN[1]);
		echo "\n=> Removed mod: ".$varsIN[1];
		if(($key = array_search($varsIN[1], $mods)) !== false) {
			unset($mods[$key]);
		}
		file_put_contents($pathIs.'/mods.txt', implode("\n", $mods)."\n");
		updateList();
	}
?>
