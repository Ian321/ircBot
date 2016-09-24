<?php
	function checkC ($who, $command) {
		global $admin;
		global $mods;
		global $C_User;
		global $C_Message;
		global $triggerD;
		global $triggerE;
		if (isset($triggerE[$command]) && !empty($triggerE[$command])) {
			$trigger = $triggerE[$command];
		} else {
			$trigger = $triggerD;
		}
		switch($who) {
			case "all":
				if (explode(" ", trim($C_Message))[0] == $trigger.$command) {
					return true;
				}
			case "mods":
				foreach ($mods as $mod) {
					if (explode(" ", trim($C_Message))[0] == $trigger.$command && strtolower($C_User) == strtolower($mod)) {
						return true;
					}
				}
			case "admin":
				if (explode(" ", trim($C_Message))[0] == $trigger.$command && strtolower($C_User) == strtolower($admin)) {
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
		$time = " ";

		if ($hours >= 2) {
			$time .= $hours." hours";
		} elseif ($hours >= 1) {
			$time .= $hours." hour";
		}
		if ($hours >= 1 && $mins >= 1 && $secs >= 1) {
			$time .= ", ";
		} elseif ($hours >= 1 && ($mins >= 1 || $secs >= 1)) {
			$time .= " and ";
		}
		if ($mins >= 2) {
			$time .= $mins." minutes";
		} elseif ($mins >= 1) {
			$time .= $mins." minute";
		}
		if ($mins >= 1 && $secs >= 1) {
			$time .= " and ";
		}
		if ($secs >= 2) {
			$time .= $secs." seconds";
		} elseif ($secs >= 1) {
			$time .= $secs." second";
		}
		return $time;
	}
	function checkIfMod ($channel, $nick) {
		$cAPI = ltrim($channel, '#');
		$cAPIChat = json_decode(@file_get_contents("http://tmi.twitch.tv/group/user/".$cAPI."/chatters"));
		if (isset($cAPIChat) && !empty($cAPIChat)) {
			$modInChat = $cAPIChat->chatters->moderators;
			foreach ($modInChat as $modInChat) {
				if ($modInChat == $nick) {
					return true;
					break;
				}
			}
		} else {
			echo "\nCouldn't connect to Twitch API!";
		}
		return false;
	}
	function checkCurrentGame ($channel) {
		$cAPIGame = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.$channel));
		$curGame = nl2br($cAPIGame->stream->channel->game);
		return $curGame;
	}
	function updateList (){
		global $coms;
		global $pathIs;
		global $isMod;
		global $mods;
		global $channel;
		global $nick;
		global $isTwitch;
		global $server;
		global $host;
		global $port;
		global $admin;
		global $triggerD;
		global $triggerE;
		global $ghostMode;
		global $channel;
		global $name;
		global $nick;
		global $pass;
		include $pathIs."/config.php";
		if (!file_exists($pathIs."/mods.txt")) {
			touch($pathIs."/mods.txt");
		}
		if (!file_exists($pathIs."/nokill.txt")) {
			touch($pathIs."/nokill.txt");
		}
		echo "\n=> !update -> Done";
		$coms	= glob($pathIs.'/commands/*.{php}', GLOB_BRACE);
		if ($isTwitch) {
			$isMod = checkIfMod($channel, $nick);
		} else {
			$isMod = false;
		}
		$mods 	= file($pathIs.'/mods.txt', FILE_IGNORE_NEW_LINES);
	}
	function isValidName ($ee) {
		if(preg_match('/[^A-Za-z0-9\-_]/', $ee)>0) {
			return false;
		} else {
			return true;
		}
	}
?>
