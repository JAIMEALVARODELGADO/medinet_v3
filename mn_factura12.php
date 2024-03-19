<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$hoy=date("Y-m-d");
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
					<a class="nav-link" href="mn_factura11.php">Facturas Abiertas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Facturas Cerradas/Anuladas</a>
				</li>				
			</ul>

		</div>       
		<br>
		<div class="container">
	        <div class="row">
	            <div class="col-sm-12">
	                <div class="card text-left">
	                    <div class="card-header">
	                        <h4>Facturas Cerradas/Anuladas</h4>
	                    </div>
	                    <div class="card-body">

                            <div class="form-group row">
                                <label for="fecha_ini" class="col-sm-2 col-form-label">Fecha Desde:</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" onblur="actualizar()">
                                </div>

                                <label for="fechacie_ini" class="col-sm-2 col-form-label">Fecha de Cierre Desde:</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="fechacie_ini" name="fechacie_ini" value="<?php echo $hoy;?>" onblur="actualizar()">
                                </div>

                                <label for="numero_iden" class="col-sm-2 col-form-label">Identificación:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="numero_iden" name="numero_iden" size='20' onblur="actualizar()">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fecha_fin" class="col-sm-2 col-form-label">Hasta:</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" onblur="actualizar()">
                                </div>

                                <label for="fechacie_fin" class="col-sm-2 col-form-label">Hasta:</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="fechacie_fin" name="fechacie_fin" value="<?php echo $hoy;?>" onblur="actualizar()">
                                </div>

                                <label for="eps" class="col-sm-1 col-form-label">EPS:</label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="eps" name="eps" onchange="actualizar()">
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

	
    <form id="frm_factura" name="frm_factura" method="POST">
    	<input type="hidden" id="condicion" name="condicion">
        <input type="hidden" id="id_factura" name="id_factura">
    </form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        actualizar();
    });
</script>

<script type="text/javascript">
    function actualizar(){
        condicion="esta_fac<>'A'";
        if($('#fecha_ini').val()!=""){
           condicion+=" AND fecha_fac between '"+$('#fecha_ini').val()+"'";
        }
        if($('#fecha_fin').val()!=""){
           condicion+=" AND '"+$('#fecha_fin').val()+"'";
        }
        if($('#fechacie_ini').val()!=""){
           condicion+=" AND fechacierre_fac between '"+$('#fechacie_ini').val()+"'";
        }
        if($('#fechacie_fin').val()!=""){
           condicion+=" AND '"+$('#fechacie_fin').val()+"'";
        }
        if($('#numero_iden').val()!=""){
           condicion+=" AND numero_iden_per='"+$('#numero_iden').val()+"'";
        }
        if($('#eps').val()!=""){
           condicion+=" AND id_eps='"+$('#eps').val()+"'";
        }

        $('#condicion').val(condicion);
        $(document).ready(function(){
            datos=$('#frm_factura').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarcons.php",
                
            });
            $("#tablaDatafactura").load("tablafacturacerrada.php");
        });
    }

    function imprimir(id_fac){
        $('#id_factura').val(id_fac);
        document.frm_factura.action="mn_impr_factura.php";
        document.frm_factura.target="new";
        document.frm_factura.submit();
    }

    function anular(idfac,nombre){
        alertify.confirm('Anular Factura', 'Desea anular la factura de '+nombre+'?',
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idfac="+idfac,
                    url:"procesos/anularfactura.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatafactura").load("tablafacturacerrada.php");
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
    
</script>