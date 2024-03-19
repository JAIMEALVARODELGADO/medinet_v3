<?php
require("valida_sesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>

    <?php 
        require_once "scripts.php";
        require_once "clases/conexion.php";
        $obj=new conectar();
        $conexion=$obj->conexion();
    ?>
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
                        <h4>Asignación de Cita sin Agenda</h4>
                    </div>
                    <div class="card-body">
                        <form id="frm_cita" name="frm_cita" action="mn_cita21.php">
                            <div class="form-group row">
                                <label for="id_persona" class="col-sm-2 col-form-label">Paciente</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nombre_pac" name="nombre_pac" size='80' placeholder="digite la identificación o el nombre" required>
                                    <input type='hidden' id='id_persona' name='id_persona'>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id_eps" class="col-sm-2 col-form-label">EPS</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm" id="id_eps" name="id_eps">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT id_eps,nombre_eps FROM eps ORDER BY nombre_eps";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>                            
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id_profesional" class="col-sm-2 col-form-label">Profesional</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm" id="id_profesional" name="id_profesional">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT id_persona,nombre FROM vw_usuario WHERE agendar_usu='S' AND estado_usu='A' ORDER BY nombre";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>   
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fecha_agh" class="col-sm-2 col-form-label">Fecha</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
                                    <input type="hidden" class="form-control" id="fecha_agh" name="fecha_agh" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="observacion_agc" class="col-sm-2 col-form-label">Observación</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="observacion_agc" name="observacion_agc" placeholder="Observación adicional" maxlength="80">
                                </div>
                            </div>
                            <span class="btn btn-primary" title="Guardar" onclick="validar()" id="btn_nuevo">
                                Guardar <span class="fas fa-save"></span></span>
                            </span>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script type="text/javascript">
    $().ready(function() {  
        $("#nombre_pac").autocomplete("procesos/autocomp_pac.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#nombre_pac").result(function(event, data, formatted) {
            $("#id_persona").val(data[1]);
        });


    });
    
    $().ready(function() {  
        $("#nombre_pac").autocomplete("procesos/autocomp_pac.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#nombre_pac").result(function(event, data, formatted) {
            $("#id_persona").val(data[1]);
        });


    });
</script>

<script language="javascript">
    function validar(){
        err="";
        if(document.frm_cita.id_persona.value==''){err="Paciente\n";}
        if(document.frm_cita.id_eps.value==''){err+="EPS\n";}
        if(document.frm_cita.id_profesional.value==''){err+="Profesional\n";}
        if(document.frm_cita.fecha.value==''){err+="Fecha\n";}   
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
        }
        else{
            document.frm_cita.fecha_agh.value=document.frm_cita.fecha.value;
            guardar()
        }
    }
    
    function guardar(){
        $(document).ready(function(){
            //$("#btn_nuevo").click(function(){
                datos=$('#frm_cita').serialize();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregarcita2.php",
                    success:function(r){
                        if(r==1){
                            alertify.success("Registro guardado");
                            $('#frm_cita')[0].reset();
                        }
                        else{
                            alertify.error("Error: Registro no guardado");
                        }
                    }
                });
            //});
        });
    }
</script>