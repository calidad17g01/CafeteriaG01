<!DOCTYPE html>
<html>

	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8"/>
		<title>Pedido Finalizado</title>
		<link rel="stylesheet" type="text/css" href="css/estilo_pedido.css"/>
	</head>
	<body>
	    <!-- Barra navegacion superior-->
		<ul class="top">
			<li><img src="images/UniLogo.png" alt="Cafeteria ADE EHU" /></li>
			<li><a href="cocina.php">Inicio</a></li>
		</ul>
     	
		</br>
		 
	    <div id="fotos">
		    <?php
			    session_start();
				if($_SESSION['correo'] != 'cocinero@cafeadeehu.es'){
				header("Location:inicio.php");
				}
				$link = mysqli_connect("mysql.hostinger.es", "u962326006_cafe", "cafeteriaadeehu", "u962326006_cafe");
				if(!$link){
				echo 'Fallo al concectar a MySQL:' . $link->connect_error; 
					mysqli_close($link);
				}
				$codigo = $_POST["finalizar"];
				$sql="UPDATE PedidoUsuario SET Estado = 'Finalizado' WHERE codigo = '$codigo'";
				if (!($result=mysqli_query($link ,$sql))){
					echo 'ERROR:' . $link->error; 
					mysqli_close($link);
					exit(1);
				}
				
				echo '<h2> Pedido finalizado </h2>';
				echo '<h3> Código:'.$codigo.'</h3>';
				
		    ?>
	    </div> 
		 			 
	</body>
</html>