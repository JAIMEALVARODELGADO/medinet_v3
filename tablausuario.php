<?php
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_persona,valor_det,numero_iden_per,nombre,direccion_per,telefono_per,email_per,profesion_usu,registro_usu,cargo_usu,estado_usu,IF(estado_usu='A','Activo','Inactivo') AS estado,examenfis_usu
FROM vw_usuario";
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql)
?>

<div>	
	<table class="table table-hover table-sm table-bordered font13" id="tablausuario">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Tp Iden.</td>
				<td>Número</td>
				<td>Nombre</td>				
				<td>Dirección</td>
				<td>Teléfono</td>
				<td>E-Mail</td>
				<td>Profesion</td>
				<td>Registro</td>
				<td>Activo</td>
				<td>Editar</td>
				<td>Menú</td>
				<td>E. Físico</td>
			</tr>
		</thead>

		<tbody style="background-color: white">
			<?php
			$c=0;
			while($row=mysqli_fetch_row($result)){
				if($row[10]=='A')
					{$chequeado='checked';}
				else
					{$chequeado='';}
				//$chequeado='checked';
				//echo $chequeado;
				?>
				<tr>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>					
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
					<td><?php echo $row[6];?></td>
					<td><?php echo $row[7];?></td>
					<td><?php echo $row[8];?></td>
					<td><input type="checkbox" <?php echo $chequeado;?> onclick="cambiarestado('<?php echo $row[0]?>')"></td>
					
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modaleditarusuario" title="Editar El Registro" onclick="FrmActualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<?php							
							if($row[10]=='A'){
								?>
									<span class="btn btn-info btn.sm" title="Autorizaciones del Menú" onclick="go_menu('<?php echo $row[0]?>')">
										<span class="fas fa-address-card"></span>
									</span>
								<?php
							}
							else{
								?>
									<span class="btn btn-secondary btn.sm" title="Autorizaciones del Menú">
										<span class="fas fa-address-card"></span>
									</span>
								<?php
							}
						?>
					</td>
					<td style="text-align: center;">
						<?php
							$c++;
							if($row[12]=='S'){
								?>
									<span class="btn btn-info btn.sm" data-toggle="modal" data-target="#modalexamenf" title="Asignar Examen Físico a Realizar" onclick="FrmExamen('<?php echo $row[0]?>')">
										<i class="fas fa-user-md"></i></span>
									</span>

									<div class="panel-group">
									    <div class="panel panel-default">
									        <div class="panel-heading">
									            <!--<h4 class="panel-title">-->
									                <a data-toggle="collapse" href="#collapse<?php echo $c;?>"><i class="fas fa-sort-down"></i></a>
									            <!--</h4>-->
									        </div>
									        <div id="collapse<?php echo $c;?>" class="panel-collapse collapse">
									        	<?php
									        		$consexa="SELECT det_examenfisico.descripcion_def
														FROM det_examenfisico
														INNER JOIN mae_examenfisico ON  mae_examenfisico.id_mef=det_examenfisico.id_mef
														INNER JOIN examenfisico_medico ON examenfisico_medico.id_mef=mae_examenfisico.id_mef
														WHERE examenfisico_medico.id_persona='$row[0]'";
									        		$consexa=mysqli_query($conexion,$consexa);
									        		while($rowexa=mysqli_fetch_row($consexa)){
									        			echo "<div class='panel-body'>$rowexa[0]</div>";
									        		}
									        	?>									            
									        </div>
									    </div>
									</div>


								<?php
							}
							else{
								?>
									<span class="btn btn-secondary btn.sm" title="Asignar Examen Físico a Realizar">
										<i class="fas fa-user-md"></i>
									</span>
								<?php
							}
						?>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablausuario').DataTable();
	} );
</script>