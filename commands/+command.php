<?php
	if (checkC("admin", "+command")) {
		$varsIN0 = $varsIN[0];
		$varsIN1 = $varsIN[1];
		unset($varsIN[0]);
		unset($varsIN[1]);
		$stringB = implode(" ", $varsIN);
		$varsIN[0] = $varsIN0;
		$varsIN[1] = $varsIN1;
		if (!file_exists($pathIs.'/commands/'.$varsIN[1].".php")) {
			$newCF = fopen($pathIs.'/commands/'.$varsIN[1].".php", "a+");
			$newCT = '<?php'.PHP_EOL;
			$newCT .='if (!isset($C_'.$varsIN[1].'_t)) {'.PHP_EOL;
			$newCT .='$C_'.$varsIN[1].'_t = 0;'.PHP_EOL;
			$newCT .='$C_'.$varsIN[1].'_a = true;'.PHP_EOL;
			$newCT .='}'.PHP_EOL;
			$newCT .='$C_'.$varsIN[1].'_n = time() - $C_'.$varsIN[1].'_t;'.PHP_EOL;
			$newCT .=''.PHP_EOL;
			$newCT .='if (checkC("all", "'.$varsIN[1].'")) {'.PHP_EOL;
			$newCT .='echo "\n=> !'.$varsIN[1].' (".$C_'.$varsIN[1].'_n.")";'.PHP_EOL;
			$newCT .='if ($C_'.$varsIN[1].'_a && $C_'.$varsIN[1].'_n >= 15) {'.PHP_EOL;
			$newCT .='fwrite($sock, "PRIVMSG ".$channel." :'.$stringB.'\n");'.PHP_EOL;
			$newCT .='$C_'.$varsIN[1].'_t = time();'.PHP_EOL;
			$newCT .='$C_'.$varsIN[1].'_a = false;'.PHP_EOL;
			$newCT .='} elseif($C_'.$varsIN[1].'_n >= 15) {'.PHP_EOL;
			$newCT .='fwrite($sock, "PRIVMSG ".$channel." :'.$stringB.' &#65279;\n");'.PHP_EOL;
			$newCT .='$C_'.$varsIN[1].'_a = true;'.PHP_EOL;
			$newCT .='}'.PHP_EOL;
			$newCT .='}'.PHP_EOL;
			$newCT .='?>'.PHP_EOL;
			fwrite($newCF, $newCT);
			fclose($newCF);
			echo "\n=> Added command ".$varsIN[1];
			updateList();
		} else {
			echo "\n=> File ".$varsIN[1].".php already exist in /commands/.";
		}
	}
?>
