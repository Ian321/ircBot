<?php
	set_time_limit(0);
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	$pathIs = realpath(dirname(__FILE__));
	$channel= '#'.$argv[1];
	include $pathIs."/config.php";
	if ($server != 'irc.twitch.tv') {
		$isTwitch = false;
	} else {
		$isTwitch = true;
	}
	include $pathIs."/lib.php";
	updateList();

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
		echo "=> RUNNING\n";
		$startTime = time();
		while($sock == true) {
			$tick = 1;
			while(($data = fgets($sock, 128)) && $sock == true) {
				// Separate all data
				$exData = explode(' ', $data);
				$dataE = trim(preg_replace('/\s+/', ' ', $data));
				if ((strpos($dataE, ':'.$host) !== false || strpos($dataE, '.'.$host) !== false) && strpos($dataE, $nick.".".$host) !== false) {
					echo "\n".$dataE;
				} elseif (!strpos($dataE, $host.' PRIVMSG '.$channel.' :') !== false && $exData[0] != "PING") {
					file_put_contents($pathIs."/".$channel.".txt", $dataE, FILE_APPEND);
					echo $dataE;
				} elseif ($exData[0] != "PING") {
					$C_User = explode("@", explode(".".$host." PRIVMSG ".$channel." :", $dataE)[0])[1];
					$C_Message =  explode(".".$host." PRIVMSG ".$channel." :", $dataE)[1];
					$varsIN = explode(" ", $C_Message);

					#
					if (checkC("admin", "update") || $tick % 60 == 0) {
								updateList();
					}
					if (!($ghostMode)) {
						foreach ($coms as $com) {
							include $com;
						}
					}
					#

					if (file_exists($pathIs."/".$channel.".txt")) {
						file_put_contents($pathIs."/".$channel.".txt", "\n".$C_User.": ".$C_Message, FILE_APPEND);
					} else {
						file_put_contents($pathIs."/".$channel.".txt", $C_User.": ".$C_Message, FILE_APPEND);
					}
					echo "\n".$C_User.": ".$C_Message;
				}
				flush();

				// Send PONG back to the server
				if($exData[0] == "PING") {
					fwrite($sock, "PONG ".$exData[1]."\n");
				}
				$tick++;
			}
		}
		echo "\nError socket no longer open!";
	} else {
		echo $eS . ": " . $eN;
	}
?>
