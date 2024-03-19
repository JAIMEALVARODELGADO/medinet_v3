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
	        <strong>Atención!</strong> Para adjuntar archivos, primero debe realizar la historia
        </div>
	<?php
}
else{
	$sql="SELECT id_adjunto,descripcion_adj,archivo_adj
	FROM  consulta_adjunto
	WHERE id_aten='$id_aten'";
	//echo $sql;
	$result=mysqli_query($conexion,$sql);	
}
if($id_aten!=0){
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaadjunto">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Archivo</td>
				<td>Descripción</td>				
				
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</thead>		

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				$archivo="adjuntos/".$row[2];
				?>
				<tr>
					<td>
						<a href="<?php echo $archivo;?>" target="new">
							<span class="btn btn-primary btn.sm" data-toggle="modal" title="Visualizar el archivo">
							<i class="fas fa-search"></i><?php echo $row[2];?>
							</span>
						</a>
					</td>
						
					<td><?php echo $row[1];?></td>
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modaleditardescripcion" title="Editar El Registro" onclick="FrmActualizar('<?php echo $row[0]?>')">
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
		//$('#tablaadjunto').DataTable();
	} );
</script>