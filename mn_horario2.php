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
                    <a class="nav-link" href="mn_horario1.php">Generar Horarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Horarios Disponibles</a>
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
                    <h4>Horarios Disponibles</h4>
                </div>
                <div class="card-body">
                    <!--<span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoeps" title="Agrega Nueva Eps">
                        Nuevo <span class="fas fa-plus-circle"></span>
                    </span>-->
                    <hr>
                    <div id="tablaDatahorario"></div>
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
        $("#tablaDatahorario").load("tablahorario.php");
    });
</script>



<script type="text/javascript">
    function eliminarDatos(idagh,fecha,profesional){
        alertify.confirm('Eliminar Horario', 'Desea Eliminar el horario '+fecha+' del profesional '+profesional, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idagh="+idagh,
                    url:"procesos/eliminarhorario.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatahorario").load("tablahorario.php");
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