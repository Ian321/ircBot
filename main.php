<?php
	error_reporting(E_ALL & ~E_NOTICE);
	set_time_limit(0);
	ini_set('display_errors', 'on');

	$pathIs = realpath(dirname(__FILE__));
	$mods 	= file($pathIs.'/mods.txt', FILE_IGNORE_NEW_LINES);
	$coms	= glob($pathIs.'/commands/*.{php}', GLOB_BRACE);
	$connected = 0;
	include $pathIs."/config.php";

	$sock = fsockopen($server, $port, $errno, $errstr, 30);
	if (!$sock) {
		printf("errno: %s, errstr: %s", $errno, $errstr);
	} else {
		echo "\nSuccessful Connection.\n";
		echo "Included:\n";
		echo var_dump($coms);
	}
	if($sock) {
		fwrite($sock, "PASS ".$pass."\n");
		fwrite($sock, "USER ".$name."\n");
		fwrite($sock, "NICK ".$nick."\n");
		sleep(1);
		fwrite($sock, "JOIN ".$channel."\n");
		sleep(1);
		if ($showS) {
			fwrite($sock, "PRIVMSG ".$channel." :Up and running pajaHop\n");
		}
		echo "=> RUNNING\n";
		$startTime = time();
		while(true) {
			$timeoutA = 0;
			while($data = fgets($sock, 128)) {
				// Update mod list
				$mods 	= file($pathIs.'/mods.txt', FILE_IGNORE_NEW_LINES);
				
				// Commands
				foreach($coms as $file) {
					include $file;
				}
				$chatO = explode(".tmi.twitch.tv PRIVMSG ".$channel." :", $data);
				$chatU = explode("@", $chatO[0])[1];
				$chatM = $chatO[1];
				if ($connected >= 10) {
					echo $chatU.": ".$chatM;
				} else {
					echo $data;
					$connected++;
				}

				flush();

				// Separate all data
				$exData = explode(' ', $data);

				// Send PONG back to the server
				if($exData[0] == "PING") {
					fwrite($sock, "PONG ".$exData[1]."\n");
				}
			}
		}
	} else {
		echo $eS . ": " . $eN;
	}
?>
