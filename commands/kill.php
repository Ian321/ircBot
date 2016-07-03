<?php
	if (!isset($C_kill_t)) {
		$C_kill_t = 0;
		$killed = array();
		$lastKill = null;
	}

	$nokill = file($pathIs."/nokill.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

	$C_kill_n = time() - $C_kill_t;
	if (checkC("all", "!kill") && $lastKill != $MSfrom."-".$varsIN[1]) {
		if ($varsIN[1] == "list") {
			echo "=> List of dead people:\n";
			echo var_dump($killed);
			fwrite($sock, "PRIVMSG ".$channel." :.w ".$MSfrom." Dead people: ".implode(", ", $killed)."\n");
		} elseif ($varsIN[1] == "clear" && checkC("admin", "!kill")) {
			$killed = array();
			echo "=> !kill -> clear \n";
			if ($showS) {
				fwrite($sock, "PRIVMSG ".$channel." :Cleared the list.\n");
			}
		} elseif ($varsIN[1] == "clear") {
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", you can't clear the list OMGScoots\n");
		} elseif (strpos($varsIN[1], '.') !== false) {
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", you can't kill links OMGScoots\n");
		} elseif (strlen($varsIN[1]) > 25) {
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", this string is too long OMGScoots\n");
		} elseif (in_array(strtolower($varsIN[1]), $nokill)) {
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", you can't kill a god pajaDank\n");
		} else {
			echo "=> !kill ".$MSfrom." -> ".$varsIN[1]." (".$C_kill_n.")\n";
			if (!in_array(strtolower($MSfrom), $killed)) {
				if ($C_xd_n >= 15 && !in_array(strtolower($varsIN[1]), $killed)) {
					if ($varsIN[1] == $MSfrom) {
						fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", killed himself FeelsBadMan\n");
					} else {
						fwrite($sock, "PRIVMSG ".$channel." :pajaDank ︻╦╤─ ".$varsIN[1]."\n");
					}
					array_push($killed, strtolower($varsIN[1]));
					if ($isMod) {
						fwrite($sock, "PRIVMSG ".$channel." :.timeout ".$varsIN[1]." 3\n");
					}
					$C_kill_t = time();
				} else {
					fwrite($sock, "PRIVMSG ".$channel." :&#65279; ".$varsIN[1]." is already dead.\n");
				}
			} else {
				if ($varsIN[1] == $MSfrom) {
					fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", you are already dead FeelsBadMan\n");
				} else {
					fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", dead people can't kill others OMGScoots\n");
				}
			}
		}
		$lastKill = $MSfrom."-".$varsIN[1];
	}
	if (checkC("all", "!kys")) {
		if (!in_array(strtolower($MSfrom), $killed)) {
			array_push($killed, strtolower($MSfrom));
			if ($isMod) {
				fwrite($sock, "PRIVMSG ".$channel." :.timeout ".$MSfrom." 3\n");
			}
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", killed himself FeelsBadMan\n");
		} else {
			fwrite($sock, "PRIVMSG ".$channel." :".$MSfrom.", you are already dead FeelsBadMan\n");
		}
	}
?>
