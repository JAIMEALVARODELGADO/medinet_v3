<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$conhis="
SELECT vw_atencion.id_persona,vw_consulta.fecha_aten,vw_consulta.dxprinc,cierel1.descripcion_cie AS dxrel1,cierel2.descripcion_cie AS dxrel2,cierel3.descripcion_cie AS dxrel3,vw_consulta.nombre_prof
FROM vw_consulta
INNER JOIN vw_atencion ON vw_atencion.id_aten=vw_consulta.id_aten
LEFT JOIN cie AS cierel1 ON cierel1.id_cie=vw_consulta.dxrela1_con
LEFT JOIN cie AS cierel2 ON cierel2.id_cie=vw_consulta.dxrela2_con
LEFT JOIN cie AS cierel3 ON cierel3.id_cie=vw_consulta.dxrela3_con
WHERE vw_atencion.id_persona='$_SESSION[id_persona]' ORDER BY fecha_aten DESC";
//echo $conhis;
$result=mysqli_query($conexion,$conhis);
?>
<div>
	<table class="table table-hover table-sm table-bordered font13" id="tabladx">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Fecha</td>
				<td>Dx Principal</td>		
				<td>Dx Relacionado 1</td>
				<td>Dx Relacionado 2</td>
				<td>Dx Relacionado 3</td>
				<td>Profesional</td>				
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
				</tr>
				<?php
			}
			?>
		</tbody>		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tabladx').DataTable();
	} );
</script>