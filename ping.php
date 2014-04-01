<?
	$host = $_GET['host'];
	$result = shell_exec("ping -c2 $host |grep icmp_req");
	$result = $result != null;

	echo $result;
