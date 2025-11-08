
<?php
	/**
	 * Conexion a la BD
	 */
	class conectar{
		public function conexion(){
			// celery_root,m3d1n3t123,celery_medinetv3_bd
			//$conexion=mysqli_connect('localhost','root','654321','medinet_v3');
			$conexion=mysqli_connect('localhost','root','','medinet_v3');
			mysqli_set_charset($conexion,"utf8");
			return $conexion;
		}
	}

?>