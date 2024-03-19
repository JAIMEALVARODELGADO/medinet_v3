<?php
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_medicamento,codigoatc_mto,nombre_mto,estado_mto,IF(tipo_mto='M','Medicamento',IF(tipo_mto='D','Dispositivo',IF(tipo_mto='P','Paquete','Servicio'))) AS tipo_descmto, tipo_mto
FROM medicamento ORDER BY nombre_mto";
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql)
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablamed">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Código</td>
				<td>Nombre</td>
				<td>Tipo</td>
				<td>Activo</td>				
				<td>Editar</td>

				<td>Editar_Paquete</td>
			</tr>
		</thead>

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				if($row[3]=='A')
					{$chequeado='checked';}
				else
					{$chequeado='';}
				?>
				<tr>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[4];?></td>
					<td><input type="checkbox" <?php echo $chequeado;?> onclick="cambiarestado('<?php echo $row[0]?>')"></td>					
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modaleditarmed" title="Editar El Registro" onclick="FrmActualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<?php
						if($row[5]=='P'){
							?>
								<td style="text-align: center;">
									<span class="btn btn-success btn.sm" title="Editar Paquete" onclick="paquete('<?php echo $row[0]?>')">
										<i class="fas fa-briefcase"></i>
									</span>
								</td>
							<?php
						}
						else{
							?>
								<td style="text-align: center;">
									<span class="btn btn-secondary btn.sm" title="Editar Paquete">
										<i class="fas fa-briefcase"></i>
									</span>
								</td>
							<?php
						}
					?>
					
				</tr>
				<?php
			}
			?>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablamed').DataTable();
	} );
</script>