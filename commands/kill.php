<?php
	if (!isset($C_kill_t)) {
		$C_kill_t = 0;
		$killed = array();
		$lastKill = null;
	}

	$nokill = file($pathIs."/nokill.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

	$C_kill_n = time() - $C_kill_t;
	if (checkC("all", "kill") && $lastKill != $C_User."-".$varsIN[1]) {
		if (substr($varsIN[1], 0, 1) === '@') {
			$varsIN[1] = ltrim($varsIN[1], '@');
		}
		if ($varsIN[1] == "list") {
			echo "\n=> List of dead people:";
			echo var_dump($killed);
			fwrite($sock, "PRIVMSG ".$channel." :.w ".$C_User." Dead people: ".implode(", ", $killed)."\n");
		} elseif ($varsIN[1] == "clear" && checkC("admin", "kill")) {
			$killed = array();
			echo "\n=> !kill -> clear";
		} elseif ($varsIN[1] == "clear") {
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", you can't clear the list OMGScoots\n");
		} elseif (strpos($varsIN[1], '.') !== false) {
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", you can't kill links OMGScoots\n");
		} elseif (strlen($varsIN[1]) > 25) {
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", this string is too long OMGScoots\n");
		} elseif (in_array(strtolower($varsIN[1]), $nokill)) {
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", you can't kill a god pajaDank\n");
		} elseif (strpos($varsIN[1], '!untuck') !== false) {
		  fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", have fun with the timeout LUL\n");
		} elseif (! isValidName($varsIN[1])) {
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", that is not a valid username OMGScoots\n");
		} elseif (isset($varsIN[1]) && !empty($varsIN[1])) {
			echo "\n=> !kill ".$C_User." -> ".$varsIN[1]." (".$C_kill_n.")";
			if (!in_array(strtolower($C_User), $killed)) {
				if ($C_kill_n >= 7 && !in_array(strtolower($varsIN[1]), $killed)) {
					if (strtolower($varsIN[1]) == strtolower($C_User)) {
						fwrite($sock, "PRIVMSG ".$channel." :".$C_User." killed themselves FeelsBadMan\n");
					} else {
						fwrite($sock, "PRIVMSG ".$channel." :pajaDank ︻╦╤─ ".$varsIN[1]."\n");
					}
					array_push($killed, strtolower($varsIN[1]));
					if ($isMod) {
						fwrite($sock, "PRIVMSG ".$channel." :.timeout ".$varsIN[1]." 3\n");
					}
					$C_kill_t = time();
				} else {
					fwrite($sock, "PRIVMSG ".$channel." :‌‌ ".$varsIN[1]." is already dead.\n");
				}
			} else {
				if (strtolower($varsIN[1]) == strtolower($C_User)) {
					fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", you are already dead FeelsBadMan\n");
				} else {
					fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", dead people can't kill others OMGScoots\n");
				}
			}
		}
		$lastKill = $C_User."-".$varsIN[1];
	}
	if (checkC("all", "kms")) {
		if (!in_array(strtolower($C_User), $killed)) {
			array_push($killed, strtolower($C_User));
			if ($isMod) {
				fwrite($sock, "PRIVMSG ".$channel." :.timeout ".$C_User." 3\n");
			}
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User." killed themselves FeelsBadMan\n");
		} else {
			fwrite($sock, "PRIVMSG ".$channel." :".$C_User.", you are already dead FeelsBadMan\n");
		}
	}
?>
