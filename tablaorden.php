<?php
session_start();
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
	        <strong>Atención!</strong> Para realizar una orden, primero debe realizar la historia
        </div>
	<?php
}
else{
	$sql="SELECT id_ord,tipoorden
	FROM  vw_consulta_orden
	WHERE id_aten='$id_aten'";
	//echo $sql;
	$result=mysqli_query($conexion,$sql);	
}

if($id_aten!=0){
?>
	<div>
		<?php
			while($row=mysqli_fetch_row($result)){
				?>
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-10"><b><?php echo $row[1];?></b></div>
							<div class="col-sm-2">
								<span class="btn btn-danger btn.sm" title="Borrar la Orden" onclick="eliminarorden('<?php echo $row[0]?>','<?php echo $row[1]?>')">
									<span class="fas fa-trash"></span>
								</span>
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php
							$consdet="SELECT id_ord_det,codigo_cups,descripcion_cups,observacion_det FROM vw_orden_detalle WHERE id_ord='$row[0]'";
							//echo $consdet;
							$consdet=mysqli_query($conexion,$consdet);
							if(mysqli_num_rows($consdet)<>0){
								?>
									<table class="table table-hover table-sm table-bordered font13" id="tablaorden">
										<thead style="background-color: #2574a9;color: white; font-weight: bold;">
											<tr>
												<td>Código</td>
												<td>Descripción</td>
												<td>Observación</td>
												<td>Editar</td>
												<td>Eliminar</td>
											</tr>
										</thead>
										<tbody style="background-color: white">
											<?php
												while($rowdet=mysqli_fetch_row($consdet)){
													?>
													<tr>
														<td><?php echo $rowdet[1];?></td>
														<td><?php echo $rowdet[2];?></td>
														<td><?php echo $rowdet[3];?></td>
														<td style="text-align: center;">
															<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar El Registro" onclick="FrmEditar('<?php echo $rowdet[0]?>')">
																<span class="far fa-edit"></span>
															</span>
														</td>
														<td style="text-align: center;">
															<span class="btn btn-danger btn.sm" title="Borrar el Detalle" onclick="eliminardet('<?php echo $rowdet[0]?>','<?php echo $rowdet[2]?>')">
																<span class="fas fa-trash"></span>
															</span>
														</td>
													</tr>
													<?php
												}
											?>
										</tbody>
									</table>
								<?php
							}
							?>
					</div>
				</div>
				<?php
			}
		?>
	</div>
<?php
}
?>
