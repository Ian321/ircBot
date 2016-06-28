<?php
	if (!isset($C_ping_t)) {
		$C_ping_t = 0;
	}
	$C_ping_n = time() - $C_ping_t;
	
	$uptime = time() - $startTime;
	if (checkC("all", "!ping")) {
		echo "==> !ping :".$uptime." (".$C_ping_n.")\n";
		if ($C_ping_n >= 15) {
			fwrite($sock, "PRIVMSG ".$channel." :Uptime is seconds: ".$uptime."\n");
			$C_ping_t = time();
		}
	}
?>