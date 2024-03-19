<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$conhis="SELECT id_aten FROM atencion WHERE id_agc='$_SESSION[gid_agc]'";
$conhis=mysqli_query($conexion,$conhis);
if(mysqli_num_rows($conhis)!=0){
	$rowhis=mysqli_fetch_row($conhis);
	$id_aten=$rowhis[0];
}
else{
	$id_aten=0;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Medinet V3</title>
	<?php 
		require_once "scripts.php";
		require_once "clases/conexion.php";
		$obj=new conectar();
		$conexion=$obj->conexion();
	?>
	<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
	<script type="text/javascript" src="../librerias/js/jquery.js"></script>
	<script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>
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
					<a class="nav-link" href="mn_consu11.php">Historia de Consulta</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="mn_consu15.php">Procedimientos</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu12.php">Formula</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Ordenes</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="mn_consu16.php">Adjuntos</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu14.php">Finalizar Conulta</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu1.php">Pacientes Agendados</a>
				</li>
			</ul>

		</div>       
		<br><h5>Ordenes</h5>        
		<div class="card-body">
			<?php
				if($id_aten!=0){
					?>
					<span class="btn btn-secondary" data-toggle="modal" data-target="#modalnuevaorden" title="Agrega Nueva Orden">
						Nuevo <span class="fas fa-plus-circle"></span>
					</span>
					<?php
				}
			?>
            <div id="tablaDataorden"></div>
		</div>
	</div>

	<!-- Modal Nueva Orden-->
	<div class="modal fade" id="modalnuevaorden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		        <div class="modal-header">
		            <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Orden</h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		        <div class="modal-body">
		            <form id="frm_nuevo">
		                <label>Tipo de Orden</label>
		                <input type="hidden" id="id_aten" name="id_aten" value="<?php echo $id_aten;?>">
		                <select class="form-control" id="tipo_ord" name="tipo_ord">
                        	<option value=''></option>                            	
                        	<?php                            		
								$sql="SELECT codi_det, descripcion_det FROM vw_tipoorden ORDER BY descripcion_det";
								$result=mysqli_query($conexion,$sql);
								while($row=mysqli_fetch_row($result)){
									echo "<option value='$row[0]'>$row[1]</option>";
								}
                        	?>
                    	</select>
                    	<label>Descripción</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="descripcion" name="descripcion">
						<input type="hidden" id="id_cups" name="id_cups">
                        <label>Observación</label>
                        <textarea name="observacion_det" id="observacion_det" cols="70" rows="10"></textarea>
		            </form>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
		            <button type="button" id="btnNuevo" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
		        </div>
		    </div>
		</div>
	</div>

	<!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Detalle de la Orden</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_ord_det" name="id_ord_det">
                    	<label>Descripción</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="descripcionU" name="descripcionU">
						<input type="hidden" id="id_cupsU" name="id_cupsU">
                        <label>Observación</label>
                        <textarea name="observacion_detU" id="observacion_detU" cols="70" rows="10"></textarea>
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
        $("#tablaDataorden").load("tablaorden.php");
    });
</script>

<script language="javascript">
	$(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarorden.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataorden").load("tablaorden.php");
                        
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
                url:"procesos/actualizarordendet.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataorden").load("tablaorden.php");
                        alertify.success("Registro guardado");
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });
    });

    function eliminardet(iddet,nombdet){
        alertify.confirm('Eliminar El Registro', 'Desea Eliminar este Registro? '+nombdet, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"iddet="+iddet,
                    url:"procesos/eliminarordendet.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDataorden").load("tablaorden.php");
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

    function eliminarorden(idord,nombord){
        alertify.confirm('Eliminar Orden', 'Desea eliminar la orden de: '+nombord+' ?', 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idord="+idord,
                    url:"procesos/eliminarorden.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDataorden").load("tablaorden.php");
                            alertify.success("Orden Eliminada!");
                        }else{
                            alertify.error("Orden NO Eliminada!");
                        }
                    }
                })

            }
            ,function(){

            });
    }


	function FrmEditar(iddet){
        $.ajax({
            type:"POST",
            data:"iddet="+iddet,
            url:"procesos/obtenDatosorden.php",
            success:function(r){
            	var datos = JSON.parse(r);
                //datos=jQuery.parseJSON(r);
                $('#id_ord_det').val(datos['id_ord_det']);
                $('#descripcionU').val(datos['descripcion_cups']);
                $('#id_cupsU').val(datos['id_cups']);
                $('#observacion_detU').val(datos['observacion_det']);
            }
        })
    }
</script>

<script type="text/javascript">
	$().ready(function() {
		$("#descripcion").autocomplete("procesos/autocomp_cups.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#descripcion").result(function(event, data, formatted) {
			$("#id_cups").val(data[1]);
		});

		$("#descripcionU").autocomplete("procesos/autocomp_cups.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#descripcionU").result(function(event, data, formatted) {
			$("#id_cupsU").val(data[1]);
		});
	});
</script>

<!---Aqui desactivo la combinacion Ctrl-Click -->
<script type="text/javascript">
    $('a').click(function (e){  
    if (e.ctrlKey) {
        return false;
    }
    });
</script>