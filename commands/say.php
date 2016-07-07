<?php
	if (checkC("admin", "say")) {
		$varsIN0 = $varsIN[0];
		unset($varsIN[0]);
		$stringA = implode(" ", $varsIN);
		$varsIN[0] = $varsIN0;
		echo "=> !say -> ".$stringA."\n";
		fwrite($sock, "PRIVMSG ".$channel." :".$stringA."\n");
	}
?>
