<?php
	function checkC($who, $command) {
		/*
			Use : if(checkC("all", "!xD")){ }
		*/
		global $dataE;
		global $admin;
		global $mods;
		global $host;
		global $MSfrom;
		global $channel;
		switch($who) {
			case "all":
				if (strpos($dataE, $channel.' :'.$command.'<br />') !== false || strpos($dataE, $channel.' :'.$command.' ') !== false) {
					return true;
				}
			case "mods":
				foreach ($mods as $mod) {
					if (strpos($dataE, $mod."@".$mod.".".$host." PRIVMSG ".$channel.' :'.$command.'<br />') !== false || strpos($dataE, $mod."@".$mod.".".$host." PRIVMSG ".$channel.' :'.$command.' ') !== false) {
						return true;
					}
				}
			case "admin":
				if (strpos($dataE, $admin."@".$admin.".".$host." PRIVMSG ".$channel.' :'.$command.'<br />') !== false || strpos($dataE, $admin."@".$admin.".".$host." PRIVMSG ".$channel.' :'.$command.' ') !== false) {
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
?>
