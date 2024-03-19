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
                        <h4>Registro de Pacientes</h4>
                    </div>
                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#nuevopersona" title="Agrega Nueva Persona">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaData"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="nuevopersona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Persona</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Tipo de Identificación</label>
                        <select class="form-control" id="tipo_iden_per" name="tipo_iden_per">
                            
                        </select>
                        <label>Número de Identificación</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="numero_iden_per" name="numero_iden_per">
                        <label>Primer Nombre</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="pnom_per" name="pnom_per">
                        <label>Segundo Nombre</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="snom_per" name="snom_per">
                        <label>Primer Apellido</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="pape_per" name="pape_per">
                        <label>Segundo Apellido:</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="sape_per" name="sape_per">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" class="form-control input-sm" id="fnac_per" name="fnac_per">
                        <label>Sexo</label>
                        <select class="form-control" id="sexo_per" name="sexo_per">
                            
                        </select>
                        <label>Direccion</label>
                        <input type="text" maxlength="50" class="form-control input-sm" id="direccion_per" name="direccion_per">
                        <label>Teléfono</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="telefono_per" name="telefono_per">
                        <label>Correo Electrónico</label>
                        <input type="email" maxlength="120" class="form-control input-sm" id="email_per" name="email_per">
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Persona</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="idpersona" name="idpersona">
                        <label>Tipo de Identificación</label>
                        <select class="form-control" id="tipo_iden_perU" name="tipo_iden_perU">
                            
                        </select>
                        <label>Número de Identificación</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="numero_iden_perU" name="numero_iden_perU">
                        <label>Primer Nombre</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="pnom_perU" name="pnom_perU">
                        <label>Segundo Nombre</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="snom_perU" name="snom_perU">
                        <label>Primer Apellido</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="pape_perU" name="pape_perU">
                        <label>Segundo Apellido:</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="sape_perU" name="sape_perU">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" class="form-control input-sm" id="fnac_perU" name="fnac_perU">
                        <label>Sexo</label>
                        <select class="form-control" id="sexo_perU" name="sexo_perU">
                            
                        </select>
                        <label>Direccion</label>
                        <input type="text" maxlength="50" class="form-control input-sm" id="direccion_perU" name="direccion_perU">
                        <label>Teléfono</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="telefono_perU" name="telefono_perU">
                        <label>Correo Electrónico</label>
                        <input type="email" maxlength="120" class="form-control input-sm" id="email_perU" name="email_perU">

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Paciente-->
    <div class="modal fade" id="modalPaciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Informacion del Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_paciente">
                        <input type="hidden" id="idpersona_pac" name="idpersona_pac">
                        <label>Municipio</label>
                        <select class="form-control" id="codigo_munU" name="codigo_munU">
                            
                        </select>

                        <label>Zona</label>
                        <select class="form-control" id="zonaU" name="zonaU">
                            <option value=""></option>
                            <option value="U">Urbana</option>
                            <option value="R">Rural</option>
                        </select>

                        <label>Tipo de Usuario</label>
                        <select class="form-control" id="tipo_usuarioU" name="tipo_usuarioU">
                            
                        </select>

                        <label>Pertenencia Etnica</label>
                        <select class="form-control" id="etniaU" name="etniaU">
                            
                        </select>

                        <label>Nivel Educativo</label>
                        <select class="form-control" id="nivel_educU" name="nivel_educU">
                            
                        </select>

                        <label>Profesión u Oficio</label>
                        <select class="form-control" id="id_ciuoU" name="id_ciuoU">
                            
                        </select>

                        <label>Estado Civil</label>
                        <select class="form-control" id="estado_civU" name="estado_civU">
                            
                        </select>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizarpaciente">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaData").load("tablapersona.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarpersona.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaData").load("tablapersona.php");
                        
                    }
                    else{
                        alertify.error("Error: Registro no guardado");
                    }
                }
            });
        });

        $('#btnActualizar').click(function(){
            datos=$('#frm_editar').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarpersona.php",
                success:function(r){
                    if(r==1){
                        $("#tablaData").load("tablapersona.php");
                        alertify.success("Registro guardado");
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });

        $('#btnActualizarpaciente').click(function(){
            datos=$('#frm_paciente').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarpaciente.php",
                success:function(r){
                    if(r==1){
                        $("#tablaData").load("tablapersona.php");
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
            url:'procesos/lista_tipodoc.php',
            data:{'peticion':'cargar_listas'}
        })

        .done(function(listas_rep){            
            $('#tipo_iden_per').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        .done(function(listas_rep){
            $('#tipo_iden_perU').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        $.ajax({
            type:"POST",
            url:'procesos/lista_sexo.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#sexo_per').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })
        .done(function(listas_rep){
            $('#sexo_perU').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        $.ajax({
            type:"POST",
            url:'procesos/lista_municipio.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#codigo_munU').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        $.ajax({
            type:"POST",
            url:'procesos/lista_tipousuario.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#tipo_usuarioU').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        $.ajax({
            type:"POST",
            url:'procesos/lista_etnia.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#etniaU').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        $.ajax({
            type:"POST",
            url:'procesos/lista_niveledu.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#nivel_educU').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        $.ajax({
            type:"POST",
            url:'procesos/lista_ocupacion.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#id_ciuoU').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        $.ajax({
            type:"POST",
            url:'procesos/lista_estadociv.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#estado_civU').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

    }); 

</script>

<script type="text/javascript">
    function agregaFrmActualizar(idpersona){
        $.ajax({
            type:"POST",
            data:"idpersona="+idpersona,
            url:"procesos/obtenDatospersona.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#idpersona').val(datos['id_persona']);
                $('#tipo_iden_perU').val(datos['tipo_iden_per']);
                $('#numero_iden_perU').val(datos['numero_iden_per']);
                $('#pnom_perU').val(datos['pnom_per']);
                $('#snom_perU').val(datos['snom_per']);
                $('#pape_perU').val(datos['pape_per']);
                $('#sape_perU').val(datos['sape_per']);
                $('#fnac_perU').val(datos['fnac_per']);
                $('#sexo_perU').val(datos['sexo_per']);
                $('#direccion_perU').val(datos['direccion_per']);
                $('#telefono_perU').val(datos['telefono_per']);
                $('#email_perU').val(datos['email_per']);
            }
        })
    }

    function agregaFrmPaciente(idpersona){
        $.ajax({
            type:"POST",
            data:"idpersona="+idpersona,
            url:"procesos/obtenDatospaciente.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#idpersona_pac').val(datos['id_persona']);
                $('#codigo_munU').val(datos['codigo_mun']);
                $('#zonaU').val(datos['zona']);
                $('#tipo_usuarioU').val(datos['tipo_usuario']);
                $('#etniaU').val(datos['etnia']);
                $('#nivel_educU').val(datos['nivel_educ']);
                $('#id_ciuoU').val(datos['id_ciuo']);
                $('#estado_civU').val(datos['estado_civ']);                
            }
        })
    }
</script>
