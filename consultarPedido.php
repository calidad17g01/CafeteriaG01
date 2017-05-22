<!DOCTYPE html>
<html>
	<script type="text/javascript">
	
	window.onload = temporizador; 
	
	function temporizador() {
		cargarLista();
		setInterval(cargarLista, 10000);
	}
	
	function cargarLista() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				 document.getElementById("tabla").style.display = 'inline'; //Pone visible el div
				 document.getElementById("tabla").innerHTML = xhttp.responseText; //Muestra el resultado de la busqueda
			}
		};
		xhttp.open("GET", "buscarPedidos.php", true);
		xhttp.send("");
	}
	</script>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8"/>
		<title>Pedido Realizado</title>
		<link rel="stylesheet" type="text/css" href="css/estilo_pedido.css"/>
	</head>
	<body>
	    <!-- Barra navegacion superior-->
		<ul class="top">
			<li><img src="images/UniLogo.png" alt="Cafeteria ADE EHU" /></li>
			<li><a href="inicioin.php">Inicio</a></li>
		</ul>
     	
		</br>
		 
	    <div id="fotos">
		    <?php
			    session_start();
				if(!isset($_SESSION['correo'])){
				header("Location:inicio.php");
				}
		    ?>
			 <div id="tabla">
		    
			 </div> 
	    </div> 
		 			 
	</body>
</html>