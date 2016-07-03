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
?>
