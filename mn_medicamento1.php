<?php
require("valida_sesion.php");
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
    <?php
    require("encabezado.php");
    require("menu.php")
    ?>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Medicamentos / Dispositivos / Servicios</h4>
                    </div>
                    
                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#modalnuevomed" title="Agrega Nueva Enfermedad">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDatamed"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Modal Nuevo -->
    <div class="modal fade" id="modalnuevomed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un Item al Catálogo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Código</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="codigoatc_mto" name="codigoatc_mto">
                        <label>Nombre</label>
                        <input type="text" maxlength="150" class="form-control input-sm" id="nombre_mto" name="nombre_mto">
                        <label>Tipo</label>
                            <select class="form-control" id="tipo_mto" name="tipo_mto">
                                <option value='M'>Medicamento</option>
                                <option value='D'>Dispositivo</option>
                                <option value='P'>Paquete</option>
                                <option value='S'>Servicio</option>
                            </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnNuevo" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modaleditarmed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Item del Catálogo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <label>Código ATC</label>
                        <input type="hidden" id="id_medicamento" name="id_medicamento">               
                        <input type="text" maxlength="10" class="form-control input-sm" id="codigoatc_mtoU" name="codigoatc_mtoU">
                        <label>Nombre</label>
                        <input type="text" maxlength="150" class="form-control input-sm" id="nombre_mtoU" name="nombre_mtoU">
                        <label>Tipo</label>
                            <select class="form-control" id="tipo_mtoU" name="tipo_mtoU">
                                <option value='M'>Medicamento</option>
                                <option value='D'>Dispositivo</option>
                                <option value='P'>Paquete</option>
                                <option value='S'>Servicio</option>
                            </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnActualizar" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

<form name="frm_convenio" action="mn_medicamento11.php" method="POST">
    <input type="hidden" id="id_medicamentopasar" name="id_medicamentopasar">
</form>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatamed").load("tablamed.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarmedicamento.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDatamed").load("tablamed.php");                        
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
                url:"procesos/actualizarmedicamento.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDatamed").load("tablamed.php");
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
    function FrmActualizar(idmed){
        $.ajax({
            type:"POST",
            data:"idmed="+idmed,
            url:"procesos/obtenDatosmedicamento.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#id_medicamento').val(datos['id_medicamento']);
                $('#codigoatc_mtoU').val(datos['codigoatc_mto']);
                $('#nombre_mtoU').val(datos['nombre_mto']);
                $('#tipo_mtoU').val(datos['tipo_mto']);
            }
        })
    }

    function cambiarestado(idmed){
        $.ajax({
            type:"POST",
            data:"idmed="+idmed,
            url:"procesos/cambiarestadomedicamento.php",
            success:function(r){
                if(r==1){
                    $("#tablaDatamed").load("tablamed.php");
                    alertify.success("Estado Actualizado!");
                }else{
                    alertify.error("Estado Sin Actualizar!");
                }
            }
        })

    }

    function paquete(idmto){        
        $('#id_medicamentopasar').val(idmto);        
        document.frm_convenio.submit();
    }

</script>
