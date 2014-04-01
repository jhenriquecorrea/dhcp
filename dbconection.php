<?
	function conectiondb(){
		$user = "root";
		$password = "luiz123";
		$dsn = "mysql:dbname=prova;host=localhost";

		return new PDO($dsn, $user, $password);
		
	}


	$conection = conectiondb();


	function criar($host, $address){
		global $conection;
		$result = $conection->prepare("INSERT INTO ping (host, address) VALUES (:host_name, :address)");
		$result->bindValue(":host_name", $host);
		$result->bindValue(":address", $address);
		return $result->execute();
	}

	function deletar($host){
		global $conection;
		$result = $conection->prepare("DELETE FROM ping WHERE host = :host_name");
		$result->bindValue(":host_name", $host);
		return $result->execute();
	}

	function show(){
		global $conection;
		$result = $conection->query("SELECT * FROM ping");
		return $result->fetchAll();
	}

?>