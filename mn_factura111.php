<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$_SESSION['gid_factura']=$_POST['id_fac'];
$consfac="SELECT fecha_fac, numero_iden_per, nombre_pac, nombre_eps, numero_conv, id_convenio FROM vw_factura WHERE id_factura='$_SESSION[gid_factura]'";

$consfac=mysqli_query($conexion,$consfac);
$row=mysqli_fetch_row($consfac);
$fecha_fac=$row[0];
$numero_iden_per=$row[1];
$nombre_pac=$row[2];
$nombre_eps=$row[3];
$numero_conv=$row[4];
$_SESSION['gid_convenio']=$row[5];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Medinet V3</title>
	<?php 
		require_once "scripts.php";
	?>
	<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
	<script type="text/javascript" src="../librerias/js/jquery.js"></script>
	<script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>
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
					<a class="nav-link" href="mn_factura1.php">Crear Nueva Factura</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Facturas Abiertas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_factura12.php">Facturas Cerradas/Anuladas</a>
				</li>				
			</ul>

		</div>
		<br>

		<div class="container">
			<div class="alert alert-secondary" role="alert">
				<div class="row">
					<div class="col-sm-4"><label>Fecha de la Factura: <?php echo $fecha_fac;?></label></div>
					<div class="col-sm-3"><label>Identificación: <?php echo $numero_iden_per;?></label></div>
					<div class="col-sm-5"><label>Nombre: <?php echo $nombre_pac;?></label></div>
				</div>
				<div class="row">
					<div class="col-sm-4"><label>Eps: <?php echo $nombre_eps;?></label></div>
					<div class="col-sm-4"><label>Convenio: <?php echo $numero_conv;?></label></div>		
				</div>  
			</div>

	        <div class="row">
	            <div class="col-sm-12">
	                <div class="card text-left">
	                    <div class="card-header">
	                        <h4>Detalle de la Factura</h4>
	                    </div>

	                    <div class="card-body">
	                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoitem" title="Agrega Nuevo Detalle a la Factura">
	                            Nuevo Detalle<span class="fas fa-plus-circle"></span>
	                        </span>
	                        <hr>
	                        <div id="tablaDatadetalle"></div>	                        
	                    </div>
	                    <div class="modal-footer">
                        	<a href="mn_factura11.php" type="button" class="btn btn-secondary">Regresar <i class="fas fa-angle-double-left"></i></a>
                    	</div>
	                    <div class="card-footer text-muted">
	                        By Soluciones Thin & Thin
	                    </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Detalle a la Factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                    	<label>Detalle</label>
						<input type="text" maxlength="80" class="form-control input-sm" id="detalle" name="detalle">
						<input type="hidden" id="id_cdet" name="id_cdet">

                        <label>Cantidad</label>
                        <input type="number" min="1" max="100" class="form-control input-sm" id="cantidad" name="cantidad">
                        <input type="hidden" id="cantidad_detfac" name="cantidad_detfac">
                        <label>Valor Unitario</label>
                        <input type="text" class="form-control input-sm" id="valor_unit_detfac" name="valor_unit_detfac" disabled="true">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnNuevo" class="btn btn-primary" onclick="validar()">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

	<!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Detalle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                    	<label>Detalle</label>
                    	<input type="hidden" id="id_detfac" name="id_detfac">
						<input type="text" maxlength="80" class="form-control input-sm" id="detalleU" name="detalleU">
						<input type="hidden" id="id_cdetU" name="id_cdetU">

                        <label>Cantidad</label>
                        <input type="number" min="1" max="100" class="form-control input-sm" id="cantidadU" name="cantidadU">
                        <input type="hidden" id="cantidad_detfacU" name="cantidad_detfacU">
                        <label>Valor Unitario</label>
                        <input type="text" class="form-control input-sm" id="valor_unit_detfacU" name="valor_unit_detfacU" disabled="true">
                    </form>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatadetalle").load("tablafacturadetalle.php");
    });
</script>

<script type="text/javascript">
	function validar(){
		error="";		
		if($("#id_cdet").val()==""){error+="Seleccionar el detalle, ";}
		if($("#cantidad").val()==""){error+="digitar la cantidad";}
		if(error!=""){
			alertify.error("Para continuar debe: "+error);
		}
		else{			
			$("#cantidad_detfac").val($("#cantidad").val());
			$("#valor_unit_detfac").removeAttr('disabled');
			guardar();
			$("#valor_unit_detfac").attr('disabled','disabled');
		}
	}

	function guardar(){		
	    $(document).ready(function(){
	    	//$("#btnNuevo").click(function(){
	            datos=$('#frm_nuevo').serialize();

	            $.ajax({
	                type:"POST",
	                data:datos,
	                url:"procesos/agregardetalle.php",
	                success:function(r){
	                    if(r==1){
	                        alertify.success("Registro guardado");
	                        $('#frm_nuevo')[0].reset();
	                        $("#tablaDatadetalle").load("tablafacturadetalle.php");
	                        
	                    }
	                    else{
	                        alertify.error("Error: El registro no guardado");
	                    }
	                }
	            });
	        //});
	    });
    }
    $(document).ready(function(){
        $('#btnActualizar').click(function(){
        	$("#cantidad_detfacU").val($("#cantidadU").val());
			$("#valor_unit_detfacU").removeAttr('disabled');
            datos=$('#frm_editar').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarfacturadetalle.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDatadetalle").load("tablafacturadetalle.php");
                        alertify.success("Registro guardado");
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
            $("#valor_unit_detfacU").attr('disabled','disabled');
        });
    });
</script>

<script type="text/javascript">
    function Editar(iddet){    	
        $.ajax({
            type:"POST",
            data:"iddet="+iddet,
            url:"procesos/obtenDatosfacdetalle.php",            
            success:function(r){
                //datos=jQuery.parseJSON(r);
                var datos = JSON.parse(r);	            
                $('#id_detfac').val(datos['id_detfac']);
                $('#id_cdetU').val(datos['id_cdet']);
                $('#detalleU').val(datos['descripcion_cdet']);
                $('#cantidadU').val(datos['cantidad_detfac']);
                $('#cantidad_detfacU').val(datos['cantidad_detfac']);
                $('#valor_unit_detfacU').val(datos['valor_unit_detfac']);
            }
        })
    }

    function borrar(iddet,nombre){
        alertify.confirm('Eliminar Detalle', 'Desea eliminar :'+nombre+'?', 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"iddet="+iddet,
                    url:"procesos/borrardetalle.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatadetalle").load("tablafacturadetalle.php");
                            alertify.success("Registro eliminado!");
                        }else{
                            alertify.error("Registro NO eliminado!");
                        }
                    }
                })

            }
            ,function(){

            });
    }

    /*function editaritem(idfac){
    	$('#id_fac').val(idfac);
    	document.frm_detalle.submit();
    }*/
    
</script>

<script type="text/javascript">
	$().ready(function() {
		$("#detalle").autocomplete("procesos/autocomp_detalle.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#detalle").result(function(event, data, formatted) {
			$("#id_cdet").val(data[1]);
			$("#valor_unit_detfac").val(data[2]);
		});

		$("#detalleU").autocomplete("procesos/autocomp_detalle.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#detalleU").result(function(event, data, formatted) {
			$("#id_cdetU").val(data[1]);
			$("#valor_unit_detfacU").val(data[2]);
		});
	});	
</script>