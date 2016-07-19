<?php
	if (!isset($C_chat_t)) {
		$C_chat_t = 0;
	}
	$C_chat_n = time() - $C_chat_t;

	if (checkC("all", "chat")) {
    if (!isset($varsIN[1]) || empty($varsIN[1])) {
      $varsIN[1] = ltrim($channel, '#');
    }
		echo "\n=> chat (".$C_chat_n.")";
		if ($C_chat_n >= 15) {
			fwrite($sock, "PRIVMSG ".$channel." :.w ".$C_User." http://tmi.twitch.tv/group/user/".$varsIN[1]."/chatters \n");
			$C_chat_t = time();
		}
	}
?>
