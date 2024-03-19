<?php
require("valida_sesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>
    <link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
    <script type="text/javascript" src="../librerias/js/jquery.js"></script>
    <script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>
</head>

<body>
    <?php
    require("encabezado.php");
    require("menu.php");
    ?>
    <div class="card text">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Glosas Abiertas</a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link" href="mn_glosa2.php">Glosas Cerradas</a>
                </li>               
            </ul>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card text-left">
                        <div class="card-header">
                            <h4>Registro/Actualización de Glosas</h4>
                        </div>
                        <div class="card-body">
                            <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoglosa" title="Agrega Nueva Glosa">
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
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="nuevoglosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Glosa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label for="fecharecep_gloF">Fecha de Recepción</label>
                        <input type="date" class="form-control input-sm" id="fecharecep_gloF" name="fecharecep_gloF">
                        <input type="hidden" id="fecharecep_glo" name="fecharecep_glo">
                        <label>EPS</label>
                        <select class="form-control" id="id_eps" name="id_eps">
                            <option value=''></option>
                            <?php                                   
                                $sql="SELECT id_eps,nombre_eps FROM eps ORDER BY nombre_eps";
                                $result=mysqli_query($conexion,$sql);
                                while($row=mysqli_fetch_row($result)){
                                    echo "<option value='$row[0]'>$row[1]</option>";
                                }
                            ?>
                        </select>
                        <label>Número de Factura</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="factura" name="factura">
                        <input type="hidden" id="id_factura" name="id_factura">
                        <label>Valor de la Glosa</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_glo" name="valor_glo" value='0'>
                        <label>Motivo de Glosa</label>
                        <textarea class="form-control input-sm" id="motivo_glo" name="motivo_glo" rows="5"></textarea>
                        <label>Fecha de Entrega</label>
                        <input type="date" class="form-control input-sm" id="fechaentrega_gloF" name="fechaentrega_gloF">
                        <input type="hidden" id="fechaentrega_glo" name="fechaentrega_glo">
                        <label>Responsable de Responder la Glosa</label>
                        <select class="form-control" id="responsable_resp_glo" name="responsable_resp_glo">
                            <option value=''></option>
                            <?php                                   
                                $sql="SELECT vw_usuario.id_persona,nombre FROM vw_usuario INNER JOIN concepto_persona ON concepto_persona.id_persona=vw_usuario.id_persona WHERE estado_usu='A' GROUP BY vw_usuario.id_persona,nombre ORDER BY nombre";
                                $result=mysqli_query($conexion,$sql);
                                while($row=mysqli_fetch_row($result)){
                                    echo "<option value='$row[0]'>$row[1]</option>";
                                }
                            ?>
                        </select>
                        <label>Fecha de Envío de la Respuesta a la EPS</label>
                        <input type="date" class="form-control input-sm" id="fecha_envio_gloF" name="fecha_envio_gloF">
                        <input type="hidden" id="fecha_envio_glo" name="fecha_envio_glo">

                        <!--<label>Valor a Favor de la Entidad</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="valor_fav_glo" name="valor_fav_glo">
                        <label>Valor a Favor de la EPS</label>-->
                        <input type="hidden" maxlength="8" class="form-control input-sm" id="valor_fav_eps" name="valor_fav_eps">
                        <label>Guia con la que se Remite la Contestación</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="guia_glo" name="guia_glo">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnNuevo" class="btn btn-primary">Guardar <span class="fas fa-save"></span>
                    </button>
                    <!--onclick="validar()"-->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Glosa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_glosa" name="id_glosa">
                        <label for="fecharecep_gloFE">Fecha de Recepción</label>
                        <input type="date" class="form-control input-sm" id="fecharecep_gloFE" name="fecharecep_gloFE" disabled="ture">
                        <input type="hidden" id="fecharecep_gloU" name="fecharecep_gloU">
                        <label>EPS</label>
                        <select class="form-control" id="id_epsU" name="id_epsU" disabled="ture">
                            <option value=''></option>
                            <?php                                   
                                $sql="SELECT id_eps,nombre_eps FROM eps ORDER BY nombre_eps";
                                //echo $sql;
                                $result=mysqli_query($conexion,$sql);
                                while($row=mysqli_fetch_row($result)){
                                    echo "<option value='$row[0]'>$row[1]</option>";
                                }
                            ?>
                        </select>
                        <label>Número de Factura</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="facturaU" name="facturaU" disabled="ture">
                        <input type="hidden" id="id_facturaU" name="id_facturaU">
                        <label>Valor de la Glosa</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_gloU" name="valor_gloU">
                        <label>Motivo de Glosa</label>
                        <textarea class="form-control input-sm" id="motivo_gloU" name="motivo_gloU" rows="5"></textarea>
                        <label>Fecha de Entrega</label>
                        <input type="date" class="form-control input-sm" id="fechaentrega_gloFE" name="fechaentrega_gloFE">
                        <input type="hidden" id="fechaentrega_gloU" name="fechaentrega_gloU">
                        <label>Responsable de Responder la Glosa</label>
                        <select class="form-control" id="responsable_resp_gloU" name="responsable_resp_gloU">
                            <option value=''></option>
                            <?php                                   
                                $sql="SELECT vw_usuario.id_persona,nombre FROM vw_usuario INNER JOIN concepto_persona ON concepto_persona.id_persona=vw_usuario.id_persona WHERE estado_usu='A' GROUP BY vw_usuario.id_persona,nombre ORDER BY nombre";
                                $result=mysqli_query($conexion,$sql);
                                while($row=mysqli_fetch_row($result)){
                                    echo "<option value='$row[0]'>$row[1]</option>";
                                }
                            ?>
                        </select>
                        <label>Fecha de Envío de la Respuesta a la EPS</label>
                        <input type="date" class="form-control input-sm" id="fecha_envio_gloFE" name="fecha_envio_gloFE">
                        <input type="hidden" id="fecha_envio_gloU" name="fecha_envio_gloU">
                        <label>Valor a Favor de la Entidad</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="valor_fav_gloU" name="valor_fav_gloU" disabled="true">
                        <label>Valor a Favor de la EPS</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="valor_fav_epsU" name="valor_fav_epsU" disabled="true">
                        <label>Guia con la que se Remite la Contestación</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="guia_gloU" name="guia_gloU">
                        <label>Respuesta a la glosa</label>
                        <textarea class="form-control input-sm" id="respuesta_gloU" name="respuesta_gloU" rows="5"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

<form name="frm_glosa" action="mn_glosa11.php" method="POST">
    <input type="hidden" id="id_glosapasar" name="id_glosapasar">
</form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaData").load("tablaglosa.php");
    });
</script>

<script type="text/javascript">
    function validar(){
        err="";
        valido=1;
        if($('#fecharecep_gloF').val()==''){err+="Fecha de Recepción\n";}
        if($('#id_eps').val()==''){err+="EPS\n";}
        if($('#id_factura').val()==''){err+="Número de Factura\n";}        
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
            valido=0;
        }
        /*else{
            document.frm_consulta.fechanac_dp.value=document.frm_consulta.fechanac.value;
            guardar()
        }*/
        return(valido);
    }


    $(document).ready(function(){        
        $("#btnNuevo").click(function(){
            if(validar()==1){
                $('#fecharecep_glo').val($('#fecharecep_gloF').val());
                $('#fechaentrega_glo').val($('#fechaentrega_gloF').val());
                $('#fecha_envio_glo').val($('#fecha_envio_gloF').val());

                datos=$('#frm_nuevo').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregarglosa.php",
                    success:function(r){
                        if(r==1){
                            alertify.success("Registro guardado");
                            $('#frm_nuevo')[0].reset();
                            $("#tablaData").load("tablaglosa.php");
                        }
                        else{
                            alertify.error("Error: El registro no guardado");
                        }
                    }
                });
            }
        });
        //}

        $('#btnActualizar').click(function(){
            $('#fecharecep_gloU').val($('#fecharecep_gloFE').val());
            $('#fechaentrega_gloU').val($('#fechaentrega_gloFE').val());
            $('#fecha_envio_gloU').val($('#fecha_envio_gloFE').val());
            datos=$('#frm_editar').serialize();
            $.ajax({                
                type:"POST",
                data:datos,
                url:"procesos/actualizarglosa.php",
                success:function(r){
                    if(r==1){
                        $("#tablaData").load("tablaglosa.php");
                        alertify.success("Registro guardado");
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });        

        $("#factura").autocomplete("procesos/autocomp_factura.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#factura").result(function(event, data, formatted) {
            $("#id_factura").val(data[1]);
        });
    });
</script>

<script type="text/javascript">
    function Actualizar(idglosa){
        $.ajax({            
            type:"POST",
            data:"idglosa="+idglosa,
            url:"procesos/obtenDatosglosa.php",
            success:function(r){
                //datos=jQuery.parseJSON(r);
                var datos = JSON.parse(r);
                $('#id_glosa').val(datos['id_glosa']);
                $('#fecharecep_gloFE').val(datos['fecharecep_glo']);
                $('#fecharecep_gloU').val(datos['fecharecep_glo']);
                $('#id_epsU').val(datos['id_eps']);
                $('#id_facturaU').val(datos['id_factura']);
                $('#valor_gloU').val(datos['valor_glo']);
                $('#motivo_gloU').val(datos['motivo_glo']);
                $('#fechaentrega_gloU').val(datos['fechaentrega_glo']);
                $('#fechaentrega_gloFE').val(datos['fechaentrega_glo']);
                $('#responsable_resp_gloU').val(datos['responsable_resp_glo']);
                $('#fecha_envio_gloFE').val(datos['fecha_envio_glo']);
                $('#fecha_envio_gloU').val(datos['fecha_envio_glo']);
                $('#valor_fav_gloU').val(datos['valor_fav_glo']);
                $('#valor_fav_epsU').val(datos['valor_fav_eps']);
                $('#guia_gloU').val(datos['guia_glo']);
                $('#facturaU').val(datos['numero_fac']);
            }
        })
    }
    
    function cerrar(idglosa,factura){
        alertify.confirm('Cerrar Glosa', 'Una glosa cerrada no podrá modificarse. Desea cerrar la glosa de la factura '+factura+'?',
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idglosa="+idglosa,
                    url:"procesos/cerrarglosa.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaData").load("tablaglosa.php");
                            alertify.success("Glosa Cerrada!");
                        }else{
                            alertify.error("Glosa NO Cerrada!");
                        }
                    }
                })
            }
            ,function(){

            });
    }

    function seguimiento(idglosa){
        $('#id_glosapasar').val(idglosa);
        document.frm_glosa.submit();
    }

</script>