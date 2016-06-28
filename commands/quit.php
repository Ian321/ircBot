<?php
	if (checkC("admin", "!quit")) {
		echo "=> Quitting\n";
		if ($showS) {
			fwrite($sock, "PRIVMSG ".$channel." :Shutting down pajaHop\n");
		};
		exit(0);
	}
?>