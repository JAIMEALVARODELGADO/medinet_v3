<?php
require("valida_sesion.php");
if(isset($_POST['id_glosapasar'])){
    $_SESSION['gid_glosa']=$_POST['id_glosapasar'];
}
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$consultaglosa="SELECT fecharecep_glo, nombre_eps, numero_fac, motivo_glo, valor_glo FROM vw_glosa WHERE id_glosa='$_SESSION[gid_glosa]'";
//echo $consultaglosa;
$consultaglosa=mysqli_query($conexion,$consultaglosa);
$row=mysqli_fetch_row($consultaglosa);
$fecharecep_glo=$row[0];
$nombre_eps=$row[1];
$numero_fac=$row[2];
$motivo_glo=$row[3];
$_SESSION['gvalor_glo']=$row[4];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>

    <!--<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
    <script type="text/javascript" src="../librerias/js/jquery.js"></script>
    <script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>-->

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
                        <h4>Seguimiento de Glosa</h4>
                    </div>

                    <div class="row">
                        <label class="col-sm-6 col-form-label"><b>Fecha de Recepción:</b> <?php echo $fecharecep_glo;?></label>
                        <label class="col-sm-6 col-form-label"><b>EPS:</b> <?php echo $nombre_eps;?></label>
                    </div>
                    <div class="row">
                        <label class="col-sm-6 col-form-label"><b>Número de Factura:</b> <?php echo $numero_fac;?></label>
                        <label class="col-sm-6 col-form-label"><b>Valor Glosado:</b> <?php echo $_SESSION['gvalor_glo'];?></label>
                    </div>
                    <div class="row">
                        <label class="col-sm-6 col-form-label"><b>Motivo de Glosa:</b> <?php echo $motivo_glo;?></label>
                    </div>                    
                    <div class="card-body">
                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoitem" title="Agrega Nueva Respuesta">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaData"></div>
                    </div>
                    
                    <div class="modal-footer">
                        <a href="mn_glosa1.php" type="button" class="btn btn-secondary">Regresar <i class="fas fa-angle-double-left"></i></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Respuesta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Detalle de la Factura</label>
                        <select class="form-control" id="id_detfac" name="id_detfac">
                            <option value=''></option>
                            
                        </select>
                        <label>Fecha</label>
                        <input type="date" class="form-control input-sm" id="fechacont_resp" name="fechacont_resp">
                        <label>Concepto de Glosa</label>
                        <select class="form-control" id="id_conglo" name="id_conglo">
                            <option value=''></option>
                            
                        </select>
                        <label>Valor Aceptado</label>
                        <input type="number" min="0" max="100000000" class="form-control input-sm" id="valoracepta_resp" name="valoracepta_resp" value='0'>
                        <label>Observación</label>
                        <textarea class="form-control input-sm" id="observacion_resp" name="observacion_resp" rows="5"></textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Respuesta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_resp" name="id_resp">

                        <label>Detalle de la Factura</label>
                        <select class="form-control" id="id_detfacU" name="id_detfacU">
                            <option value='0'></option>
                            
                        </select>
                        <label>Fecha</label>
                        <input type="date" class="form-control input-sm" id="fechacont_respU" name="fechacont_respU">
                        <label>Concepto de Glosa</label>
                        <select class="form-control" id="id_congloU" name="id_congloU">
                            <option value=''></option>
                            
                        </select>
                        <label>Valor Aceptado</label>
                        <input type="number" min="0" max="100000000" class="form-control input-sm" id="valoracepta_respU" name="valoracepta_respU" value='0'>
                        <label>Observación</label>
                        <textarea class="form-control input-sm" id="observacion_respU" name="observacion_respU" rows="5"></textarea>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>
    <!--<input type="text" name="numero_fac" id='numero_fac' value='<?php echo $numero_fac;?>'>-->
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaData").load("tablarespuesta_glosa.php");
    });
</script>

<script type="text/javascript">
    function validar(){
        err="";
        valido=1;
        if($('#fechacont_resp').val()==''){err+="Fecha\n";}
        if($('#id_conglo').val()==''){err+="Concepto de Glosa\n";}        
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
            valido=0;
        }
        return(valido);
    }

    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            if(validar()==1){
                datos=$('#frm_nuevo').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregar_respuestaglo.php",
                    success:function(r){
                        if(r==1){
                            alertify.success("Registro guardado");
                            $('#frm_nuevo')[0].reset();
                            $("#tablaData").load("tablarespuesta_glosa.php");
                        }
                        else{
                            alertify.error("Error: El registro no guardado");
                        }
                    }
                });
            }
        });

        $('#btnActualizar').click(function(){
            datos=$('#frm_editar').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizar_respuesta.php",
                success:function(r){
                    if(r==1){
                        $("#tablaData").load("tablarespuesta_glosa.php");
                        alertify.success("Registro guardado");
                    }
                    else{
                        alertify.error("Error: El registro no fué guardado");
                    }
                }
            });
        });        
        
        $.ajax({            
            type:"POST",
            url:'procesos/lista_detalle_fact.php?factura=<?php echo $numero_fac;?>',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#id_detfac').html(listas_rep);
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })
        .done(function(listas_rep){
            $('#id_detfacU').html(listas_rep);
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        $.ajax({            
            type:"POST",
            url:'procesos/lista_conceptoglosa.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#id_conglo').html(listas_rep);
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })
        .done(function(listas_rep){
            $('#id_congloU').html(listas_rep);
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

    });
</script>

<script type="text/javascript">
    function Actualizar(idresp){
        $.ajax({
            type:"POST",
            data:"idresp="+idresp,
            url:"procesos/obtenDatos_respuesta.php",
            success:function(r){                
                var datos = JSON.parse(r);
                $('#id_resp').val(datos['id_resp']);
                $('#id_detfacU').val(datos['id_detfac']);
                $('#fechacont_respU').val(datos['fechacont_resp']);
                $('#id_congloU').val(datos['id_conglo']);
                $('#valoracepta_respU').val(datos['valoracepta_resp']);
                $('#observacion_respU').val(datos['observacion_resp']);
            }
        })
    }


    function anular(idresp,obser){
        alertify.confirm('Anular el Registro', 'Desea anular el registro: '+obser,
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idresp="+idresp,
                    url:"procesos/anularrespuestaglo.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaData").load("tablarespuesta_glosa.php");
                            alertify.success("Registro Anulado!");
                        }else{
                            alertify.error("Registro NO Anulado!");
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

