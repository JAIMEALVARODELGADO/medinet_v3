<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$consfac="SELECT valortot_fac, copago_fac, descuento_fac, valorneto_fac FROM factura_encabezado WHERE id_factura='$_SESSION[gid_factura]'";
$consfac=mysqli_query($conexion,$consfac);
$rowfac=mysqli_fetch_row($consfac);

$valortot_fac=$rowfac[0];
$copago_fac=$rowfac[1];
$descuento_fac=$rowfac[2];
$valorneto_fac=$rowfac[3];


$sql="SELECT id_detfac, codigo_cdet, descripcion_cdet, cantidad_detfac, valor_unit_detfac, valor_total FROM vw_factura_detalle WHERE id_factura='$_SESSION[gid_factura]'";

$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablafacturadetalle">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Código</td>
				<td>Descripción</td>
				<td>Cantidad</td>
				<td>Vr Unitario</td>
				<td>Vr Total</td>				
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
					<td align="right"><?php echo $row[3];?></td>
					<td align="right"><?php echo number_format($row[4],2,'.',',');?></td>
					<td align="right"><?php echo number_format($row[5],2,'.',',');?></td>
					
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar el registro" onclick="Editar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn.sm" title="Borrar el registro" onclick="borrar('<?php echo $row[0]?>','<?php echo $row[2]?>')">
							<i class="fas fa-trash"></i>
						</span>
					</td>
				<?php
			}
			?>
		</tbody>			
	</table>

	<form name="frm_encabezado" id="frm_encabezado">
		<div class="alert alert-secondary" role="alert">
			<div class="row">
				<div class="col-sm-9" align="right"><label>Valor Total:</label></div>
				<div class="col-sm-2" align="right"><label><?php echo number_format($valortot_fac,2,'.',',');?></label></div>
			</div>
			<div class="row">
				<div class="col-sm-9" align="right"><label>Valor Copago:</label></div>
				<div class="col-sm-2" align="right"><label><input type="text" maxlength="80" class="form-control input-sm" id="copago_fac" name="copago_fac" value="<?php echo $copago_fac;?>" onblur="guardarenca()"></label></div>
			</div>
			<div class="row">
				<div class="col-sm-9" align="right"><label>Valor Descuento:</label></div>
				<div class="col-sm-2" align="right"><label><input type="text" maxlength="80" class="form-control input-sm" id="descuento_fac" name="descuento_fac" value="<?php echo $descuento_fac;?>" onblur="guardarenca()"></label></div>
			</div>
			<div class="row">
				<div class="col-sm-9" align="right"><label>Valor Neto:</label></div>
				<div class="col-sm-2" align="right"><label><?php echo number_format($valorneto_fac,2,'.',',');?></label></div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		//$('#tablafacturadetalle').DataTable();
	} );

	function guardarenca(){		
		$(document).ready(function(){	        
	        datos=$('#frm_encabezado').serialize();
	        $.ajax({
	            type:"POST",
	            data:datos,
	            url:"procesos/actualizarfactura_copago.php",

	            success:function(r){
	                if(r==1){
	                    $("#tablaDatadetalle").load("tablafacturadetalle.php");	                        
	                }	                    
	            }
	        });
	    });
	}
</script>