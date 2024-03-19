<?php
require("valida_sesion.php");
//echo $_POST['id_con'];
require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql=$_POST['sql'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php 
        require_once "scripts.php";
    ?>
</head>

<body>
    <div class="container-fluid">
        <?php
            require("encabezado_prn.php");
        ?>
        <div class="card text-center">
            <div class="card-header">
                <h7><b><?php echo $_POST['titulo'];?></b></h7>
            </div>
        </div>        
        <?php            
            //echo $sql;
            $result=mysqli_query($conexion,$sql);
            ?>
            <div>
                <table class="table table-hover table-sm table-bordered font13" id="tablainforme">      
                    <tbody style="background-color: white">
                        <?php
                        $cols=0;
                        while($row=mysqli_fetch_row($result)){
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
    </div>
</body>

</html>

<script type="text/javascript">
//function imprimir() {
    window.print();
    //window.close();
//}
</script>

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