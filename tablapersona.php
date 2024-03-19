<?php

//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
/*$sql="SELECT persona.id_persona, CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre,detalle_grupo.valor_det AS tipo_iden,persona.numero_iden_per,persona.fnac_per,persona.direccion_per,persona.telefono_per,persona.email_per
FROM persona 
INNER JOIN detalle_grupo ON detalle_grupo.codi_det=persona.tipo_iden_per
INNER JOIN paciente ON paciente.id_persona=persona.id_persona";
$result=mysqli_query($conexion,$sql)*/;

$sql="SELECT persona.id_persona, CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre,detalle_grupo.valor_det AS tipo_iden,persona.numero_iden_per,persona.fnac_per,persona.direccion_per,persona.telefono_per,persona.email_per
FROM persona 
INNER JOIN detalle_grupo ON detalle_grupo.codi_det=persona.tipo_iden_per";
//echo "<br>".$sql
$result=mysqli_query($conexion,$sql)
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablapersona">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Tp Iden.</td>
				<td>Número</td>
				<td>Nombre</td>
				<td>Fecha Nacim</td>
				<td>Dirección</td>
				<td>Teléfono</td>
				<td>E-Mail</td>
				<td>Editar</td>
				<td>Paciente</td>
			</tr>
		</thead>

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				?>
				<tr>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
					<td><?php echo $row[6];?></td>
					<td><?php echo $row[7];?></td>
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar El Registro" onclick="agregaFrmActualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-info btn.sm" data-toggle="modal" data-target="#modalPaciente" title="Información del Paciente" onclick="agregaFrmPaciente('<?php echo $row[0]?>')">
							<span class="fas fa-address-card"></span>
						</span>
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
		$('#tablapersona').DataTable();
	} );
</script>