<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php 
        require_once "scripts.php";        
    ?>  
    <!--<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
    <script type="text/javascript" src="../librerias/js/jquery.js"></script>
    <script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>-->
</head>

<body>
    <?php
    require("encabezado.php");
    require("menu.php")
    ?>
    
    <div class="card text">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="mn_furips1.php">Formulario FURIPS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Propietarios/Conductores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mn_furips3.php">Listado de Furips</a>
                </li>               
            </ul>
        </div>    
        <br>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card text-left">
                        <div class="card-header">
                            <h4>Propietarios/Conductores</h4>
                        </div>                    
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="numero_ident" class="col-sm-3 col-form-label">Numero de Identificación:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="numero_ident" name="numero_ident" onblur="actualizar()">
                                </div>

                                <label for="nombre_per" class="col-sm-2 col-form-label">Nombre:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="nombre_per" name="nombre_per" onblur="actualizar()">
                                </div>                                
                            </div>
                            <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevapersona" title="Agrega Nueva Persona">
                            Nuevo <span class="fas fa-plus-circle"></span>
                            </span>
                            <hr>
                            <div id="tablaDatafurips_persona"></div>
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
    <div class="modal fade" id="nuevapersona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <select class="form-control" id="tipo_ident" name="tipo_ident">
                            
                        </select>
                        <label>Número de Identificación</label>
                        <input type="text" maxlength="16" class="form-control input-sm" id="numero_ident" name="numero_ident">
                        <label>Primer Nombre</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="pnom_per" name="pnom_per">
                        <label>Segundo Nombre</label>
                        <input type="text" maxlength="30" class="form-control input-sm" id="snom_per" name="snom_per">
                        <label>Primer Apellido</label>
                        <input type="text" maxlength="40" class="form-control input-sm" id="pape_per" name="pape_per">
                        <label>Segundo Apellido</label>
                        <input type="text" maxlength="30" class="form-control input-sm" id="sape_per" name="sape_per">
                        <label>Dirección</label>
                        <input type="text" maxlength="40" class="form-control input-sm" id="direccion_per" name="direccion_per">
                        <label>Teléfono</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="telefono_per" name="telefono_per">
                        <label>Municipio de Residencia</label>
                        <select class="form-control" id="municipio_per" name="municipio_per">
                            
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

    <!-- Modal Editar-->
    <div class="modal fade" id="Editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <select class="form-control" id="tipo_identU" name="tipo_identU">
                            
                        </select>
                        <label>Número de Identificación</label>
                        <input type="text" maxlength="16" class="form-control input-sm" id="numero_identU" name="numero_identU">
                        <label>Primer Nombre</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="pnom_perU" name="pnom_perU">
                        <label>Segundo Nombre</label>
                        <input type="text" maxlength="30" class="form-control input-sm" id="snom_perU" name="snom_perU">
                        <label>Primer Apellido</label>
                        <input type="text" maxlength="40" class="form-control input-sm" id="pape_perU" name="pape_perU">
                        <label>Segundo Apellido</label>
                        <input type="text" maxlength="30" class="form-control input-sm" id="sape_perU" name="sape_perU">
                        <label>Dirección</label>
                        <input type="text" maxlength="40" class="form-control input-sm" id="direccion_perU" name="direccion_perU">
                        <label>Teléfono</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="telefono_perU" name="telefono_perU">
                        <label>Municipio de Residencia</label>
                        <select class="form-control" id="municipio_perU" name="municipio_perU">
                            
                        </select>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

    <form id="frm_furips_persona" name="frm_furips_persona" method="POST">
        <input type="hidden" id="condicion" name="condicion">        
    </form>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarfurips_persona.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDatafurips_persona").load("tablafurips_persona.php");                        
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
                url:"procesos/actualizarfurips_persona.php",
                success:function(r){
                    if(r==1){                        
                        $("#tablaDatafurips_persona").load("tablafurips_persona.php");
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
            $('#tipo_ident').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })
        .done(function(listas_rep){            
            $('#tipo_identU').html(listas_rep)
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
            $('#municipio_per').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })
        .done(function(listas_rep){            
            $('#municipio_perU').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })
    });
</script>

<script type="text/javascript">
    function editar(idpersona){
        $.ajax({
            type:"POST",
            data:"idpersona="+idpersona,
            url:"procesos/obtenDatosfurips_persona.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#idpersona').val(datos['id_persona']);
                $('#tipo_identU').val(datos['tipo_ident']);
                $('#numero_identU').val(datos['numero_ident']);
                $('#pape_perU').val(datos['pape_per']);
                $('#sape_perU').val(datos['sape_per']);
                $('#pnom_perU').val(datos['pnom_per']);
                $('#snom_perU').val(datos['snom_per']);
                $('#direccion_perU').val(datos['direccion_per']);
                $('#telefono_perU').val(datos['telefono_per']);
                $('#municipio_perU').val(datos['municipio_per']);
            }
        })
    }

    function actualizar(){        
        //condicion="esta_fac<>'A'";
        condicion="";
        if($('#numero_ident').val()!=""){
           condicion+=" AND numero_ident='"+$('#numero_ident').val()+"'";
        }
        if($('#nombre_per').val()!=""){
           condicion+=" AND nombre_per LIKE '%"+$('#nombre_per').val()+"%'";
        }
        condicion=condicion.substring(5);
        
        $('#condicion').val(condicion);
        $(document).ready(function(){
            datos=$('#frm_furips_persona').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarfurips.php",
                
            });
            $("#tablaDatafurips_persona").load("tablafurips_persona.php");
        });
    }
    
</script>
