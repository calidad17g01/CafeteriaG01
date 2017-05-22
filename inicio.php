<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Login</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/estilo_login.css" />
		<script type="text/javascript" src="js/validaciones_login.js" ></script>
	</head>
	<body>
		<!-- Barra navegacion superior-->
		<ul class="top">
		  <li><img src="images/UniLogo.png" alt="Logo de la cafetería de ADE de la UPV/EHU" /></li>
		  <li><a href="registro.html">Registrarse</a></li>
		  <li><a href="inicio.php">Inicio</a></li>
		</ul>

		<!-- Formulario para login-->
		<form method="post" action="inicio.php" onsubmit="return validarCamposLogin();" >
			<div>
				<h1> Login </h1>
				<span>Correo electrónico: </span>
				<input type="text" name="correo" id="correo" />
				<br/>
				<span>Contraseña: </span>
				<input type="password" name="password" id="password" />
				<br/>
				<input type="submit" name="submit" id="submit" value="Entrar" />
			</div>
		</form>	
	</body>
</html>

<?php
	if(isset($_POST['correo'])){
		#Conexión con la BD
		$link = mysqli_connect("mysql.hostinger.es", "u962326006_cafe", "cafeteriaadeehu", "u962326006_cafe");
		if(!$link){
			echo "<script type=\"text/javascript\">alert(\"Error en el proceso de login(abrir conexion con la BD)\");</script>";
			mysqli_close($link);
			exit(1);
		}
		
		# VALIDACIONES DE LOS DATOS 

	
		#Correo
		if(strcmp($_POST['correo'],"")==0){
			echo "<script>alert('Completa el campo Email')</script>";
			exit(1);
		}
		
		#Password
		if(strcmp($_POST['password'],"")==0){
			echo "<script>alert('Completa el campo Password')</script>";
			exit(1);
		}
		
		$correo=$_POST['correo'];
		$password=$_POST['password'];
	
		$sql="SELECT * FROM Usuario where Correo='$correo' and Password='$password'";
		if (!($result=mysqli_query($link ,$sql))){
			echo "<script>alert('Se ha producido un error desconocido. Intentalo de nuevo')</script>";
			mysqli_close($link);
			exit(1);
		}
		$cont= mysqli_num_rows($result);
		
		if($cont==1){
			$columna= mysqli_fetch_array($result);
			session_start();
			$_SESSION["correo"]=$correo;
			if(strcmp($correo,"barra@cafeadeehu.es")==0){
				$_SESSION["id"]='barra';
				header('location:barra.php');
			} else if(strcmp($correo,"cocinero@cafeadeehu.es")==0){
				$_SESSION["id"]='cocinero';
			header('location:cocina.php');
			}else{
				header('location:inicioin.php');
			}
		}else{
            echo "<script>alert('Datos de acceso incorrectos. Intentalo de nuevo')</script>";
			mysqli_close($link);
			exit(1); 
		}
	}
?>