<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
//$obj=new conectar();
//$conexion=$obj->conexion();
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
	        <div class="row">
	            <div class="col-sm-12">
	                <div class="card text-left">
	                    <div class="card-header">
	                        <h4>Facturas Abiertas</h4>
	                    </div>
	                    <div class="card-body">
	                        <!--<span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoeps" title="Agrega Nueva Eps">
	                            Nuevo <span class="fas fa-plus-circle"></span>
	                        </span>-->
	                        <hr>
	                        <div id="tablaDatafactura"></div>
	                    </div>
	                    <div class="card-footer text-muted">
	                        By Soluciones Thin & Thin
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_factura" name="id_factura">
                        <label>Nombre</label>
                        <input type="text" maxlength="60" class="form-control input-sm" id="nombre" name="nombre" disabled="true">
                        <label>EPS</label>
                        <input type="text" maxlength="60" class="form-control input-sm" id="eps" name="eps" disabled="true">
                        <label>Convenio</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="convenio" name="convenio" disabled="true">
                        <label>Fecha</label>
                        <input type="text" maxlength="10" class="form-control input-sm" id="fecha_fac" name="fecha_fac">
                        <label>Forma de Pago</label>
                        <select class="form-control" id="formapago_fac" name="formapago_fac">

                        </select>
                        <label>Valor Total</label>
                        <input type="number" class="form-control input-sm" id="valortot_fac" name="valortot_fac" disabled="true">
                        <label>Valor Copago</label>
                        <input type="number" class="form-control input-sm" id="copago_fac" name="copago_fac">
                        <label>Valor Descuento</label>
                        <input type="number" class="form-control input-sm" id="descuento_fac" name="descuento_fac">

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>
    <form id="frm_detalle" name="frm_detalle" action="mn_factura111.php" method="POST">
    	<input type="hidden" id="id_fac" name="id_fac">
    </form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatafactura").load("tablafactura.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){        
        $('#btnActualizar').click(function(){
            datos=$('#frm_editar').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarfactura.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDatafactura").load("tablafactura.php");
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
    function FrmEditar(idfac){
        $.ajax({
            type:"POST",
            url:'procesos/lista_formapago.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#formapago_fac').html(listas_rep)
        })
        .fail(function(){
            alertify.error("Error al cargar listas");
        })	
        $.ajax({
            type:"POST",
            data:"idfac="+idfac,
            url:"procesos/obtenDatosfac.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#id_factura').val(datos['id_factura']);
                $('#nombre').val(datos['nombre_pac']);
                $('#eps').val(datos['nombre_eps']);
                $('#convenio').val(datos['numero_conv']);
                $('#fecha_fac').val(datos['fecha_fac']);
                $('#formapago_fac').val(datos['formapago_fac']);                
                $('#valortot_fac').val(datos['valortot_fac']);
                $('#copago_fac').val(datos['copago_fac']);
                $('#descuento_fac').val(datos['descuento_fac']);
            }
        })
        
    }

    function anular(idfac,nombre){
        alertify.confirm('Eliminar Factura', 'Desea eliminar la factura de '+nombre+'?',
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idfac="+idfac,
                    url:"procesos/anularfactura.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatafactura").load("tablafactura.php");
                            alertify.success("Factura Anulada!");
                        }else{
                            alertify.error("Factura NO Anulada!");
                        }
                    }
                })
            }
            ,function(){

            });
    }

    function editaritem(idfac){
    	$('#id_fac').val(idfac);
    	document.frm_detalle.submit();
    }

    function cerrar(idfac,nombre){
        alertify.confirm('Cerrar Factura', 'Una factura cerrada no podrá modificarse. Desea cerrar la factura de '+nombre+'?',
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idfac="+idfac,
                    url:"procesos/cerrarfactura.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatafactura").load("tablafactura.php");
                            alertify.success("Factura Cerrada!");
                        }else{
                            alertify.error("Factura NO Cerrada!");
                        }
                    }
                })
            }
            ,function(){

            });
    }
    
</script>