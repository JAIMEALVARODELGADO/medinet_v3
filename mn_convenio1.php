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
                        <h4>Convenios</h4>
                    </div>
                    <div class="card-body">
                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoconvenio" title="Agrega Nuevo Convenio">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDataconvenio"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="nuevoconvenio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Convenio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>EPS</label>
                        <select class="form-control" id="id_eps" name="id_eps">
                            
                        </select>
                        <label>Número de Convenio</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="numero_conv" name="numero_conv">
                        <label>Fecha</label>
                        <input type="date" class="form-control input-sm" id="fecha_conv" name="fecha_conv">
                        <label>Observación</label>
                        <input type="text" maxlength="150" class="form-control input-sm" id="observacion_conv" name="observacion_conv">
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Convenio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_convenio" name="id_convenio">

                        <label>EPS</label>
                        <select class="form-control" id="id_epsU" name="id_epsU" disabled="true">
                            
                        </select>
                        <label>Número de Convenio</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="numero_convU" name="numero_convU">
                        <label>Fecha</label>
                        <input type="date" class="form-control input-sm" id="fecha_convU" name="fecha_convU">
                        <label>Observación</label>
                        <input type="text" maxlength="150" class="form-control input-sm" id="observacion_convU" name="observacion_convU">

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

<form name="frm_convenio" action="mn_convenio11.php" method="POST">
    <input type="hidden" id="id_conveniopasar" name="id_conveniopasar">
</form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDataconvenio").load("tablaconvenio.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarconvenio.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataconvenio").load("tablaconvenio.php");
                        
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
                url:"procesos/actualizarconvenio.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataconvenio").load("tablaconvenio.php");
                        alertify.success("Registro guardado");
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });

        $.ajax({
            type:"POST",
            url:'procesos/lista_eps.php',
            data:{'peticion':'cargar_listas'}
        })

        .done(function(listas_rep){            
            $('#id_eps').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        .done(function(listas_rep){            
            $('#id_epsU').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

    });
</script>

<script type="text/javascript">
    function Actualizar(idconv){
        $.ajax({
            type:"POST",
            data:"idconv="+idconv,
            url:"procesos/obtenDatosconvenio.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#id_convenio').val(datos['id_convenio']);
                $('#numero_convU').val(datos['numero_conv']);
                $('#id_epsU').val(datos['id_eps']);
                $('#fecha_convU').val(datos['fecha_conv']);
                $('#observacion_convU').val(datos['observacion_conv']);
            }
        })
    }

    function eliminar(idconv,numero){
        alertify.confirm('Eliminar Convenioo', 'Desea Eliminar el Convenio Nro? '+numero, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idconv="+idconv,
                    url:"procesos/eliminarconvenio.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDataconvenio").load("tablaconvenio.php");
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
    
    function cambiarestado(idconv){
        $.ajax({
            type:"POST",
            data:"idconv="+idconv,
            url:"procesos/cambiarestadoconvenio.php",
            success:function(r){
                if(r==1){
                    $("#tablaDataconvenio").load("tablaconvenio.php");
                    alertify.success("Estado Actualizado!");
                }else{
                    alertify.error("Estado Sin Actualizar!");
                }
            }
        })

    }

    function portafolio(idconv){
        $('#id_conveniopasar').val(idconv);        
        document.frm_convenio.submit();
    }
</script>