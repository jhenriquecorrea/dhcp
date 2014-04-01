
<?
	

	$result = shell_exec("/etc/init.d/isc-dhcp-server status");

	$result = explode(" ", $result);
	$status = "";

	if ($result[7] == "not") {
		$status = "Not Running <i class='fa fa-ban fa-2x'></i>";
	} else {
		$status = "Running <i class='fa fa-check-circle fa-2x'></i>";
	}

	echo $status;


