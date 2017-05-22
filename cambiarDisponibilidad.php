<!DOCTYPE html>
<html>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">

    var total = 0;
	function reset(){
		total = 0;
	}
	function valor(item) {
		var hidden = document.getElementById("finalizar" +  item.name);
		hidden.value = item.name;
	}
	function valores() {
    var table = document.getElementById("tabla");
	var i = 0;
	var j = 1;
		   while (i < document.getElementById('tabla').rows.length){
			document.getElementById("comida"+j).value = document.getElementById('tabla').rows[i].cells[0].innerHTML
			i++;
			j++;
		   }
	}
    function test(item){
		var table = document.getElementById("tabla");
        if(item.checked){
           total+= parseInt(item.value);
		   if (table.rows.lenght = 0){
			    var row = table.insertRow(0);
				var cell1 = row.insertCell(0)
				var cell2 = row.insertCell(1);
				cell1.innerHTML = item.name;
				cell2.innerHTML = item.value + "€";
		   }
		   else{
			var row = table.insertRow(document.getElementById('tabla').rows.length);
			var cell1 = row.insertCell(0)
			var cell2 = row.insertCell(1);
			cell1.innerHTML = item.name;
			cell2.innerHTML = item.value + "€";
		   }
        }else{
           total-= parseInt(item.value);
		   var i = 0;
		   while (i < document.getElementById('tabla').rows.length){
			if (document.getElementById('tabla').rows[i].cells[0].innerHTML == item.name){
				document.getElementById('tabla').deleteRow(i);	
			}
			i++;
		   }
        }
    }



    </script>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8"/>
		<title>MENU</title>
		<link rel="stylesheet" type="text/css" href="css/estilo_pedido.css"/>
	</head>
	<body onload="reset()">
	    <!-- Barra navegacion superior-->
		<ul class="top">
			<li><img src="images/UniLogo.png" alt="Cafeteria ADE EHU" /></li>
			<li><a href="barra.php">Inicio</a></li>
		</ul>
     	
		</br>
		 
	    <div id="fotos">
		    <?php
			    session_start();
				if($_SESSION['correo'] != 'barra@cafeadeehu.es'){
				header("Location:inicio.php");
				}
                #Conexion con la BD
				$link = mysqli_connect("mysql.hostinger.es", "u962326006_cafe", "cafeteriaadeehu", "u962326006_cafe");
				if(!$link){
				echo 'Fallo al concectar a MySQL:' . $link->connect_error; 
					mysqli_close($link);
				}
				$columna=0;
				$sql="SELECT * FROM Sandwiches";
				if (!($result=mysqli_query($link ,$sql))){
					echo "<script>alert('Se ha producido un error desconocido. Intentalo de nuevo')</script>";
					mysqli_close($link);
					exit(1);
				}
				$cont= mysqli_num_rows($result);
				if($cont==0){
						echo "No hay sandwiches disponibles.";
				} else{
						echo '<h2> SANDWICHES </h2>
						<table>';
						
						while ($row = mysqli_fetch_array( $result )) {
							if($columna==0){
								   echo "<tr>";
						    }
							$sand= 'Sandwich '.$row['Nombre'];
							echo '<td><img src="'.$row['Foto'].'" height="100" width="100"><br>';
							echo '<h3>'.$row['Nombre'].'</h3>';
							if ($row['Disponibilidad'] == 0){
								echo '<h3>No Disponible</h3>';
							}
							else{
								echo '<h3>Disponible</h3>';
							}
							echo "<form method='post' action='disponibilidadSandwich.php' id='form".$row['Nombre']."'>
								<input type='submit' onClick='valor(this)' name=".$row['Nombre']." value='Cambiar Disponibilidad' id='dispon'>";
							echo '<input type="hidden" id="finalizar'.$row['Nombre'].'" name="finalizar" value="">';
							echo '<input type="hidden" id="disponibilidad" name="disponibilidad" value='.$row['Disponibilidad'].'></form>';
							echo '</td>';
							$columna=$columna+1;
							if($columna==3){
								echo "</tr>";
								$columna=0;
							}
						}
						$columna=0;
						echo '</table>';
				}
				
				
				$sql="SELECT * FROM Bocadillo";
				if (!($result=mysqli_query($link ,$sql))){
					echo "<script>alert('Se ha producido un error desconocido. Intentalo de nuevo')</script>";
					mysqli_close($link);
					exit(1);
				}
				$cont= mysqli_num_rows($result);
				if($cont==0){
						echo "No hay bocadillo disponibles.";
				} else{
						echo '<h2> BOCADILLOS </h2>
						<table>';
						
						while ($row = mysqli_fetch_array( $result )) {
							if($columna==0){
								   echo "<tr>";
						    }
							echo '<td><img src="'.$row['Foto'].'" height="100" width="100"><br>';
							echo '<h3>'.$row['Nombre'].'</h3>';
							if ($row['Disponibilidad'] == 0){
								echo '<h3>No Disponible</h3>';
							}
							else{
								echo '<h3>Disponible</h3>';
							}
							echo "<form method='post' action='disponibilidadBocadillo.php' id='form".$row['Nombre']."'>
								<input type='submit' onClick='valor(this)' name=".$row['Nombre']." value='Cambiar Disponibilidad' id='dispon'>";
							echo '<input type="hidden" id="finalizar'.$row['Nombre'].'" name="finalizar" value="">';
							echo '<input type="hidden" id="disponibilidad" name="disponibilidad" value='.$row['Disponibilidad'].'></form>';
							echo '</td>';
							$columna=$columna+1;
							if($columna==3){
								echo "</tr>";
								$columna=0;
							}
							
						}
						$columna=0;
						echo '</table>';
				}
				$sql="SELECT * FROM Hamburguesas";
				if (!($result=mysqli_query($link ,$sql))){
					echo "<script>alert('Se ha producido un error desconocido. Intentalo de nuevo')</script>";
					mysqli_close($link);
					exit(1);
				}
				$cont= mysqli_num_rows($result);
				if($cont==0){
						echo "No hay hamburguesas disponibles.";
				} else{
						echo '<h2> HAMBURGUESAS </h2>
						<table>';
						
						while ($row = mysqli_fetch_array( $result )) {
							if($columna==0){
								   echo "<tr>";
						    }
							echo '<td><img src="'.$row['Foto'].'" height="100" width="100"><br>';
							echo '<h3>'.$row['Nombre'].'</h3>';
							if ($row['Disponibilidad'] == 0){
								echo '<h3>No Disponible</h3>';
							}
							else{
								echo '<h3>Disponible</h3>';
							}
							echo "<form method='post' action='disponibilidadHamburguesa.php' id='form".$row['Nombre']."'>
								<input type='submit' onClick='valor(this)' name=".$row['Nombre']." value='Cambiar Disponibilidad' id='dispon'>";
							echo '<input type="hidden" id="finalizar'.$row['Nombre'].'" name="finalizar" value="">';
							echo '<input type="hidden" id="disponibilidad" name="disponibilidad" value='.$row['Disponibilidad'].'></form>';
							echo '</td>';
							$columna=$columna+1;
							if($columna==3){
								echo "</tr>";
								$columna=0;
							}
						}
						$columna=0;
						echo '</table>';
				}
				$sql="SELECT * FROM Bebidas";
				if (!($result=mysqli_query($link ,$sql))){
					echo "<script>alert('Se ha producido un error desconocido. Intentalo de nuevo')</script>";
					mysqli_close($link);
					exit(1);
				}
				$cont= mysqli_num_rows($result);
				if($cont==0){
						echo "No hay bebidas disponibles.";
				} else{
						echo '<h2> BEBIDA </h2>
						<table>';
						
						while ($row = mysqli_fetch_array( $result )) {
							if($columna==0){
								   echo "<tr>";
						    }
							echo '<td><img src="'.$row['Foto'].'" height="100" width="100"><br>';
							echo '<h3>'.$row['Nombre'].'</h3>';
							if ($row['Disponibilidad'] == 0){
								echo '<h3>No Disponible</h3>';
							}
							else{
								echo '<h3>Disponible</h3>';
							}
							echo "<form method='post' action='disponibilidadBebida.php' id='form".$row['Nombre']."'>
								<input type='submit' onClick='valor(this)' name=".$row['Nombre']." value='Cambiar Disponibilidad' id='dispon'>";
							echo '<input type="hidden" id="finalizar'.$row['Nombre'].'" name="finalizar" value="">';
							echo '<input type="hidden" id="disponibilidad" name="disponibilidad" value='.$row['Disponibilidad'].'></form>';
							echo '</td>';
							$columna=$columna+1;
							if($columna==3){
								echo "</tr>";
								$columna=0;
							}
						}
						$columna=0;
						echo '</table>';
				}
						
				$result->close();
                #Cierre de la conexiÃ³n con la BD.
				mysqli_close($link); 	   
		    ?>
	    </div> 
		 			 
	</body>
</html>