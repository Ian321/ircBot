<?php
	if (!isset($justREM)) {
		$justREM = false;
	} elseif ($justREM = true) {
		error_reporting(E_ALL & ~E_NOTICE);
	}

	if (checkC("admin", "-command")) {
		if (file_exists($pathIs.'/commands/'.$varsIN[1].".php")) {
			rename($pathIs.'/commands/'.$varsIN[1].".php", $pathIs.'/commands/bin/'.$varsIN[1].".php");
			echo "\n=> Moved ".$varsIN[1]." into the bin";
			updateList();
			error_reporting(0);
			$justREM = true;
		} else {
			echo "\n=> File ".$varsIN[1].".php does not exist in /commands/";
		}
	}
?>
