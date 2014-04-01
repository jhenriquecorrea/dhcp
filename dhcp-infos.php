
<?
	if($_GET['command'] == "stop") {
		$result = shell_exec("/etc/init.d/isc-dhcp-server stop");
		
		$result = explode(" ", $result);
		$status = "";

		if ($result[1] == "ok") {
			$status = "Servidor Parado!";
		} else {
			$status = "Erro ao parar servidor!";
		}

		echo $status;
	}

	if($_GET['command'] == "start") {
		$result = shell_exec("/etc/init.d/isc-dhcp-server start");
		$result = explode(" ", $result);
		$status = "";

		if ($result[1] == "ok") {
			$status = "Servidor esta rodando!";
		} else {
			$status = "Erro ao iniciar servidor!";
		}

		echo $status;	
	}


