<?php
	if (checkC("admin", "say")) {
		$tempVar0 = explode(" ", $C_Message);
		$tempVar1 = $C_Message[0];
		unset($tempVar0[0]);
		$stringA = implode(" ", $tempVar0);
		echo "\n=> !say -> ".$stringA;
		fwrite($sock, "PRIVMSG ".$channel." :".$stringA."\n");
	}
?>
