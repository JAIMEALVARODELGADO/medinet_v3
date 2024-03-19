<?php
require("valida_sesion.php");
$id_persona=$_POST['id_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php 
        require_once "scripts.php";
        require_once "clases/conexion.php";
        $obj=new conectar();
        $conexion=$obj->conexion();
    ?>
    <!--<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
    <script type="text/javascript" src="../librerias/js/jquery.js"></script>
    <script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>-->
</head>

<body>
    <?php
    require("encabezado.php");
    require("menu.php");
    ?>
    <div class="container">        
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>MENU</h4>
                        <h6>Opciones Autirizadas de Usuario</h6>
                    </div>
                    <div class="card-body">
                        <button type="button" id="btnSalir" class="btn btn-secondary">Regresar <span class="fas fa-angle-double-left"></span></button>
                        <form id="frm_menuusu" name="frm_menuusu">
                            <?php
                            $consmenu="SELECT menu.id_menu, menu.orden_menu, menu.opcion_menu, menu.nivel_menu, menu.dependencia_menu, menu.tienesub_menu, menu.url_menu FROM menu WHERE nivel_menu='1' ORDER BY orden_menu";
                            //echo $consmenu;
                            $consmenu=mysqli_query($conexion,$consmenu);
                            while($rowmenu=mysqli_fetch_row($consmenu)){
                               //echo $rowmenu[2];                                
                                ?>
                                    <div class="row">
                                        <?php
                                            /*for($c=0;$c<=$rowmenu[2];$c++){
                                                echo $c;
                                            }*/
                                        ?>
                                        <label for="id_persona" class="col-sm-12 col-form-label"><b><?php echo $rowmenu[2];?></b></label>
                                    </div>
                                        <?php
                                            $consn2="SELECT menu.id_menu, menu.orden_menu, menu.opcion_menu, menu.nivel_menu, menu.dependencia_menu, menu.tienesub_menu, menu.url_menu FROM menu WHERE dependencia_menu='$rowmenu[0]' ORDER BY orden_menu";
                                                //echo $consn2;
                                            $consn2=mysqli_query($conexion,$consn2);
                                            while($rown2=mysqli_fetch_row($consn2)){
                                                $chequeado="";
                                                $conopusu="select id_musu,id_persona,id_menu FROM menu_usuario WHERE id_persona='$id_persona' AND id_menu='$rown2[0]'";
                                                //echo "<br>".$conopusu;
                                                $conopusu=mysqli_query($conexion,$conopusu);
                                                if(mysqli_num_rows($conopusu)<>0){
                                                    $chequeado='checked';
                                                }
                                                ?>
                                                <div class="row">
                                                    <label for="id_persona" class="col-sm-1 col-form-label"></label>
                                                    <label for="id_persona" class="col-sm-11 col-form-label">
                                                        <input type="checkbox" <?php echo $chequeado;?> onclick="activar('<?php echo $rown2[0];?>','<?php echo $id_persona;?>')">
                                                        <?php echo $rown2[2];?>
                                                    </label>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                <?php
                            }

                            ?>
                            <button type="button" id="btnSalir2" class="btn btn-secondary">Regresar <span class="fas fa-angle-double-left"></span></button>
                            
                            <input type="hidden" id="id_menu" name="id_menu">
                            <input type="hidden" id="id_persona" name="id_persona">
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script language="javascript">
    function activar(idmenu,idpersona){        
        $('#id_menu').val(idmenu);
        $('#id_persona').val(idpersona);
        $(document).ready(function(){
            datos=$('#frm_menuusu').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/activarmenu.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro Actualizado");                        
                    }
                    else{
                        alertify.error("Error: Registro no Actualizado");
                    }
                }
            });
        });
    }

    $(document).ready(function(){
        $("#btnSalir").click(function(){            
            window.open("mn_usuario1.php","_self");            
        });
        $("#btnSalir2").click(function(){            
            window.open("mn_usuario1.php","_self");            
        });
    });

</script>