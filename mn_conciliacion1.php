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

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Conciliaciones</h4>
                    </div>
                    <div class="card-body">
                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevaconcil" title="Agrega Nueva Conciliación">
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
    <div class="modal fade" id="nuevaconcil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Conciliación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
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
                        <label for="fecha_conciliacionF">Fecha de Conciliación</label>
                        <input type="date" class="form-control input-sm" id="fecha_conciliacionF" name="fecha_conciliacionF">
                        <input type="hidden" id="fecha_conciliacion" name="fecha_conciliacion">
                        <label for="fecha_firma_concilF">Fecha de Firma de Conciliación</label>
                        <input type="date" class="form-control input-sm" id="fecha_firma_concilF" name="fecha_firma_concilF">
                        <input type="hidden" id="fecha_firma_concil" name="fecha_firma_concil">
                        <label>Valor a Conciliar</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_conciliar" name="valor_conciliar" value='0'>
                        <label>Valor a Favor de la Entidad</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_entidad" name="valor_entidad" value='0'>
                        <label>Valor a Favor de la EPS</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_eps" name="valor_eps" value='0'>
                        <label>Valor Ratificado</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_ratificado" name="valor_ratificado" value='0'>
                        <label>Observación</label>
                        <textarea class="form-control input-sm" id="observacion_concil" name="observacion_concil" rows="5"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnNuevo" class="btn btn-primary">Guardar <span class="fas fa-save"></span>                        
                    </button>                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Conciliación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_conciliacion" name="id_conciliacion">
                        <label>EPS</label>
                        <select class="form-control" id="id_epsU" name="id_epsU" disabled="true">
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
                        <input type="text" maxlength="80" class="form-control input-sm" id="facturaU" name="facturaU" disabled="true">
                        <input type="hidden" id="id_facturaU" name="id_facturaU">
                        <label for="fecha_conciliacionF">Fecha de Conciliación</label>
                        <input type="date" class="form-control input-sm" id="fecha_conciliacionFE" name="fecha_conciliacionFE">
                        <input type="hidden" id="fecha_conciliacionU" name="fecha_conciliacionU">
                        <label for="fecha_firma_concilF">Fecha de Firma de Conciliación</label>
                        <input type="date" class="form-control input-sm" id="fecha_firma_concilFE" name="fecha_firma_concilFE">
                        <input type="hidden" id="fecha_firma_concilU" name="fecha_firma_concilU">
                        <label>Valor a Conciliar</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_conciliarU" name="valor_conciliarU" value='0'>
                        <label>Valor a Favor de la Entidad</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_entidadU" name="valor_entidadU" value='0'>
                        <label>Valor a Favor de la EPS</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_epsU" name="valor_epsU" value='0'>
                        <label>Valor Ratificado</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_ratificadoU" name="valor_ratificadoU" value='0'>
                        <label>Observación</label>
                        <textarea class="form-control input-sm" id="observacion_concilU" name="observacion_concilU" rows="5"></textarea>                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal abonos -->
    <div class="modal fade" id="modal_abonos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Abonos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="tablaDataabonos"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>                     
                </div>
            </div>
        </div>
    </div>

<form name="frm_conciliacion" action="mn_conciliacion11.php" method="POST">
    
</form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaData").load("tablaconciliacion.php");
        //$("#tablaDataabonos").load("tablaabono_consulta.php");
    });
</script>

<script type="text/javascript">
    function validar(){
        err="";
        valido=1;        
        if($('#id_eps').val()==''){err+="EPS\n";}
        if($('#id_factura').val()==''){err+="Número de Factura\n";}
        if($('#fecha_conciliacionF').val()==''){err+="Fecha de Conciliación\n";}
        if($('#fecha_firma_concilF').val()==''){err+="Fecha de Firma de Conciliación\n";}
        if($('#valor_conciliar').val()==''){err+="Valor a Conciliar\n";}
        if($('#valor_entidad').val()==''){err+="Valor a Favor de la Entidad\n";}
        if($('#valor_eps').val()==''){err+="Valor a Favor de la EPS\n";}
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
            valido=0;
        }       
        return(valido);
    }

    $(document).ready(function(){        
        $("#btnNuevo").click(function(){
            if(validar()==1){
                $('#fecha_conciliacion').val($('#fecha_conciliacionF').val());
                $('#fecha_firma_concil').val($('#fecha_firma_concilF').val());
                datos=$('#frm_nuevo').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregarconcil.php",
                    success:function(r){
                        if(r==1){
                            alertify.success("Registro guardado");
                            $('#frm_nuevo')[0].reset();
                            $("#tablaData").load("tablaconciliacion.php");
                        }
                        else{
                            alertify.error("Error: El registro no guardado");
                        }
                    }
                });
            }
        });
        
        $('#btnActualizar').click(function(){
            $('#fecha_conciliacionU').val($('#fecha_conciliacionFE').val());
            $('#fecha_firma_concilU').val($('#fecha_firma_concilFE').val());            
            datos=$('#frm_editar').serialize();
            $.ajax({                
                type:"POST",
                data:datos,
                url:"procesos/actualizarconciliacion.php",
                success:function(r){
                    if(r==1){
                        $("#tablaData").load("tablaconciliacion.php");
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
    function Actualizar(idconcil){
        $.ajax({            
            type:"POST",
            data:"idconcil="+idconcil,
            url:"procesos/obtenDatosconciliacion.php",
            success:function(r){
                //datos=jQuery.parseJSON(r);
                var datos = JSON.parse(r);
                $('#id_conciliacion').val(datos['id_conciliacion']);
                $('#id_epsU').val(datos['id_eps']);
                $('#id_facturaU').val(datos['id_factura']);
                $('#fecha_conciliacionFE').val(datos['fecha_conciliacion']);
                $('#fecha_firma_concilFE').val(datos['fecha_firma_concil']);                
                $('#valor_conciliarU').val(datos['valor_conciliar']);
                $('#valor_entidadU').val(datos['valor_entidad']);
                $('#valor_epsU').val(datos['valor_eps']);
                $('#valor_ratificadoU').val(datos['valor_ratificado']);
                $('#observacion_concilU').val(datos['observacion_concil']);                
                $('#facturaU').val(datos['numero_fac']);
            }
        })
    }

    function eliminar(idconcil,numero){
        alertify.confirm('Eliminar Conciliación', 'Desea eliminar la conciliación de la factura '+numero, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idconcil="+idconcil,
                    url:"procesos/eliminarconciliacion.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaData").load("tablaconciliacion.php");
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
    
    function cerrar(idconcil,factura){
        alertify.confirm('Cerrar Conciliación', 'Una conciliación cerrada no podrá modificarse. Desea cerrar la conciliación de la factura '+factura+'?',
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idconcil="+idconcil,
                    url:"procesos/cerrarconciliacion.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaData").load("tablaconciliacion.php");
                            alertify.success("Conciliación Cerrada!");
                        }else{
                            alertify.error("Conciliación NO Cerrada!");
                        }
                    }
                })
            }
            ,function(){

            });
    }

    function actualizar_fac(idfac){
        //$('#id_fac').val(idfac);
                
        <?php           
            $_SESSION['gid_fac'] = "<script>idfac</script>";            
        ?>
        $("#tablaDataabonos").load("tablaabono_consulta.php");
        
    }
</script>