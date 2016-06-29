<?php
	function checkC($who, $command) {
		/*
			Use : if(checkC("all", "!xD")){ }
		*/
		global $dataE;
		global $admin;
		global $mods;
		global $whoSend;
		global $channel;
		switch($who) {
			case "all":
				if (strpos($dataE, $channel.' :'.$command.'<br />') !== false || strpos($dataE, $channel.' :'.$command.' ') !== false) {
					return true;
				}
			case "mods":
				if (strpos($dataE, $channel.' :'.$command.'<br />') !== false || strpos($dataE, $channel.' :'.$command.' ') !== false) {
					return true;
				}
			case "admin":
				if (strpos($dataE, $admin."@".$admin.".tmi.twitch.tv PRIVMSG ".$channel.' :'.$command.'<br />') !== false || strpos($dataE, $admin."@".$admin.".tmi.twitch.tv PRIVMSG ".$channel.' :'.$command.' ') !== false) {
					return true;
				}
			case "none":
				return false;
				break;
		}
	}
?>