<?php
	$adminQuit = $admin."@".$admin.".tmi.twitch.tv PRIVMSG ".$channel.' :!quit';
	if (strpos($data, $adminQuit) !== false) {
		echo "=> Quitting\n";
		if ($showS) {
			fwrite($sock, "PRIVMSG ".$channel." :Shutting down pajaHop\n");
		};
		exit(0);
	}
?>