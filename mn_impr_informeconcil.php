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
                        $totfactura=0;
                        $totconcil=0;           
                        $totfav=0;
                        $toteps=0;
                        while($row=mysqli_fetch_row($result)){
                            if($cols==0){
                                echo "<tr>";
                                $cols = sizeof($row);                   
                                while ($fieldinfo=mysqli_fetch_field($result)){
                                    echo "<th>".$fieldinfo->name."</th>";                                    
                                }                   
                                echo "</tr>";                   
                            }               
                            echo "<tr>";
                            for($j=0; $j<$cols; $j++){   
                                echo "<td>". htmlspecialchars($row[$j]) . "</td>";                                
                            }
                            echo "</tr>";
                            $totfactura=$totfactura+$row[4];
                            $totconcil=$totconcil+$row[5];              
                            $totfav=$totfav+$row[6];
                            $toteps=$toteps+$row[7];
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="right" colspan="4"><b>Totales</b></td>
                            <td align="right"><b><?php echo $totfactura;?></b></td>
                            <td align="right"><b><?php echo $totconcil;?></b></td>              
                            <td align="right"><b><?php echo $totfav;?></b></td>
                            <td align="right"><b><?php echo $toteps;?></b></td>
                        </tr>
                    </tfoot>
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