<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$conhis="SELECT id_aten FROM atencion WHERE id_agc='$_SESSION[gid_agc]'";
$conhis=mysqli_query($conexion,$conhis);
if(mysqli_num_rows($conhis)!=0){
	$rowhis=mysqli_fetch_row($conhis);
	$id_aten=$rowhis[0];
}
else{
	$id_aten=0;
}
if($id_aten==0){
	?>
		<div class="alert alert-danger">
	        <button class="close" data-dismiss="alert"><span>&times;</span></button>
	        <strong>Atención!</strong> Para formular, primero debe realizar la historia
        </div>
	<?php
}
else{
	$sql="SELECT id_form_det,nombre_mto,dosis_det,frecuencia_det,via_admin,tiempo_trat_det,cantidad_det,observacion_det
	FROM  vw_formula_detalle
	WHERE id_aten='$id_aten'";
	//echo $sql;
	$result=mysqli_query($conexion,$sql);	
}

if($id_aten!=0){
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaformula">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Medicamento</td>
				<td>Dosis</td>				
				<td>Frecuencia</td>
				<td>Vía</td>
				<td>Tiempo Tratamiento</td>
				<td>Cantidad</td>
				<td>Observación</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</thead>		

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				?>
				<tr>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
					<td><?php echo $row[6];?></td>
					<td><?php echo $row[7];?></td>
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modaleditarmedicamento" title="Editar El Registro" onclick="FrmActualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn.sm" title="Borrar el Registro" onclick="eliminarDatos('<?php echo $row[0]?>','<?php echo $row[1]?>')">
							<span class="fas fa-trash"></span>
						</span>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>		
	</table>	

</div>
<?php
}
?>

<script type="text/javascript">
	$(document).ready(function() {
		//$('#tablaformula').DataTable();
	} );
</script>