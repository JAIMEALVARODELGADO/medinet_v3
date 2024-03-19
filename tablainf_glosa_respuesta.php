<?php
session_start();
require_once "clases/conexion.php";
//require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();

//$fechaini=cambiafecha(hoy()).' 00:00';
//$fechafin=cambiafecha(hoy()).' 23:59';
$sql=$_SESSION['gsql'];
//fecha_con between '2018-10-01' AND '2018-11-30'
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql)
?>
<div>
	<table class="table table-hover table-sm table-bordered font11" id="tablainforme">		
		<tbody style="background-color: white">
			<?php
			$cols=0;
			while($row=mysqli_fetch_row($result)){
				$cols=0;
				if($cols==0){
                	//echo "<tr>";
	                $cols = sizeof($row);	                
	                /*while ($fieldinfo=mysqli_fetch_field($result)){
    					echo "<th>".$fieldinfo->name."</th>";
    				}	                
                	echo "</tr>";*/
            	}
            	?>
            	<tr><td colspan="15" align="center"><b>GLOSA</b></td></tr>
            	<tr>
            		<th>NUMERO</th>
            		<th>FACTURA</th>
            		<th>FECHA_RECEPCION</th>
            		<th>MOTIVO</th>
            		<th>FECHA_ENTREGA</th>
            		<th>DIAS</th>
            		<th>EPS</th>
            		<th>VALOR_FACTURA</th>
            		<th>VALOR_GLOSA</th>
            		<th>VALOR_A_FAVOR</th>
            		<th>VALOR_EPS</th>
            		<th>FECHA_ENVIO</th>
            		<th>GUIA</th>
            		<th>RESPUESTA</th>
            		<th>RESPONSABLE</th>
            	</tr>
            	<?php

				echo "<tr>";
            	for($j=0; $j<$cols; $j++){	 
                	echo "<td>". htmlspecialchars($row[$j]) . "</td>";                	
            	}
            	echo "</tr>";
            	respuesta($row[0],$conexion);
			}
			?>
		</tbody>
	</table>
</div>


<?php
function respuesta($idglosa,$conexion){	
	$sqlresp="SELECT fechacont_resp AS FECHA_CONTESTACION, valoracepta_resp AS VALOR_ACEPTADO,descripcion_cdet AS DETALLE_FACTURA,codigo_conglo AS CODIGO, descripcion_conglo AS DESCRIPCION, observacion_resp AS OBSERVACION,nombre_responsable AS RESPONSABLE 
	FROM vw_glosa_respuesta WHERE id_glosa='$idglosa' ORDER BY fechacont_resp";
	//echo "<br>".$sqlresp;
	$sqlresp=mysqli_query($conexion,$sqlresp);
	?>
	<tr><td colspan="15" align="center"><b>RESPUESTAS</b></td></tr>
	<tr>		
		<td colspan="15">
			<table class="table table-hover table-sm table-bordered font11" id="tablainforme">		
				<tbody style="background-color: white">
					<tr>
						<th>FECHA</th>						
						<th>VALOR_ACEPTADO</th>
						<th>DETALLE_FACTURA</th>
						<th>CODIGO</th>
						<th>DESCRIPCION</th>
						<th>OBSERVACION</th>
						<th>RESPONSABLE</th>
					</tr>
					<?php
					while($rowresp=mysqli_fetch_row($sqlresp)){
						echo "<tr>";
						echo "<td>".$rowresp[0]."</td>";
						echo "<td>".$rowresp[1]."</td>";
						echo "<td>".$rowresp[2]."</td>";
						echo "<td>".$rowresp[3]."</td>";
						echo "<td>".$rowresp[4]."</td>";
						echo "<td>".$rowresp[5]."</td>";
						echo "<td>".$rowresp[6]."</td>";
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</td>
	</tr>
	<?php
}
?>