<?php
	if (!isset($C_ping_t)) {
		$C_ping_t = 0;
		$C_ping_a = true;
	}
	$C_ping_n = time() - $C_ping_t;
	
	$uptime = time() - $startTime;
	if (strpos($data, $channel.' :!ping') !== false) {
		echo "==> !ping (".$C_ping_n.")\n";
		if ($C_ping_a && $C_ping_n >= 15) {
			fwrite($sock, "PRIVMSG ".$channel." :Uptime is seconds: ".$uptime."\n");
			$C_ping_a = false;
			$C_ping_t = time();
		} elseif ($C_ping_n >= 15) {
			fwrite($sock, "PRIVMSG ".$channel." :Uptime is seconds: ".$uptime."&#160;\n");
			$C_ping_a = true;
			$C_ping_t = time();
		}
	}
?>