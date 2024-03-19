<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
if(isset($_POST['id_ccobroD'])){
    $_SESSION['gid_ccobro']=$_POST['id_ccobroD'];
}
$concta="SELECT id_eps,nombre_eps,numero_ccob,codigo_eps,fecha_ccob FROM vw_cuentacobro WHERE id_ccobro='$_SESSION[gid_ccobro]'";
//echo $concta;
$concta=mysqli_query($conexion,$concta);
$rowcta=mysqli_fetch_row($concta);
$id_eps=$rowcta[0];
$nombre_eps=$rowcta[1];
$numero_ccob=$rowcta[2];
$codigo_eps=$rowcta[3];
$fecha_ccob=$rowcta[4];

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
					<a class="nav-link" href="mn_rips1.php">Generar Rips</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_rips2.php">Rips de Consulta - AC</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="mn_rips4.php">Rips de Procedimientos - AP</a>
                </li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Generar Archivos Planos</a>
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
	                        <h4>Archivos Planos</h4>
	                    </div>
	                    <div class="card-body">	                        
	                        <div id="generaplanos"></div>
	                    </div>

	                    <div class="card-footer text-muted">
                            By Soluciones Thin & Thin
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>		
	</div>
    <!--<form name="frm_rips" id="frm_rips" method="POST">
        <input type="text" name="id_ccobro" id="id_ccobro" value="<?php echo $_SESSION['gid_ccobro'];?>">
    </form>-->
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#generaplanos").load("generaplanos.php");
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
                        $("#tablaDataAC").load("tablaripsAC.php");
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
    /*function FrmEditar(idripsac){        
        $.ajax({
            type:"POST",
            data:"idripsac="+idripsac,
            url:"procesos/obtenDatosripsac.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#id_ripsac').val(datos['id_ripsac']);
                $('#fechacon_rac').val(datos['fechacon_rac']);
                $('#numeroauto_rac').val(datos['numeroauto_rac']);
                $('#codigocon_rac').val(datos['codigocon_rac']);
                $('#finalidad_rac').val(datos['finalidad_rac']);
                $('#causaexte_rac').val(datos['causaexte_rac']);
                $('#dxprincipal_rac').val(datos['dxprincipal_rac']);
                $('#dxrel1_rac').val(datos['dxrel1_rac']);
                $('#dxrel2_rac').val(datos['dxrel2_rac']);
                $('#dxrel3_rac').val(datos['dxrel3_rac']);
                $('#tipodxprin_rac').val(datos['tipodxprin_rac']);
                $('#valorcon_rac').val(datos['valorcon_rac']);
                $('#valorcmode_rac').val(datos['valorcmode_rac']);
            }
        })
    }*/

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
                            $("#tablaDataAC").load("tablaripsAC.php");
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

    function eliminar(idripsac){
        alertify.confirm('Eliminar Consulta', 'Desea Eliminar el Registro?',
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idripsac="+idripsac,
                    url:"procesos/eliminarripsac.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDataAC").load("tablaripsAC.php");
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
