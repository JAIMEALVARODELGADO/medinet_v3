<?php
require("valida_sesion.php");
require_once "clases/conexion.php";

$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_ccobro, numero_ccob, fecha_ccob, id_eps, nombre_eps FROM vw_cuentacobro WHERE id_ccobro='$_POST[id_ccobroD]'";
//echo $sql;
$result=mysqli_query($conexion,$sql);
$row=mysqli_fetch_row($result);
$numero_ccob=$row[1];
$fecha_ccob=$row[2];
$nombre_eps=$row[4];
$_SESSION['gid_eps']=$row[3];
$_SESSION['gid_ccobro']=$row[0];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>
</head>

<body>
    <?php
    require("encabezado.php");
    //require("menu.php");
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Relacionar Facturas</h4>
                    </div>

                    <div class="card-body">
                        <!--<span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoeps" title="Agrega Nueva Eps">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>-->                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><b>Cuenta de Cobro Nro:</b> <?php echo $numero_ccob;?></label>
                            <label class="col-sm-3 col-form-label"><b>Fecha:</b> <?php echo $fecha_ccob;?></label>
                            <label class="col-sm-6 col-form-label"><b>EPS:</b> <?php echo $nombre_eps;?></label>
                        </div>
                        <hr>

                        <div class="row">
                             <div class="col-sm-6">
                                <div class="card text-left">
                                    <div class="card-header">
                                        <h6>Facturas Sin Relacionar</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="tablaDatasinrelacion"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="card text-left">
                                    <div class="card-header">
                                        <h6>Facturas Relacionadas</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="tablaDataconrelacion"></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <a href="mn_cuentacobro1.php" type="button" class="btn btn-secondary">Regresar <i class="fas fa-angle-double-left"></i></a>
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatasinrelacion").load("tablafacturasinrelacion.php");
        $("#tablaDataconrelacion").load("tablafacturaconrelacion.php");
    });
</script>


<script type="text/javascript">
    function seleccionar(idfac,numerofac,idccob){
        alertify.confirm('Relacionar Factura', 'Desea adicionar la factura '+numerofac+' a la cuenta de cobro?', 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:{idfac:idfac,idccob:idccob},
                    url:"procesos/relacionarfactura.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatasinrelacion").load("tablafacturasinrelacion.php");
                            $("#tablaDataconrelacion").load("tablafacturaconrelacion.php");
                            //alertify.success("Registro Eliminado!");
                        }
                        /*else{
                            alertify.error("Registro NO Eliminado!");
                        }*/
                    }
                })

            }
            ,function(){

            });
    }

    function quitar(idfac,numerofac){
        alertify.confirm('Retirar de la Cuenta', 'Desea retirar la factura '+numerofac+' de la cuenta de cobro?', 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:{idfac:idfac},
                    url:"procesos/quitarrelacion.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatasinrelacion").load("tablafacturasinrelacion.php");
                            $("#tablaDataconrelacion").load("tablafacturaconrelacion.php");
                            //alertify.success("Registro Eliminado!");
                        }
                        /*else{
                            alertify.error("Registro NO Eliminado!");
                        }*/
                    }
                })

            }
            ,function(){

            });
    }
    
</script>