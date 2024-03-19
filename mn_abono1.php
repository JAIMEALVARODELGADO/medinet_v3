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
                        <h4>Registro de Pagos/Abonos</h4>
                    </div>
                    <div class="card-body">
                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoabono" title="Agrega Nuevo Pago">
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
    <div class="modal fade" id="nuevoabono" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Abono</h5>
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
                        <label for="fecha_abonoF">Fecha del Abono</label>
                        <input type="date" class="form-control input-sm" id="fecha_abonoF" name="fecha_abonoF">
                        <input type="hidden" id="fecha_abono" name="fecha_abono">
                        <label>Documento</label>
                        <input type="text" maxlength="45" class="form-control input-sm" id="documento_abono" name="documento_abono" placeholder="Documento con el cual se registra el abono">
                        <label>Valor del Abono</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_abono" name="valor_abono" value='0'>
                        <label>Días en Mora</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="dias_mora_abono" name=" dias_mora_abono" value='0'>
                        <label>Observación</label>
                        <textarea class="form-control input-sm" id="observacion_abono" name="observacion_abono" rows="5"></textarea>
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
                        <input type="hidden" id="id_abono" name="id_abono">
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
                        <label for="fecha_abonoFE">Fecha del Abono</label>
                        <input type="date" class="form-control input-sm" id="fecha_abonoFE" name="fecha_abonoFE">
                        <input type="hidden" id="fecha_abonoU" name="fecha_abonoU">
                        <label>Documento</label>
                        <input type="text" maxlength="45" class="form-control input-sm" id="documento_abonoU" name="documento_abonoU" placeholder="Documento con el cual se registra el abono">
                        <label>Valor del Abono</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="valor_abonoU" name="valor_abonoU" value='0'>
                        <label>Días en Mora</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="dias_mora_abonoU" name=" dias_mora_abonoU" value='0'>
                        <label>Observación</label>
                        <textarea class="form-control input-sm" id="observacion_abonoU" name="observacion_abonoU" rows="5"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

<form name="frm_abono" action="mn_abono11.php" method="POST">
    
</form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaData").load("tablaabono.php");
    });
</script>

<script type="text/javascript">
    function validar(){
        err="";
        valido=1;        
        if($('#id_eps').val()==''){err+="EPS\n";}
        if($('#id_factura').val()==''){err+="Número de Factura\n";}
        if($('#fecha_abonoF').val()==''){err+="Fecha del Abono\n";}        
        if($('#valor_abono').val()==''){err+="Valor del Abono\n";}
        if($('#valor_abono').val()=='0'){err+="Valor del Abono\n";}
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
            valido=0;
        }        
        return(valido);
    }

    $(document).ready(function(){        
        $("#btnNuevo").click(function(){
            if(validar()==1){
                $('#fecha_abono').val($('#fecha_abonoF').val());
                datos=$('#frm_nuevo').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregarabono.php",
                    success:function(r){
                        if(r==1){
                            alertify.success("Registro guardado");
                            $('#frm_nuevo')[0].reset();
                            $("#tablaData").load("tablaabono.php");
                        }
                        else{
                            alertify.error("Error: El registro no guardado");
                        }
                    }
                });
            }
        });
        
        $('#btnActualizar').click(function(){
            $('#fecha_abonoU').val($('#fecha_abonoFE').val());            
            datos=$('#frm_editar').serialize();
            $.ajax({                
                type:"POST",
                data:datos,
                url:"procesos/actualizarabono.php",
                success:function(r){
                    if(r==1){
                        $("#tablaData").load("tablaabono.php");
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
    function Actualizar(idabono){
        $.ajax({
            type:"POST",
            data:"idabono="+idabono,
            url:"procesos/obtenDatosabono.php",
            success:function(r){
                //datos=jQuery.parseJSON(r);
                var datos = JSON.parse(r);
                $('#id_abono').val(datos['id_abono']);
                $('#id_epsU').val(datos['id_eps']);
                $('#id_facturaU').val(datos['id_factura']);
                $('#fecha_abonoFE').val(datos['fecha_abono']);
                $('#documento_abonoU').val(datos['documento_abono']);                
                $('#valor_abonoU').val(datos['valor_abono']);
                $('#dias_mora_abonoU').val(datos['dias_mora_abono']);
                $('#observacion_abonoU').val(datos['observacion_abono']);
                $('#facturaU').val(datos['numero_fac']);
            }
        })
    }

    function eliminar(idabono,numero){
        alertify.confirm('Eliminar Abono', 'Desea eliminar el abono a la factura '+numero, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idabono="+idabono,
                    url:"procesos/eliminarabono.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaData").load("tablaabono.php");
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
    
    function cerrar(idabono,factura){
        alertify.confirm('Cerrar Abono', 'Una abono cerrado no podrá modificarse. Desea cerrar el abono de la factura '+factura+'?',
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idabono="+idabono,
                    url:"procesos/cerrarabono.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaData").load("tablaabono.php");
                            alertify.success("Abono Cerrado!");
                        }else{
                            alertify.error("Abono NO Cerrado!");
                        }
                    }
                })
            }
            ,function(){

            });
    }
</script>