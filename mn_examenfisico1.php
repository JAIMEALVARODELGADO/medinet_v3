<?php
require("valida_sesion.php");
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
    require("menu.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Examen Físico</h4>
                    </div>
                    <div class="card-body">
                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoexamen" title="Agrega Examen Físico">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDataexamen"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="nuevoexamen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Examen Físico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Nombre del Grupo del Examen Físico</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="descripcion_mef" name="descripcion_mef">
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Examen Físco</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_mef" name="id_mef">
                        <label>Nombre del Grupo del Examen Físico</label>
                        <input type="text" maxlength="150" class="form-control input-sm" id="descripcion_mefU" name="descripcion_mefU">

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

<form name="frm_examen" action="mn_examenfisico11.php" method="POST">
    <input type="hidden" id="idmef" name="idmef">
</form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDataexamen").load("tablaexamen.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarexamenfisico.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataexamen").load("tablaexamen.php");
                        
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
                url:"procesos/actualizarexamen.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataexamen").load("tablaexamen.php");
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
    function agregaFrmActualizar(idmef){
        $.ajax({
            type:"POST",
            data:"idmef="+idmef,
            url:"procesos/obtenDatosexamen.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#id_mef').val(datos['id_mef']);
                $('#descripcion_mefU').val(datos['descripcion_mef']);
            }
        })
    }

    function eliminar(idmef,descrip){
        alertify.confirm('Eliminar Examen Físico', 'Desea Eliminar? '+descrip, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idmef="+idmef,
                    url:"procesos/eliminarexamen.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDataexamen").load("tablaexamen.php");
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
    
    function cambiarestado(idmef){
        $.ajax({
            type:"POST",
            data:"idmef="+idmef,
            url:"procesos/cambiarestadoexamen.php",
            success:function(r){
                if(r==1){
                    $("#tablaDataexamen").load("tablaexamen.php");
                    alertify.success("Estado Actualizado!");
                }else{
                    alertify.error("Estado Sin Actualizar!");
                }
            }
        })

    }

    function examen_detalle(idmef){
        $('#idmef').val(idmef);        
        document.frm_examen.submit();
    }
</script>