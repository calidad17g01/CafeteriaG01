<!DOCTYPE html>
<html>
	<script type="text/javascript">

	function valor(item) {
		var hidden = document.getElementById("envio");
		hidden.value = item.name;
	}
	function buscar(){
		var codigo= document.getElementById("cod");
		var valor = codigo.value;
		if(valor==""){
			alert("Introduce un codigo");
		} else {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					 document.getElementById("tabla").style.display = 'inline'; //Pone visible el div
					 document.getElementById("tabla").innerHTML = xhttp.responseText; //Muestra el resultado de la busqueda
				}
			};
			xhttp.open("GET", "obtenerPedidos.php?codigo="+ valor, true);
			xhttp.send("");
		}
	}

	</script>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8"/>
		<title>Visualizar Pedidos</title>
		<link rel="stylesheet" type="text/css" href="css/estilo_pedido.css"/>
	</head>
	<body>
	    <!-- Barra navegacion superior-->
		<ul class="top">
			<li><img src="images/UniLogo.png" alt="Cafeteria ADE EHU" /></li>
			<li><a href="barra.php">Inicio</a></li>
		</ul>
     	
		</br>
		 
	    <div id="fotos">
		    <form method="post" action="envioCocina.php">
				Codigo: <input type="text" id="cod" value ="">
				<button type="button" name="boton" onClick="buscar()">Buscar</button>
				<div id="tabla">
		    
				</div> 
			</form>
	    </div> 
		 			 
	</body>
</html>