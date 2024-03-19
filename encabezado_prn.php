    <?php
    $ahora=ahora();
    $cons="SELECT nombre_ent,CONCAT(tipoiden_ent,' ',numeroiden_ent) AS identificacion, direccion_ent,telefono_ent,usarimgencab_ent FROM entidad WHERE id_ent='1'";
    $cons=mysqli_query($conexion,$cons);
    $row=mysqli_fetch_row($cons);
    $nombre_ent=$row[0];
    $identi_ent=$row[1];
    $direccion_ent=$row[2];
    $telefono_ent=$row[3];
    $usarimgencab_ent=$row[4];
        if($usarimgencab_ent=='N'){
            ?>
                <div class="row">
                    <div class="col-sm-12" align="center"><h4><?php echo $nombre_ent;?></h4></div>
                </div>
                <div class="row">
                    <div class="col-sm-12" align="center"><h7><?php echo $identi_ent;?></h7></div>
                </div>
                <div class="row">
                    <div class="col-sm-12" align="center"><h7><?php echo $direccion_ent;?></h7></div>
                </div>
                <div class="row">
                    <div class="col-sm-12" align="center"><h7><?php echo $telefono_ent;?></h7></div>
                </div>
            <?php
        }
        else{
            ?>
                <div class="card" style="width: 100%;">
                    <img class="img-fluid" src="imagenes/encabezado.jpg" alt="Card image cap" border="0">
                </div>
            <?php
        }
    ?>
    <div class="row">
        <div class="col-sm-12" align="right">Fecha y Hora de impresión:<?php echo $ahora;?></h7></div>
    </div>