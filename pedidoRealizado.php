<!DOCTYPE html>
<html>
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
				$link = mysqli_connect("mysql.hostinger.es", "u962326006_cafe", "cafeteriaadeehu", "u962326006_cafe");
				if(!$link){
				echo 'Fallo al concectar a MySQL:' . $link->connect_error; 
					mysqli_close($link);
				}
				$mail = $_SESSION['correo'];
				/*$comida1 = $_POST["comida1"];
				$comida2 = $_POST["comida2"];
				$comida3 = $_POST["comida3"];
				$comida4 = $_POST["comida4"];
				$comida5 = $_POST["comida5"];
				$comida6 = $_POST["comida6"];
				$comida7 = $_POST["comida7"];
				$comida8 = $_POST["comida8"];
				$comida9 = $_POST["comida9"];
				$comida10 = $_POST["comida10"];*/
				$totalcost = $_POST["Precio"];
				date_default_timezone_set('Europe/Madrid');
				$timezone = date('Y-m-d H:i:s');

				$comidas = array($_POST["comida1"], $_POST["comida2"], $_POST["comida3"], $_POST["comida4"], $_POST["comida5"], $_POST["comida6"], $_POST["comida7"], $_POST["comida8"],$_POST["comida9"], $_POST["comida10"]);	
					
				$codigo= rand(1,600);
				$sql="INSERT INTO PedidoUsuario (codigo,email,PrecioTotal,Fecha,Estado) VALUES ('$codigo','$mail','$totalcost','$timezone','Pedido en proceso')";
				if (!($result=mysqli_query($link ,$sql))){
					echo 'ERROR:' . $link->error; 
					mysqli_close($link);
					exit(1);
				}
				
				foreach ($comidas as $comida) {
					if(strcmp ($comida , "")!=0){
						$sql2="INSERT INTO PedidoComida (codigo,comida) VALUES ('$codigo','$comida')";
						if (!($result=mysqli_query($link ,$sql2))){
							echo 'ERROR:' . $link->error; 
							mysqli_close($link);
							exit(1);
						}
					}
				}
				

				
	
				
				echo '<h2> Código pedido </h2>';
				echo '<p>Para realizar tu pedido a cocina muestra el siguiente código en barra y realiza allí el pago. Podrás seguir el estado de tu pedido desde <a href="consultarPedido.php">Consulta tus pedidos</a>.</p>';
				echo '<h3> Código:'.$codigo.'</h3>';
				echo '<h2> ¡¡ MUCHAS GRACIAS !! </h2>';
				
		    ?>
	    </div> 
		 			 
	</body>
</html>