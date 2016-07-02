<?php
	if (!isset($C_ping_t)) {
		$C_ping_t = 0;
	}
	$C_ping_n = time() - $C_ping_t;
	
	$uptime = time() - $startTime;
	$hours = floor($uptime / 3600);
	$mins = floor($uptime / 60 % 60);
	$secs = floor($uptime % 60);
	$uptimeA = "";
	if ($hours >= 2) {
		$uptimeA .= $hours." hours";
	} elseif ($hours >= 1) {
		$uptimeA .= $hours." hour";
	}
	if ($hours >= 1 && $mins >= 1 && $secs >= 1) {
		$uptimeA .= ", ";
	} elseif ($hours >= 1 && ($mins >= 1 || $secs >= 1)) {
		$uptimeA .= " and ";
	} elseif ($hours >= 1) {
		$uptimeA .= ".";
	}
	if ($mins >= 2) {
		$uptimeA .= $mins." minutes";
	} elseif ($mins >= 1) {
		$uptimeA .= $mins." minute";
	}
	if ($mins >= 1 && $secs >= 1) {
		$uptimeA .= " and ";
	} elseif ($mins >= 1) {
		$uptimeA .= ".";
	}
	if ($secs >= 2) {
		$uptimeA .= $secs." seconds.";
	} elseif ($secs >= 1) {
		$uptimeA .= $secs." second.";
	}

	if (checkC("all", "!ping")) {
		echo "=> !ping :".$uptime." (".$C_ping_n.")\n";
		if ($C_ping_n >= 15) {
			fwrite($sock, "PRIVMSG ".$channel." :running for ".$uptimeA."\n");
			$C_ping_t = time();
		}
	}
?>
