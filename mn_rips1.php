<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
if(isset($_POST['id_ccobroD'])){
    $_SESSION['gid_ccobro']=$_POST['id_ccobroD'];
}
$concta="SELECT numero_ccob, fecha_ccob, nombre_eps FROM vw_cuentacobro WHERE id_ccobro='$_SESSION[gid_ccobro]'";
//echo $concta;
$concta=mysqli_query($conexion,$concta);
$rowcta=mysqli_fetch_row($concta);
$numero_ccob=$rowcta[0];
$fecha_ccob=$rowcta[1];
$nombre_eps=$rowcta[2];
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
	//require("menu.php")
	?>


	<div class="card text">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link active" href="#">Generar Rips</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_rips2.php">Rips de Consulta - AC</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="mn_rips4.php">Rips de Procedimientos - AP</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="mn_rips3.php">Generar Archivos Planos</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="mn_cuentacobro1.php">Salir</a>
                </li>               
			</ul>

		</div>       
		<br>
		<div class="container">
            <div class="alert alert-secondary" role="alert">
                <div class="row">
                    <div class="col-sm-4"><label>Cuenta de Cobro: <?php echo $numero_ccob;?></label></div>
                    <div class="col-sm-3"><label>Fecha: <?php echo $fecha_ccob;?></label></div>
                    <div class="col-sm-5"><label>EPS: <?php echo $nombre_eps;?></label></div>
                </div>
                
            </div>
	        <div class="row">
	            <div class="col-sm-12">
	                <div class="card text-left">
	                    <div class="card-header">
	                        <h4>Generar RIPS</h4>
	                    </div>
	                    <div class="card-body">
	                        
	                        <div id="tablaDataAC"></div>
	                    </div>

	                    <div class="card-footer text-muted">
                            <div class="row">
                               <div class="col-sm-10">
                                By Soluciones Thin & Thin
                                </div>
                                <div class="col-sm-2">
                                    <span class="btn btn-success" title="Generar Rips" onclick="generar()">
                                        Generar Rips <span class="fas fa-plus-circle"></span>
                                    </span>
                                </div>
                            </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>		
	</div>

	
    <form name="frm_rips" id="frm_rips" method="POST">
        <input type="hidden" name="id_ccobro" id="id_ccobro" value="<?php echo $_SESSION['gid_ccobro'];?>">
    </form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        //$("#tablaDataAC").load("tablaripsAC.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){        
        $('#btnActualizar').click(function(){
            datos=$('#frm_editar').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarripsac.php",
                success:function(r){
                    if(r==1){
                        //$("#tablaDataAC").load("tablaripsAC.php");
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
            url:'procesos/lista_finalidad.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){            
            $('#finalidad_rac').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

        $.ajax({
            type:"POST",
            url:'procesos/lista_causaexte.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){            
            $('#causaexte_rac').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })
        
        $.ajax({
            type:"POST",
            url:'procesos/lista_tipodx.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){            
            $('#tipodxprin_rac').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })

    });
</script>

<script type="text/javascript">
    
    function generar(){
        alertify.confirm('Generar Rips', 'Desea generar rips a partir de las facturas de la cuenta de cobro?',
            function(){ 
                $.ajax({
                    //alert($('#id_ccobro').val()),
                    type:"POST",
                    data:"id_ccobro="+$('#id_ccobro').val(),                    
                    url:"procesos/generaripsccobro.php",
                    success:function(r){
                        if(r==1){
                            //$("#tablaDataAC").load("tablaripsAC.php");
                            alertify.success("Rips Generados!");
                        }else{
                            alertify.error("Rips NO Generados!");
                        }
                    }
                })
            }
            ,function(){

            });
    }
</script>