<?
require_once "ipsdb.php";
$result = shell_exec("cat /var/lib/dhcp/dhcpd.leases");
$result = explode("\n", $result);

foreach ($result as $line) {
	if(substr_count($line, "lease 10.0") != 0){
		$ip = explode(" ",$line);
		$ip = $ip[1];
	}
	if(substr_count($line, "starts") != 0){
		$data_anterior = explode(" ",$line);
		$data_anterior = explode("/", $data_anterior[4]);
		$data = $data_anterior[2]."/".$data_anterior[1]."/".$data_anterior[0];
	}
	if(substr_count($line, "hardware") != 0){
		$mac = explode(" ",$line);
		$mac = str_replace(";", "", $mac[4]);
	}
	if (!empty($ip)) {
		criar($ip, $mac, $data);
	}
}
