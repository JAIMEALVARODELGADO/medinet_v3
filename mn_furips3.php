<?php
//session_start();
//echo "sesion ".$_SESSION['gid_reclamacion'];
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
					<a class="nav-link" href="mn_furips1.php">Formulario FURIPS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_furips2.php">Propietarios/Conductores</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Listado de Furips</a>
				</li>				
			</ul>
		</div>    
		<br>
		<div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card text-left">
                        <div class="card-header">
                            <h4>Listado de Furips</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="fecha_ini" class="col-sm-2 col-form-label">Numero de Factura:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="numero_fac" name="numero_fac" onblur="actualizar()">
                                </div>

                                <label for="fechacie_ini" class="col-sm-2 col-form-label">Nombre de la víctima:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nombre_pac" name="nombre_pac" onblur="actualizar()">
                                </div>

                                <label for="numero_iden" class="col-sm-2 col-form-label">Identificación:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="numero_iden" name="numero_iden" size='20' onblur="actualizar()">
                                </div>
                            </div>
                            <hr>
                            <div id="tablaDatafurips"></div>
                        </div>
                        <div class="card-footer text-muted">
                            By Soluciones Thin & Thin
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <form id="frm_furips" name="frm_furips" method="POST">
        <input type="hidden" id="condicion" name="condicion">
        <input type="hidden" id="id_reclamacion" name="id_reclamacion">
        <?php 
            $_SESSION['gid_reclamacion']=0;            
        ?>
    </form>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        //actualizar();
    });
</script>

<script type="text/javascript">
    function actualizar(){        
        //condicion="esta_fac<>'A'";
        condicion="";
        if($('#numero_fac').val()!=""){
           condicion+=" AND numero_fac='"+$('#numero_fac').val()+"'";
        }
        if($('#nombre_pac').val()!=""){
           condicion+=" AND nombre_pac LIKE '%"+$('#nombre_pac').val()+"%'";
        }
        if($('#numero_iden').val()!=""){
           condicion+=" AND numero_iden_per='"+$('#numero_iden').val()+"'";
        }
        condicion=condicion.substring(5);
        
        $('#condicion').val(condicion);
        $(document).ready(function(){
            datos=$('#frm_furips').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarfurips.php",
                
            });
            $("#tablaDatafurips").load("tablafurips.php");
        });
    }

    function imprimir(id_rec){
        $('#id_reclamacion').val(id_rec);
        document.frm_furips.action="mn_impr_furips.php";
        document.frm_furips.target="new";
        document.frm_furips.submit();
    }

    /*function anular(idfac,nombre){
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
    }*/

    function editar(idrec_){        
        $('#id_reclamacion').val(idrec_);
        document.frm_furips.action="mn_furips1.php";        
        document.frm_furips.submit();
    }

    function cerrar(idrec,nombre){
        alertify.confirm('Cerrar FURIPS', 'Un formulario FURIPS cerradO no podrá modificarse. Desea cerrar el FURIPS de '+nombre+'?',
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idrec="+idrec,
                    url:"procesos/cerrarfurips.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatafurips").load("tablafurips.php");
                            alertify.success("FURIPS Cerrado!");
                        }else{
                            alertify.error("FURIPS NO Cerrado!");
                        }
                    }
                })
            }
            ,function(){

            });
    }
    
</script>
