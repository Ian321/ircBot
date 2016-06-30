<?php
	/*
		List of usable variables:
			$pathIs 	= location of main.php
			$mods 		= array of mods
			$blacklist	= array of blacklisted lines
			$coms		= array of commands
			$admin		= string of admin
			$showS		= show status y/nSuccessful
			$isMod		= is the bot mods
			$channel	= where the bot should be
			
			$MSfrom		= send from
			$varsIN		= array message
	*/
	error_reporting(E_ALL & ~E_NOTICE);
	set_time_limit(0);
	ini_set('display_errors', 'on');

	$pathIs = realpath(dirname(__FILE__));
	$mods 	= file($pathIs.'/mods.txt', FILE_IGNORE_NEW_LINES);
	$blacklist= file($pathIs.'/blacklist.txt', FILE_IGNORE_NEW_LINES);
	$coms	= glob($pathIs.'/commands/*.{php}', GLOB_BRACE);
	include $pathIs."/config.php";
	include $pathIs."/lib.php";

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
				
				// Update lists
				$mods 	= file($pathIs.'/mods.txt', FILE_IGNORE_NEW_LINES);
				$blacklist= file($pathIs.'/blacklist.txt', FILE_IGNORE_NEW_LINES);
				$coms	= glob($pathIs.'/commands/*.{php}', GLOB_BRACE);
				
				// Commands
				$dataE = "<START>".nl2br($data);
				$genVars = explode(".".$host." PRIVMSG ".$channel." :", $dataE);
				$MSfrom = explode("@", explode("<br />", $genVars[0])[0])[1];
				$varsIN = explode(" ", explode($MSfrom.".".$host." PRIVMSG ".$channel." :", explode("<br />", $genVars[1])[0])[0]);
				foreach($coms as $file) {
					include $file;
				}

				echo $data;
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