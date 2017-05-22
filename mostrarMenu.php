<!DOCTYPE html>
<html>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">

    var total = 0;
	function reset(){
		total = 0;
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
        document.getElementById('TotalCost').value = total + "€";
		document.getElementById('Precio').value = total + "€";
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
			<li><a href="inicioin.php">Inicio</a></li>
		</ul>
     	
		</br>
		 
	    <div id="fotos">
		    <?php
			    session_start();
				if(!isset($_SESSION['correo'])){
				header("Location:inicio.php");
				}
                #Conexion con la BD
				$link = mysqli_connect("mysql.hostinger.es", "u962326006_cafe", "cafeteriaadeehu", "u962326006_cafe");
				if(!$link){
				echo 'Fallo al concectar a MySQL:' . $link->connect_error; 
					mysqli_close($link);
				}
		
				echo '<form method="post" action="pedidoRealizado.php">
				';
				$columna=0;
				$sql="SELECT * FROM Sandwiches WHERE Disponibilidad = 1";
				if (!($result=mysqli_query($link ,$sql))){
					echo "<script>alert('Se ha producido un error desconocido. Intentalo de nuevo')</script>";
					mysqli_close($link);
					exit(1);
				}
				$cont= mysqli_num_rows($result);
				if($cont==0){
						echo '<h2> SANDWICHES </h2>';
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
							echo "<input type='checkbox' name='".$sand."' value=".$row['Precio']." onClick='test(this);'>".$row['Nombre']." ".$row['Precio']."€</td>";
							$columna=$columna+1;
							if($columna==3){
								echo "</tr>";
								$columna=0;
							}
						}
						$columna=0;
						echo '</table>';
				}
				
				
				$sql="SELECT * FROM Bocadillo WHERE Disponibilidad = 1";
				if (!($result=mysqli_query($link ,$sql))){
					echo "<script>alert('Se ha producido un error desconocido. Intentalo de nuevo')</script>";
					mysqli_close($link);
					exit(1);
				}
				$cont= mysqli_num_rows($result);
				if($cont==0){
					echo '<h2> BOCADILLOS </h2>';
						echo "No hay bocadillo disponibles.";
				} else{
						echo '<h2> BOCADILLOS </h2>
						<table>';
						
						while ($row = mysqli_fetch_array( $result )) {
							if($columna==0){
								   echo "<tr>";
						    }
							echo '<td><img src="'.$row['Foto'].'" height="100" width="100"><br>';
							echo "<input type='checkbox' name='".'Bocadillo de '.$row['Nombre']."' value=".$row['Precio']." onClick='test(this);'>".$row['Nombre']." ".$row['Precio']."€</td>";
							$columna=$columna+1;
							if($columna==3){
								echo "</tr>";
								$columna=0;
							}
							
						}
						$columna=0;
						echo '</table>';
				}
				$sql="SELECT * FROM Hamburguesas WHERE Disponibilidad = 1";
				if (!($result=mysqli_query($link ,$sql))){
					echo "<script>alert('Se ha producido un error desconocido. Intentalo de nuevo')</script>";
					mysqli_close($link);
					exit(1);
				}
				$cont= mysqli_num_rows($result);
				if($cont==0){
						echo '<h2> HAMBURGUESAS </h2>';
						echo "No hay hamburguesas disponibles.";
				} else{
						echo '<h2> HAMBURGUESAS </h2>
						<table>';
						
						while ($row = mysqli_fetch_array( $result )) {
							if($columna==0){
								   echo "<tr>";
						    }
							echo '<td><img src="'.$row['Foto'].'" height="100" width="100"><br>';
							echo "<input type='checkbox' name='".'Hamburguesa '.$row['Nombre']."' value=".$row['Precio']." onClick='test(this);'>".$row['Nombre']." ".$row['Precio']."€</td>";
							$columna=$columna+1;
							if($columna==3){
								echo "</tr>";
								$columna=0;
							}
						}
						$columna=0;
						echo '</table>';
				}
				$sql="SELECT * FROM Bebidas WHERE Disponibilidad = 1";
				if (!($result=mysqli_query($link ,$sql))){
					echo "<script>alert('Se ha producido un error desconocido. Intentalo de nuevo')</script>";
					mysqli_close($link);
					exit(1);
				}
				$cont= mysqli_num_rows($result);
				if($cont==0){
						echo '<h2> BEBIDA </h2>';
						echo "No hay bebidas disponibles.";
				} else{
						echo '<h2> BEBIDA </h2>
						<table>';
						
						while ($row = mysqli_fetch_array( $result )) {
							if($columna==0){
								   echo "<tr>";
						    }
							echo '<td><img src="'.$row['Foto'].'" height="100" width="100"><br>';
							echo "<input type='checkbox' name='".$row['Nombre']."' value=".$row['Precio']." onClick='test(this);'>".$row['Nombre']." ".$row['Precio']."€</td>";
							$columna=$columna+1;
							if($columna==3){
								echo "</tr>";
								$columna=0;
							}
						}
						$columna=0;
						echo '</table>';
				}
				
				echo '<br>';	
				echo '<table border="2" id="tabla">';
				echo '</table>';
				echo '<input type="text" id="TotalCost" name="TotalCost"" value="" disabled>';
				echo '<br>
				<input type="submit" onClick="valores()" value="Continuar">
				<br>';
				echo '<input type="hidden" id="Precio" name="Precio" value="">';
				echo '<input type="hidden" id="comida1" name="comida1" value="">';
				echo '<input type="hidden" id="comida2" name="comida2" value="">';
				echo '<input type="hidden" id="comida3" name="comida3" value="">';
				echo '<input type="hidden" id="comida4" name="comida4" value="">';
				echo '<input type="hidden" id="comida5" name="comida5" value="">';
				echo '<input type="hidden" id="comida6" name="comida6" value="">';
				echo '<input type="hidden" id="comida7" name="comida7" value="">';
				echo '<input type="hidden" id="comida8" name="comida8" value="">';
				echo '<input type="hidden" id="comida9" name="comida9" value="">';
				echo '<input type="hidden" id="comida10" name="comida10" value="">';
				echo '</form>';			
				$result->close();
                #Cierre de la conexiÃ³n con la BD.
				mysqli_close($link); 	   
		    ?>
	    </div> 
		 			 
	</body>
</html>