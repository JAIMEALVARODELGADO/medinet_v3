<?php
//session_start();
require("valida_sesion.php");
require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();
$hoy=date("Y-m-d");

$_SESSION['gsql']=$_POST['sql'];

//echo $_SESSION['gsql'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>
</head>

<body>
<form id="form1" name='form1' method="POST">
    <?php
    require("encabezado.php");
    require("menu.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Informe de Consultas</h4>
                    </div>
                    
                    <div id="tablaDatainforme"></div>
                    <div class="col-sm-6">
                        <span class="btn btn-success" title="Imprimir" onclick="imprimir()" id="btn_buscar">Imprimir <i class="fas fa-print"></i></span>
                        </span>
                        <span class="btn btn-secondary" title="Regresar" onclick="regresar()" id="btn_regresar">Regresar <i class="fas fa-angle-double-left"></i></span>

                        </span>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="titulo" name="titulo" value="<?php echo $_POST['titulo'];?>">
    <input type="hidden" id="sql" name="sql" value="<?php echo $_POST['sql'];?>">
</form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatainforme").load("tablainf_consulta.php");
    });
</script>


<script type="text/javascript">
    function imprimir(){
        document.form1.action="mn_impr_informe1.php";
        document.form1.target="new";
        document.form1.submit();
    }

    function regresar(){
        window-history.go(-1);
    }
</script>
