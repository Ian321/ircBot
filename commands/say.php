<?php
	if (checkC("admin", "say")) {
		$tempVar1 = $varsIN[0];
		unset($varsIN[0]);
		$stringA = implode(" ", $varsIN);
		$varsIN[0] = $tempVar1;
		echo "\n=> !say -> ".$stringA;
		fwrite($sock, "PRIVMSG ".$channel." :".$stringA."\n");
	}
?>
