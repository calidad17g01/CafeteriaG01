<?php
	#Nombre y apellidos
	if(!filter_var($_POST["nombreyapellidos"], FILTER_VALIDATE_REGEXP,array("options" => array("regexp"=>"/^[A-z]+([ ][A-z]+)+$/")))){
		echo "<script type=\"text/javascript\">alert(\"Formato de nombre y apellidos incorrecto\");</script>";
		exit(1);
	}
	
	#Correo
    if(!filter_var($_POST["correo"], FILTER_VALIDATE_REGEXP,array("options" => array("regexp"=>"/^[0-z]+@[0-z]+\.[a-z]+$/")))){
		echo "<script type=\"text/javascript\">alert(\"Formato de correo incorrecto\");</script>";
		exit(1);
	}
	
	#Password
	if(!filter_var($_POST["password"], FILTER_VALIDATE_REGEXP,array("options" => array("regexp"=>"/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}$/")))){
		echo "<script type=\"text/javascript\">alert(\"Formato de contraseña incorrecto. La contraseña debe tener al menos 1 minuscula, 1 mayuscula, 1 digito y entre 6-8 caracteres\");</script>";
		exit(1);
	}
	
	#Comprobar que las contraseñas sean iguales
	if (strcmp($_POST["password"],$_POST["rpassword"]) != 0) {
		echo "<script type=\"text/javascript\">alert(\"Las contraseñas introducidas no son iguales. Intentalo de nuevo.\");</script>";
		exit(1);
	}
	
	#Conexión con la BD
	$link = mysqli_connect("mysql.hostinger.es", "u962326006_cafe", "cafeteriaadeehu", "u962326006_cafe");
	if(!$link){
		echo "<script type=\"text/javascript\">alert(\"Error en el proceso de registro(abrir conexion con la BD)\");</script>";
		mysqli_close($link);
		exit(1);
	}

	#Guardamos los valores en la BD 
	$sql="INSERT INTO Usuario VALUES (NULL, '$_POST[nombreyapellidos]','$_POST[correo]','$_POST[password]')";
	if (!mysqli_query($link ,$sql)){
		echo "<script type=\"text/javascript\">alert(\"Error en el proceso de registro\");</script>";
		mysqli_close($link);
		exit(1);
	}
	
	#Si todo ha ido bien
	echo "<script type=\"text/javascript\">alert(\"Registro realizado correctamente\"); window.location = 'inicio.php';</script>";
	mysqli_close($link);
?>