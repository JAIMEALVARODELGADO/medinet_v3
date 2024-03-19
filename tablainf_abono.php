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
			$totfactura=0;
			$totabono=0;
			while($row=mysqli_fetch_row($result)){
				if($cols==0){
                	echo "<tr>";
	                $cols = sizeof($row);	                
	                while ($fieldinfo=mysqli_fetch_field($result)){
    					echo "<th>".$fieldinfo->name."</th>";
    					//echo "<th>".$fieldinfo->type."</th>";
    				}	                
                	echo "</tr>";                	
            	}				
				echo "<tr>";
            	for($j=0; $j<$cols; $j++){	 
                	echo "<td>". htmlspecialchars($row[$j]) . "</td>";                	
            	}
            	echo "</tr>";
            	$totfactura=$totfactura+$row[4];
            	$totabono=$totabono+$row[5];
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<td align="right" colspan="4"><b>Totales</b></td>
				<td align="right"><b><?php echo $totfactura;?></b></td>
				<td align="right"><b><?php echo $totabono;?></b></td>
			</tr>
		</tfoot>
	</table>
</div>


