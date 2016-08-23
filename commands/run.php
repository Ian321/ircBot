<?php
	# Only use if you know what you are doing ;p
	if (checkC("admin", "run")) {
		$tempVar1 = $varsIN[0];
		unset($varsIN[0]);
		$stringA = implode(" ", $varsIN);
		$varsIN[0] = $tempVar1;
		echo "\n=> !run -> ".$stringA;
		if (substr($stringA, -1) != ";") {
			$str = "Missing ; at the end.";
		} else {
			ob_start();
			eval("$stringA");
			$str = ob_get_clean();
		}
		fwrite($sock, "PRIVMSG ".$channel." :".$str."\n");
	}
?>

