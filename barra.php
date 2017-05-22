<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
			    session_start();
				if($_SESSION['correo'] != 'barra@cafeadeehu.es'){
				header("Location:inicio.php");
				}
?>
	<head>
		<title>Bienvenido</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/estilo_login.css" />
	</head>
	<body>
		<!-- Barra navegacion superior-->
		<ul class="top">
		  <li><img src="images/UniLogo.png" alt="Logo de la cafetería de ADE de la UPV/EHU" /></li>
		  <li><a href="logout.php">Logout</a></li>
		</ul>

		<!-- Formulario para login-->
		<form method="post" action="inicio.php" onsubmit="return validarCamposLogin();" >
			<div>
				<h1> Bienvenido <?php echo $_SESSION['correo'];?></h1>
				<input type="button" style="font-size: 18px;padding: 10px 20px;border-radius: 8px" value="Visualizar Pedidos" onclick="window.location.href='visualizarPedido.php';"/>
				<br/><br/>
				<input type="button" style="font-size: 18px;padding: 10px 20px;border-radius: 8px" value="Cambiar Disponibilidad" onclick="window.location.href='cambiarDisponibilidad.php';"/>
			</div>
		</form>	
	</body>

</html>


