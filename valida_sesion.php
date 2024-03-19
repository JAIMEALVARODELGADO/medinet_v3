<?php
session_start();
if(!isset($_SESSION['gusuario_log']) or $_SESSION['gusuario_log']=='' or $_SESSION['gcontador_log']>1){
	if($_SESSION['gcontador_log']>1){
		?>
		    <script type="text/javascript">
		         alert('Solo puede tener una sesion abierta');
		    </script>
		<?php
		$_SESSION['gcontador_log']=0;
	}
    ?>
    <script type="text/javascript">
        window.open("index.php","_self");        
    </script>
    <?php
}
?>
