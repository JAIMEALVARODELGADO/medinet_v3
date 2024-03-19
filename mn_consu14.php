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
					<a class="nav-link" href="mn_consu11.php">Historia de Consulta</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu15.php">Procedimientos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu12.php">Formula</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu13.php">Ordenes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu16.php">Adjuntos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Finalizar Conulta</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu1.php">Pacientes Agendados</a>
				</li>
			</ul>

		</div>       
		
		<div class="container">
			<br><h5>Finalizar la Consulta</h5> 
			<div class="alert alert-warning" role="alert">
  				Alerta!!!!
  				<br><br>Va a cerrar la historia del paciente, asegurese que toda la información consignada, la formula y las ordenes son correctas. Despues de cerrada no podrá hacerle modificaciones, atendiendo la resolucion 1995 de 1999 
			</div>
			<div class="card-body">
				<?php
					if($id_aten!=0){
						?>
						<button type="button" id="btnCerrar" class="btn btn-primary" title="Cerrar Historia">Cerrar Historia  <span class="fab fa-expeditedssl"></span></button>
						<?php
					}
				?>
                <!--<hr>-->
                <!--<div id="tablaDataformula"></div>-->				
			</div>
		</div>
		<form id="frm_cerrar" action='mn_consu1.php'>
			<input type="hidden" id="id_aten" name="id_aten" value='<?php echo $id_aten;?>'>
		</form>
	</div>
</body>

</html>





<script type="text/javascript">
    $(document).ready(function(){
        

        $('#btnCerrar').click(function(){
            datos=$('#frm_cerrar').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/cerrarhistoria.php",
                success:function(r){
                    if(r==1){
                        //$("#tablaDataformula").load("tablaformula.php");
                        alertify.success("Historia Cerrada");
                        $("#frm_cerrar").submit();
                    }
                    else{
                        alertify.error("Error: La historia no se cerró");
                    }
                }
            });
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