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
                    <a class="nav-link active" href="#">Generar Horarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mn_horario2.php">Horarios Disponibles</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" href="#">Ordenes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mn_consu14.php">Finalizar Conulta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mn_consu1.php">Pacientes Agendados</a>
                </li>-->
            </ul>

        </div>       
        
        <div class="container">
            <br>
            <div class="card text-left">
                <div class="card-header">
                    <h4>Generar Horarios</h4>
                </div>

                <div class="card-body">
                    <form id="frm_horario" name="frm_horario">
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
                                <label for="fecha_ini" class="col-sm-2 col-form-label">Fecha Inicial</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" required>
                                </div>

                                <label for="hora_ini" class="col-sm-2 col-form-label">Hora Inicial</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control" id="hora_ini" name="hora_ini" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fecha_fin" class="col-sm-2 col-form-label">Fecha Final</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                                </div>
                                <label for="hora_fin" class="col-sm-2 col-form-label">Hora Final</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="minutos" class="col-sm-2 col-form-label">Minutos por Turno</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="minutos" name="minutos" placeholder="Min" max="30" min="10" value="15">
                                </div>
                                <label for="turnos" class="col-sm-2 col-form-label">Turnos por Horario</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="turnos" name="turnos" maxlength="2" max="15" min="1" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dias" class="col-sm-2 col-form-label">Días</label>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" id="dom" name="dom">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="Dom">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" id="lun" name="lun">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="Lun">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" id="mar" name="mar">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="Mar">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" id="mier" name="mier">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="Mier">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" id="jue" name="jue">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="Jue">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" id="vie" name="vie">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="Vie">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" id="sab" name="sab">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="Sab">
                                    </div>
                                </div>
                            </div>

                            <span class="btn btn-primary" title="Generar Horarios" onclick="validar()" id="btn_nuevo">
                                Generar Horarios <i class="far fa-calendar-alt"></i></span>
                            </span>
                            <input type="hidden" id="domingo" name="domingo">
                            <input type="hidden" id="lunes" name="lunes">
                            <input type="hidden" id="martes" name="martes">
                            <input type="hidden" id="miercoles" name="miercoles">
                            <input type="hidden" id="jueves" name="jueves">
                            <input type="hidden" id="viernes" name="viernes">
                            <input type="hidden" id="sabado" name="sabado">
                        </form>
                </div>
                <div class="card-footer text-muted">
                    By Soluciones Thin & Thin
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarmedicamformula.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataformula").load("tablaformula.php");
                        
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
                url:"procesos/actualizarmedicamformula.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataformula").load("tablaformula.php");
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
    function validar(){
        error="";
        if(document.frm_horario.id_profesional.value==""){error+="Seleccionar el profesional,\n";}
        if(document.frm_horario.fecha_ini.value==""){error+="Fecha Inicial,\n";}
        if(document.frm_horario.fecha_fin.value==""){error+="Fecha Final,\n";}
        if(document.frm_horario.hora_ini.value==""){error+="Hora Inicial,\n";}
        if(document.frm_horario.hora_fin.value==""){error+="Hora Final,\n";}
        if(document.frm_horario.minutos.value==""){error+="Minutos por turno,\n";}
        if(document.frm_horario.turnos.value==""){error+="Turnos por Horario,\n";}
        if((document.frm_horario.dom.checked==false) &&
            (document.frm_horario.lun.checked==false) &&
            (document.frm_horario.mar.checked==false) &&
            (document.frm_horario.mier.checked==false) &&
            (document.frm_horario.jue.checked==false) &&
            (document.frm_horario.vie.checked==false) &&
            (document.frm_horario.sab.checked==false)
            ){error+="Debe seleccionara al menos un día de la semana,\n";}
        if(error!=""){
            error="Para continuar debe complementar:\n"+error;
            alertify.error(error);
        }
        else{
            document.frm_horario.domingo.value='N';
            document.frm_horario.lunes.value='N';
            document.frm_horario.martes.value='N';
            document.frm_horario.miercoles.value='N';
            document.frm_horario.jueves.value='N';
            document.frm_horario.viernes.value='N';
            document.frm_horario.sabado.value='N';
            if(document.frm_horario.dom.checked==true){document.frm_horario.domingo.value='S';}
            if(document.frm_horario.lun.checked==true){document.frm_horario.lunes.value='S';}
            if(document.frm_horario.mar.checked==true){document.frm_horario.martes.value='S';}
            if(document.frm_horario.mier.checked==true){document.frm_horario.miercoles.value='S';}
            if(document.frm_horario.jue.checked==true){document.frm_horario.jueves.value='S';}
            if(document.frm_horario.vie.checked==true){document.frm_horario.viernes.value='S';}
            if(document.frm_horario.sab.checked==true){document.frm_horario.sabado.value='S';}
            
            generar();
        }

    }

    function generar(){
        $(document).ready(function(){
            //$("#btnNuevo").click(function(){
                datos=$('#frm_horario').serialize();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/generahorario.php",
                    success:function(r){
                        if(r==1){
                            alertify.success("Horarios Generados");
                            $('#frm_horario')[0].reset();
                            //$("#tablaDataformula").load("tablaformula.php");
                            
                        }
                        else{
                            alertify.error("Error: El registro no guardado");
                        }
                    }
                });
            //});

        });
    }
</script>