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
					<a class="nav-link" href="mn_rips1.php">Generar Rips</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Rips de Consulta - AC</a>
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
	                        <h4>Rips de Consulta - AC</h4>
	                    </div>
	                    <div class="card-body">
	                        
	                        <div id="tablaDataAC"></div>
	                    </div>

	                    <div class="card-footer text-muted">
                            <div class="row">
                               <div class="col-sm-10">
                                By Soluciones Thin & Thin
                                </div>
                                
                            </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>		
	</div>

	<!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_ripsac" name="id_ripsac">
                        <label>Fecha</label>
                        <input type="date" class="form-control input-sm" id="fechacon_rac" name="fechacon_rac">
                        <label>Autorización</label>
                        <input type="text" maxlength="15" class="form-control input-sm" id="numeroauto_rac" name="numeroauto_rac">
                        <label>Código de la Consulta</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="codigocon_rac" name="codigocon_rac">                        
                        <label>Finalidad</label>
                        <select class="form-control" id="finalidad_rac" name="finalidad_rac">
                            
                        </select>
                        <label>Causa Externa</label>
                        <select class="form-control" id="causaexte_rac" name="causaexte_rac">
                            
                        </select>

                        <label>Diagnóstico Principal</label>
                        <input type="text" maxlength="4" class="form-control input-sm" id="dxprincipal_rac" name="dxprincipal_rac">
                        <label>Tipo de Dx Principal</label>
                        <select class="form-control" id="tipodxprin_rac" name="tipodxprin_rac">
                            
                        </select>
                        <label>Diagnóstico Relacionado 1</label>
                        <input type="text" maxlength="4" class="form-control input-sm" id="dxrel1_rac" name="dxrel1_rac">
                        <label>Diagnóstico Relacionado 2</label>
                        <input type="text" maxlength="4" class="form-control input-sm" id="dxrel2_rac" name="dxrel2_rac">
                        <label>Diagnóstico Relacionado 3</label>
                        <input type="text" maxlength="4" class="form-control input-sm" id="dxrel3_rac" name="dxrel3_rac">
                        
                        <label>Valor Consulta</label>
                        <input type="number" class="form-control input-sm" id="valorcon_rac" name="valorcon_rac">
                        <label>Valor Cuota Moderadora</label>
                        <input type="number" class="form-control input-sm" id="valorcmode_rac" name="valorcmode_rac">

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
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
        $("#tablaDataAC").load("tablaripsAC.php");
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
    function FrmEditar(idripsac){        
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
    }

    /*function generar(){
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
    }    */

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