<?php
	if (!isset($justREM)) {
		$justREM = false;
	} elseif ($justREM = true) {
		error_reporting(E_ALL & ~E_NOTICE);
	}
	
	if (checkC("admin", "!-command")) {
		$sendVar1 = explode("<br", explode("PRIVMSG ".$channel." :!-command ", $dataE)[1])[0];
		if (file_exists($pathIs.'/commands/'.$sendVar1.".php")) {
			rename($pathIs.'/commands/'.$sendVar1.".php", $pathIs.'/commands/bin/'.$sendVar1.".php");
			echo "=> Moved ".$sendVar1." into the bin.\n";
			if ($showS) {
				fwrite($sock, "PRIVMSG ".$channel." :Removed command ".$sendVar1."\n");
			}
			error_reporting(0);
			$justREM = true;
		} else {
			echo "=> File ".$sendVar1.".php does not exist in /commands/.\n";
			if ($showS) {
				fwrite($sock, "PRIVMSG ".$channel." :".$sendVar1." does not exist\n");
			}
		}
	}
?>