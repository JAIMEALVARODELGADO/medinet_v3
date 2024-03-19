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
            $sql=str_replace(' FROM', ',identif_prof AS ID_PROFESIONAL FROM', $sql);
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
                                echo "<tr>";
                                $cols = sizeof($row);                   
                                while ($fieldinfo=mysqli_fetch_field($result)){
                                    if($fieldinfo->name<>"ID_PROFESIONAL"){
                                        echo "<th>".$fieldinfo->name."</th>";
                                    }
                                }
                                echo "<th>FIRMA PROFESIONAL</th>";
                                echo "</tr>";                   
                            }               
                            echo "<tr>";
                            for($j=0; $j<$cols-1; $j++){   
                                echo "<td>". htmlspecialchars($row[$j]) . "</td>";
                            }                            
                            $identif_prof=$row[$cols-1];
                            $firma='imagenes/firmas/'.$identif_prof.'.jpg';
                            ?>
                            <td>
                                <div class="card border-light" style="width: 15rem;">
                                <img class="card-img-top" src="<?php echo $firma;?>" alt="<?php echo $identif_prof;?>" width="80" height="50">
                                </div>
                            </td>
                            <?php
                            echo "</tr>"; 
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
    window.close();
//}
</script>

