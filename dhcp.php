<?
	require "ipsdb.php";
	require_once "getips.php";
	$hosts = show();
?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>DHCP - Infos</title>
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<link href='http://fonts.googleapis.com/css?family=Denk+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Marcellus+SC' rel='stylesheet' type='text/css'>
	<style>
		body, html {
			height: 100%;
		}
		body {
			padding: 0px;
			margin: 0px;
		}
		header {
			height: 20%;
			min-height: 100px;
			background: #25383c;
			margin-bottom: 2%;
			color: #fff;
			text-align: center;
		}
		header h1 {
			margin: 0px;
			display: inline-block;
			font-family: 'Denk One', sans-serif;
		}
		fieldset {
			display: inline-block;
			float: left;
		}
		#tabela {
			text-align: center;
			margin-top: 0%;
			box-shadow: 3px 3px 10px #000;
			display: inline-block;
		}
		nav, section {
			height: 65%;
		}
		nav {
			width: 20%;
			float: left;
		}
		section {
			float: center;
		}
		td {
			text-align: center;
		}
		legend {
			text-align: center;
			width: 50%;
			border-radius: 5px;
			float: center;
		}
		#atualizacao {
			float: right;
			margin-right: 10px;
		}
		#hosts {
			float: right;
			margin-right: 10px;
		}
		h3, .loading {
			display: inline-block;
			text-align: center;
			font-family: 'Marcellus SC', serif;
			float: right;
			margin-right: 10px;
		}
		button:hover {
			background: #ccc;
		}
		#up {
			color: #0f0;
		}
		#down {
			color: #ff0000;
		}
	</style>
</head>
<body>
	<header>
		<h1>DHCP Monitor </h1>
		<i class='fa fa-desktop fa-5x'></i>
	</header>
	<nav>
		<fieldset>
		<legend>Opções</legend>
		<button class="status-server">Status servidor DHCP</button>
		</fieldset>
	</nav>
	<div id="dialog-modal" title="Status do servidor DHCP"></div>
	<section>
		<fieldset id="tabela">
			<legend><h2>Ips Concedidos</h2></legend>
			<table border="1">
				<tr>
					<th>IP</th>
					<th>MAC</th>
					<th>Data da concessao</th>
					<th>Status</th>
				</tr>
				<?foreach ($hosts as $host) {?>
					<tr>
						<td><?=$host['ip']?></td>
						<td><?=$host['mac']?></td>
						<td><?=$host['data']?></td>
						<td class="status"></td>
					</tr>
				<?}?>
			</table>
		</fieldset>
		<fieldset id="atualizacao">
			<h3>Verificando hosts on: <div id="loading"></div></h3>
		</fieldset>
		<fieldset id="hosts">
			<h3>Verificando novas concessoes: <div id="carregando"></div></h3>
		</fieldset>
	</section>
</body>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
	$('#dialog-modal').hide();
	$('.status-server').click(function(){
		$.get("status.php", function(response){
			$('#dialog-modal').html(response);
			$(function() {
		  	$( "#dialog-modal" ).dialog({
		    	height: 200,
		    	width: 350, 
		    	modal: true,
		    	buttons: {
           			"OK": function() {
   		          $( this ).dialog( "close" );
       			    }
       				}
		  		});
			});	
		});
	});
	function ping(){
		$('table td:nth-child(1)').each(function(){
			var td = $(this);
			$.get("ping.php?host="+$(this).html(), function(data){
				$('#loading').html("Parado");
				var content = "";
				if(data==1){
					content = "<i class='fa fa-arrow-up' id='up'></i>"
				}else {
					content = "<i class='fa fa-arrow-down' id='down'></i>"
				}
				$(td.nextAll('.status')[0]).html(content);
			});
		$('#loading').html("<i class='fa fa-refresh fa-spin'></i>");
		});
		setTimeout(ping, 10000);
	}
	ping();
	function atualizar(){
		$.get("getips.php", function(response){
			$('#carregando').html("Parado");
		});
		$('#carregando').html("<i class='fa fa-refresh fa-spin'></i>");
		setTimeout(atualizar, 10000);
	}
	atualizar();
</script>
</html>
