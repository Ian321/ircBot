<?php
	function checkC($who, $command) {
		/*
			Use : if(checkC("all", "xD")){ }
		*/
		global $dataE;
		global $admin;
		global $mods;
		global $host;
		global $MSfrom;
		global $channel;
		global $triggerD;
		global $triggerE;
		if (isset($triggerE[$command]) && !empty($triggerE[$command])) {
			$trigger = $triggerE[$command];
		} else {
			$trigger = $triggerD;
		}
		switch($who) {
			case "all":
				if (strpos($dataE, $channel.' :'.$trigger.$command.'<br />') !== false || strpos($dataE, $channel.' :'.$trigger.$command.' ') !== false) {
					return true;
				}
			case "mods":
				foreach ($mods as $mod) {
					if (strpos($dataE, $mod."@".$mod.".".$host." PRIVMSG ".$channel.' :'.$trigger.$command.'<br />') !== false || strpos($dataE, $mod."@".$mod.".".$host." PRIVMSG ".$channel.' :'.$trigger.$command.' ') !== false) {
						return true;
					}
				}
			case "admin":
				if (strpos($dataE, $admin."@".$admin.".".$host." PRIVMSG ".$channel.' :'.$trigger.$command.'<br />') !== false || strpos($dataE, $admin."@".$admin.".".$host." PRIVMSG ".$channel.' :'.$trigger.$command.' ') !== false) {
					return true;
				}
			case "none":
				return false;
				break;
		}
	}
	function secondsToTimeString ($sec) {
		$hours = floor($sec / 3600);
		$mins = floor($sec / 60 % 60);
		$secs = floor($sec % 60);
		$timeleftA = " ";

		if ($hours >= 2) {
			$timeleftA .= $hours." hours";
		} elseif ($hours >= 1) {
			$timeleftA .= $hours." hour";
		}
		if ($hours >= 1 && $mins >= 1 && $secs >= 1) {
			$timeleftA .= ", ";
		} elseif ($hours >= 1 && ($mins >= 1 || $secs >= 1)) {
			$timeleftA .= " and ";
		}
		if ($mins >= 2) {
			$timeleftA .= $mins." minutes";
		} elseif ($mins >= 1) {
			$timeleftA .= $mins." minute";
		}
		if ($mins >= 1 && $secs >= 1) {
			$timeleftA .= " and ";
		}
		if ($secs >= 2) {
			$timeleftA .= $secs." seconds";
		} elseif ($secs >= 1) {
			$timeleftA .= $secs." second";
		}
		return $timeleftA;
	}
	function checkIfMod($channel, $nick) {
		# Check if bot is mod in chat
		$cAPI = ltrim($channel, '#');
		$cAPIChat = json_decode(file_get_contents("http://tmi.twitch.tv/group/user/".$cAPI."/chatters"));
		$modInChat = $cAPIChat->chatters->moderators;
		foreach ($modInChat as $modInChat) {
			if ($modInChat == $nick) {
				return true;
				break;
			}
		return false;
		}
	}
	function checkCurrentGame($channel) {
		$cAPIGame = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.$channel));
		$curGame = nl2br($cAPIGame->stream->channel->game);
		return $curGame;
	}
	function updateList(){
    global $coms;
    global $pathIs;
    global $isMod;
    global $mods;
    global $channel;
    global $nick;
    global $blacklist;
		echo "=> !update -> Done\n";
		$coms	= glob($pathIs.'/commands/*.{php}', GLOB_BRACE);
		$isMod = checkIfMod($channel, $nick);
		$mods 	= file($pathIs.'/mods.txt', FILE_IGNORE_NEW_LINES);
		$blacklist= file($pathIs.'/blacklist.txt', FILE_IGNORE_NEW_LINES);
	}
?>
