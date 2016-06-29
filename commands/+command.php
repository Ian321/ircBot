<?php
	if (checkC("admin", "!+command")) {
		$sendVarX = explode("<br", explode("PRIVMSG ".$channel." :!+command ", $dataE)[1])[0];
		$sendVar1 = explode(", ", $sendVarX)[0];
		$sendVar2 = explode(", ", $sendVarX)[1];
		if (!file_exists($pathIs.'/commands/'.$sendVar1.".php")) {
			$newCF = fopen($pathIs.'/commands/'.$sendVar1.".php", "a+");
			$newCT = '<?php'.PHP_EOL;
			$newCT .='if (!isset($C_'.$sendVar1.'_t)) {'.PHP_EOL;
			$newCT .='$C_'.$sendVar1.'_t = 0;'.PHP_EOL;
			$newCT .='$C_'.$sendVar1.'_a = true;'.PHP_EOL;
			$newCT .='}'.PHP_EOL;
			$newCT .='$C_'.$sendVar1.'_n = time() - $C_'.$sendVar1.'_t;'.PHP_EOL;
			$newCT .=''.PHP_EOL;
			$newCT .='if (checkC("all", "!'.$sendVar1.'")) {'.PHP_EOL;
			$newCT .='echo "=> !'.$sendVar1.' (".$C_'.$sendVar1.'_n.")\n";'.PHP_EOL;
			$newCT .='if ($C_'.$sendVar1.'_a && $C_'.$sendVar1.'_n >= 15) {'.PHP_EOL;
			$newCT .='fwrite($sock, "PRIVMSG ".$channel." :'.$sendVar2.'\n");'.PHP_EOL;
			$newCT .='$C_'.$sendVar1.'_t = time();'.PHP_EOL;
			$newCT .='$C_'.$sendVar1.'_a = false;'.PHP_EOL;
			$newCT .='} elseif($C_'.$sendVar1.'_n >= 15) {'.PHP_EOL;
			$newCT .='fwrite($sock, "PRIVMSG ".$channel." :'.$sendVar2.' &#65279;\n");'.PHP_EOL;
			$newCT .='$C_'.$sendVar1.'_a = true;'.PHP_EOL;
			$newCT .='}'.PHP_EOL;
			$newCT .='}'.PHP_EOL;
			$newCT .='?>'.PHP_EOL;
			fwrite($newCF, $newCT);
			fclose($newCF);
			echo "=> Added command ".$sendVar1."\n";
			if ($showS) {
				fwrite($sock, "PRIVMSG ".$channel." :Added command ".$sendVar1."\n");
			}
		} else {
			echo "=> File ".$sendVar1.".php already exist in /commands/.\n";
			if ($showS) {
				fwrite($sock, "PRIVMSG ".$channel." :Command ".$sendVar1." already exist\n");
			}
		}
	}
?>