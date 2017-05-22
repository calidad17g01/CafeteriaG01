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
			<li><a href="barra.php">Inicio</a></li>
		</ul>
     	
		</br>
		 
	    <div id="fotos">
		<a href="cambiarDisponibilidad.php"><img class="back" src="images/back.png" style="width: 45px; float: left;"></a>
		    <?php
			    session_start();
				if($_SESSION['correo'] != 'barra@cafeadeehu.es'){
				header("Location:inicio.php");
				}
				$link = mysqli_connect("mysql.hostinger.es", "u962326006_cafe", "cafeteriaadeehu", "u962326006_cafe");
				if(!$link){
				echo 'Fallo al concectar a MySQL:' . $link->connect_error; 
					mysqli_close($link);
				}
				$fin = $_POST["finalizar"];
				$dis = $_POST["disponibilidad"];
				if ($dis == 0){
					$sql="UPDATE Hamburguesas SET Disponibilidad = 1 WHERE Nombre = '$fin'";
					if (!($result=mysqli_query($link ,$sql))){
						echo 'ERROR:' . $link->error; 
						mysqli_close($link);
						exit(1);
					}
					echo '<h2> Disponibilidad de '.$fin.' a disponible </h2>';
				}
				else{
					$sql="UPDATE Hamburguesas SET Disponibilidad = 0 WHERE Nombre = '$fin'";
					if (!($result=mysqli_query($link ,$sql))){
						echo 'ERROR:' . $link->error; 
						mysqli_close($link);
						exit(1);
					}
					echo '<h2> Disponibilidad de '.$fin.' a no disponible </h2>';
				}

				
		    ?>
	    </div> 
		 			 
	</body>
</html>