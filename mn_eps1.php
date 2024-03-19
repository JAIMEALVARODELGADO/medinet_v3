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
                        <h4>Registro de EPSs</h4>
                    </div>
                    <div class="card-body">
                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoeps" title="Agrega Nueva Eps">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDatatable"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="nuevoeps" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva EPS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Código de la EPS:</label>
                        <input type="text" maxlength="6" class="form-control input-sm" id="codigo_eps" name="codigo_eps">
                        <label>NIT de la EPS:</label>
                        <input type="text" maxlength="12" class="form-control input-sm" id="nit_eps" name="nit_eps">
                        <label>Nombre:</label>
                        <input type="text" maxlength="60" class="form-control input-sm" id="nombre_eps" name="nombre_eps">
                        <label>Dirección:</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="direccion_eps" name="direccion_eps">
                        <label>Teléfono:</label>
                        <input type="text" maxlength="45" class="form-control input-sm" id="telefono_eps" name="telefono_eps">
                        <label>Nombre de la persona de contacto:</label>
                        <input type="text" maxlength="45" class="form-control input-sm" id="contacto_eps" name="contacto_eps">
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar EPS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="ideps" name="ideps">
                        <label>Código de la EPS:</label>
                        <input type="text" maxlength="6" class="form-control input-sm" id="codigo_epsU" name="codigo_epsU">
                        <label>NIT de la EPS:</label>
                        <input type="text" maxlength="12" class="form-control input-sm" id="nit_epsU" name="nit_epsU">
                        <label>Nombre:</label>
                        <input type="text" maxlength="60" class="form-control input-sm" id="nombre_epsU" name="nombre_epsU">
                        <label>Dirección:</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="direccion_epsU" name="direccion_epsU">
                        <label>Teléfono:</label>
                        <input type="text" maxlength="45" class="form-control input-sm" id="telefono_epsU" name="telefono_epsU">
                        <label>Nombre de la persona de contacto:</label>
                        <input type="text" maxlength="45" class="form-control input-sm" id="contacto_epsU" name="contacto_epsU">

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
        $("#tablaDatatable").load("tablaeps.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregareps.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDatatable").load("tablaeps.php");
                        
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
                url:"procesos/actualizareps.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDatatable").load("tablaeps.php");
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
    function agregaFrmActualizar(ideps){
        $.ajax({
            type:"POST",
            data:"ideps="+ideps,
            url:"procesos/obtenDatoseps.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#ideps').val(datos['id_eps']);
                $('#codigo_epsU').val(datos['codigo_eps']);
                $('#nit_epsU').val(datos['nit_eps']);
                $('#nombre_epsU').val(datos['nombre_eps']);
                $('#direccion_epsU').val(datos['direccion_eps']);
                $('#telefono_epsU').val(datos['telefono_eps']);
                $('#contacto_epsU').val(datos['contacto_eps']);
            }
        })
    }

    function eliminarDatos(ideps,nombeps){
        alertify.confirm('Eliminar EPS', 'Desea Eliminar esta EPS? '+nombeps, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"ideps="+ideps,
                    url:"procesos/eliminareps.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatatable").load("tablaeps.php");
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

</script>