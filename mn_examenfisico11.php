<?php
require("valida_sesion.php");
if(isset($_POST['idmef'])){
    $_SESSION['gid_mef']=$_POST['idmef'];
}
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$consultaexamen="SELECT descripcion_mef FROM mae_examenfisico WHERE id_mef='$_SESSION[gid_mef]'";
$consultaexamen=mysqli_query($conexion,$consultaexamen);
$row=mysqli_fetch_row($consultaexamen);
$descripcion_mef=$row[0];
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
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Detalles del Examen Físico</h4>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label"><h5><?php echo $descripcion_mef;?></h5></label>
                    </div>

                    <div class="card-body">
                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoitem" title="Agrega Nuevo Item al Examen Físico">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDatadetalle"></div>
                    </div>
                    
                    <div class="modal-footer">
                        <a href="mn_examenfisico1.php" type="button" class="btn btn-secondary">Regresar <i class="fas fa-angle-double-left"></i></a>
                    </div>

                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="nuevoitem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Descripción</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="descripcion_def" name="descripcion_def">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnNuevo" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_def" name="id_def">

                        <label>Descripción</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="descripcion_defU" name="descripcion_defU">
                    </form>
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatadetalle").load("tabladetalleef.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregardetalleef.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDatadetalle").load("tabladetalleef.php");                        
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });

        $('#btnActualizar').click(function(){
            datos=$('#frm_editar').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizardetalleef.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDatadetalle").load("tabladetalleef.php");
                        alertify.success("Registro guardado");
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });
    });
</script>

<script type="text/javascript">
    function Actualizar(iddef){
        $.ajax({
            type:"POST",
            data:"iddef="+iddef,
            url:"procesos/obtenDatosdetallef.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#id_def').val(datos['id_def']);
                $('#descripcion_defU').val(datos['descripcion_def']);
            }
        })
    }

    function eliminar(iddef,descrip){
        alertify.confirm('Eliminar Detalle', 'Desea Eliminar? '+descrip, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"iddef="+iddef,
                    url:"procesos/eliminardetalleef.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatadetalle").load("tabladetalleef.php");
                            alertify.success("Registro Eliminado!");
                        }else{
                            alertify.error("Registro NO Eliminado!");
                        }
                    }
                })

            }
            ,function(){

            });
    }

    function cambiarestado(idcdet){
        $.ajax({
            type:"POST",
            data:"idcdet="+idcdet,
            url:"procesos/cambiarestadoact_convenio.php",
            success:function(r){
                if(r==1){
                    $("#tablaDataportafolio").load("tablaact_convenio.php");
                    alertify.success("Estado Actualizado!");
                }else{
                    alertify.error("Estado Sin Actualizar!");
                }
            }
        })

    }
</script>