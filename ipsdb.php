<?
	function conectiondb(){
		$user = "root";
		$password = "luiz123";
		$dsn = "mysql:dbname=dhcp;host=localhost";
		return new PDO($dsn, $user, $password);	
	}

	$conection = conectiondb();

	function criar($ip, $mac, $data){
		global $conection;
		$result = $conection->prepare("INSERT INTO ips (ip, mac, data) VALUES (:ip, :mac, :data)");
		$result->bindValue(":ip", $ip);
		$result->bindValue(":mac", $mac);
		$result->bindValue(":data", $data);
		return $result->execute();
	}

	function deletar($host){
		global $conection;
		$result = $conection->prepare("DELETE FROM ips WHERE host = :host_name");
		$result->bindValue(":host_name", $host);
		return $result->execute();
	}

	function show(){
		global $conection;
		$result = $conection->query("SELECT * FROM ips");
		return $result->fetchAll();
	}

?>