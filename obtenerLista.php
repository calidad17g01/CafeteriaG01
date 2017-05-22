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
				$mail = $_SESSION['correo'];
				$sql="SELECT * FROM PedidoUsuario WHERE PedidoUsuario.Estado = 'En preparacion' ORDER BY Fecha";
				if (!($result=mysqli_query($link ,$sql))){
					echo 'ERROR:' . $link->error; 
					mysqli_close($link);
					exit(1);
				}
				$cont= mysqli_num_rows($result);
				if($cont==0){
						echo "<h2>No hay pedidos disponibles.</h2>";
				} else{
						echo '<h2> PEDIDOS </h2>';
						while ($row = mysqli_fetch_array( $result )) {	
						    $date=date_create($row['Fecha']);
							$fecha= date_format($date,"d/m/Y H:i");
							echo '<table border=1>
									<tr>
										<th>Codigo Pedido</th>
										<th>Precio Total</th>
										<th>Fecha</th>
										<th>Estado</th>
									</tr>
									<tr>
										<td>'.$row['codigo'].'</td>
										<td>'.$row['PrecioTotal'].'</td> 
										<td>'.$fecha.'</td>
										<td>'.$row['Estado'].'</td> 
									</tr>
								   </table>';
						  $codigo=$row['codigo'];
						  $sql2="SELECT * FROM PedidoComida WHERE codigo = '$codigo'";
						  if (!($result2=mysqli_query($link ,$sql2))){
								echo 'ERROR:' . $link->error; 
								mysqli_close($link);
								exit(1);
						  }  
						    echo '<table border=1>
										<tr>
											<th>Comida</th>
										</tr>';
						  while ($row2 = mysqli_fetch_array( $result2 )) {
							  echo '    <tr>
											<td>'.$row2['comida'].'</td>
										</tr>';
						  }
						   echo '<tr> <td>';
						   echo '<form method="post" action="finalizarPedido.php" id="form'.$codigo.'">
						   <input type="button" onClick="valor('.$codigo.')" name="'.$codigo.'" value="Finalizar pedido" id="finalizado">';
						   echo '<input type="hidden" id="finalizar'.$codigo.'" name="finalizar" value=""></form>';
						   echo '</tr> </td></table> </br>';
						}
						
				}
				
				
		    ?>