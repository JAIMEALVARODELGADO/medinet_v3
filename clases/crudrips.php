<?php
session_start();
/**
 * crud
 */
class crudrips{	

	public function obtenDatos($idripsac){
		$obj=new conectar();
		$conexion=$obj->conexion();		
		$sql="SELECT id_ripsac, fechacon_rac, numeroauto_rac, codigocon_rac,finalidad_rac,causaexte_rac,dxprincipal_rac,dxrel1_rac,dxrel2_rac,dxrel3_rac,tipodxprin_rac,valorcon_rac,valorcmode_rac FROM rips_ac WHERE id_ripsac='$idripsac'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_ripsac' => $ver[0],
			'fechacon_rac' => $ver[1],
			'numeroauto_rac' => $ver[2],
			'codigocon_rac' => $ver[3],
			'finalidad_rac' => $ver[4],
			'causaexte_rac' => $ver[5],
			'dxprincipal_rac' => $ver[6],
			'dxrel1_rac' => $ver[7],
			'dxrel2_rac' => $ver[8],
			'dxrel3_rac' => $ver[9],
			'tipodxprin_rac' => $ver[10],
			'valorcon_rac' => $ver[11],
			'valorcmode_rac' => $ver[12]
			);
		return $datos;
	}

	public function obtenDatosap($idripsap){
		$obj=new conectar();
		$conexion=$obj->conexion();		
		$sql="SELECT id_ripsap, fechaproc_rap, numeroauto_rap, codigoproc_rap,ambito_rap,finalidad_rap,dxprincipal_rap,dxrelac_rap,complica_rap,valor_rap FROM rips_ap WHERE id_ripsap='$idripsap'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_ripsap' => $ver[0],
			'fechaproc_rap' => $ver[1],
			'numeroauto_rap' => $ver[2],
			'codigoproc_rap' => $ver[3],
			'ambito_rap' => $ver[4],
			'finalidad_rap' => $ver[5],
			'dxprincipal_rap' => $ver[6],
			'dxrelac_rap' => $ver[7],
			'complica_rap' => $ver[8],
			'valor_rap' => $ver[9]			
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE rips_ac SET fechacon_rac='$datos[1]',numeroauto_rac='$datos[2]',codigocon_rac='$datos[3]',finalidad_rac='$datos[4]',causaexte_rac='$datos[5]',dxprincipal_rac='$datos[6]',dxrel1_rac='$datos[7]',dxrel2_rac='$datos[8]',dxrel3_rac='$datos[9]',tipodxprin_rac='$datos[10]',valorcon_rac='$datos[11]',valorcmode_rac='$datos[12]' WHERE id_ripsac='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function actualizarap($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE rips_ap SET fechaproc_rap='$datos[1]',numeroauto_rap='$datos[2]',codigoproc_rap='$datos[3]',ambito_rap='$datos[4]',finalidad_rap='$datos[5]',dxprincipal_rap='$datos[6]',dxrelac_rap='$datos[7]',complica_rap='$datos[8]',valor_rap='$datos[9]' WHERE id_ripsap='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function generarrips($idccob){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$consdet="SELECT id_detfac,id_factura,tipo_detfac, numero_fac, fecha_fac, id_ccobro, id_con, tipo_cdet, codigo_cdet, cantidad_detfac, valor_unit_detfac FROM vw_factura_detalle WHERE id_ccobro='$idccob'";	
		//AND tipo_cdet='AC'
		//echo "<br>".$consdet;
		$consdet=mysqli_query($conexion,$consdet);
		while($rowdet=mysqli_fetch_array($consdet)){
			//echo "<br>".$rowdet['tipo_detfac'];
			$id_detfac=$rowdet['id_detfac'];
			$fecha_con=$rowdet['fecha_fac'];			
			$codigo_cdet=$rowdet['codigo_cdet'];
			$cantidad_detfac=$rowdet['cantidad_detfac'];
			$valor_unit_detfac=$rowdet['valor_unit_detfac'];
			$tipo_detfac=$rowdet['tipo_detfac'];			
			if($tipo_detfac==''){
				if($rowdet['tipo_cdet']=='AC'){$tipo_detfac='C';}
				if($rowdet['tipo_cdet']=='AP'){$tipo_detfac='P';}
			}			
			//Aqui valido si el registro pertenece a la tabla de consulta
			if($tipo_detfac=="C"){
				$conrips="SELECT id_ripsac FROM rips_ac WHERE id_detfac='$rowdet[id_detfac]'";
				//echo "<br>".$conrips;
				$conrips=mysqli_query($conexion,$conrips);
				if(mysqli_num_rows($conrips)==0){					
					$finalidad_cod='10';
					$causaext_cod='13';
					$dxprinc_cod='';
					$dxrel1_cod='';
					$dxrel2_cod='';
					$dxrel3_cod='';
					$tipodx_cod='';
					if(!is_null($rowdet['id_con'])){
						$conshis="SELECT SUBSTR(fecha_aten,1,10) AS fecha_con, finalidad_cod, causaext_cod, dxprinc_cod, dxrel1_cod, dxrel2_cod, dxrel3_cod, tipodx_cod FROM vw_consulta WHERE id_con='$rowdet[id_con]'";
						//echo "<br>".$conshis;
						$conshis=mysqli_query($conexion,$conshis);
						$rowhis=mysqli_fetch_row($conshis);
						$fecha_con=$rowhis[0];
						$finalidad_cod=$rowhis[1];
						$causaext_cod=$rowhis[2];
						$dxprinc_cod=$rowhis[3];
						$dxrel1_cod=$rowhis[4];
						$dxrel2_cod=$rowhis[5];
						$dxrel3_cod=$rowhis[6];
						$tipodx_cod=$rowhis[7];
					}
					if($rowdet['tipo_cdet']=="AC"){
						//echo "<br>".$rowdet['tipo_cdet'];
						for($c=1;$c<=$cantidad_detfac;$c++){
							$guardado=self::crearegac($idccob,$id_detfac,$fecha_con,'',$codigo_cdet,$finalidad_cod,$causaext_cod,$dxprinc_cod,$dxrel1_cod,$dxrel2_cod,$dxrel3_cod,$tipodx_cod,$valor_unit_detfac);
						}
					}
				}
			}

			//Aqui valido si el registro pertenece a la tabla de procedimientos
			if($tipo_detfac=="P"){
				$conrips="SELECT id_ripsap FROM rips_ap WHERE id_detfac='$rowdet[id_detfac]'";
				//echo "<br>".$conrips;
				$conrips=mysqli_query($conexion,$conrips);
				if(mysqli_num_rows($conrips)==0){
					$fecha_proc=$rowdet['fecha_fac'];
					$ambito_cod='1';
					$finalidad_cod='2';
					$personal_cod='';
					$dxprincipal_cod='';
					$dxrelac_cod='';
					$complica_cod='';
					$formareali_cod='';
					$valor_rap=0;
					if(!is_null($rowdet['id_con'])){
						$conshis="SELECT SUBSTR(fecha_aten,1,10) AS fecha_proc, ambito_cod, finalidad_cod, dxprinc_cod, dxrelac_cod, complica_cod FROM vw_procedimiento WHERE id_procedimiento='$rowdet[id_con]'";
						//echo "<br>".$conshis;
						$conshis=mysqli_query($conexion,$conshis);
						$rowhis=mysqli_fetch_array($conshis);
						$fecha_proc=$rowhis['fecha_proc'];						
						$ambito_cod=$rowhis['ambito_cod'];
						$finalidad_cod=$rowhis['finalidad_cod'];
						$dxprinc_cod=$rowhis['dxprinc_cod'];
						$dxrelac_cod=$rowhis['dxrelac_cod'];
						$complica_cod=$rowhis['complica_cod'];
					}
					if($rowdet['tipo_cdet']=="AP"){
						//echo "<br>".$rowdet['tipo_cdet'];
						for($c=1;$c<=$cantidad_detfac;$c++){
							$guardado=self::crearegap($idccob,$id_detfac,$fecha_proc,'',$codigo_cdet,$ambito_cod,$finalidad_cod,'',$dxprinc_cod,$dxrelac_cod,$complica_cod,'',$valor_unit_detfac);
						}
					}
				}
			}		
		}
		return $guardado;
	}

	public function crearegac($idccob,$id_detfac,$fecha_con,$numeroauto_rac,$codigo_cdet,$finalidad_cod,$causaext_cod,$dxprinc_cod,$dxrel1_cod,$dxrel2_cod,$dxrel3_cod,$tipodx_cod,$valor_unit_detfac){		
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO rips_ac(id_ccobro,id_detfac,fechacon_rac,numeroauto_rac,codigocon_rac,finalidad_rac,causaexte_rac,dxprincipal_rac,dxrel1_rac,dxrel2_rac,dxrel3_rac,tipodxprin_rac,valorcon_rac,valorcmode_rac)
		VALUES('$idccob','$id_detfac','$fecha_con','$numeroauto_rac','$codigo_cdet','$finalidad_cod','$causaext_cod','$dxprinc_cod','$dxrel1_cod','$dxrel2_cod','$dxrel3_cod','$tipodx_cod','$valor_unit_detfac','0')";
		//echo "<br>".$sql;

		$guardado=mysqli_query($conexion,$sql);
		return($guardado);
	}

	public function crearegap($idccob,$id_detfac,$fecha_proc,$numeroauto_rap,$codigo_cdet,$ambito_cod,$finalidad_cod,$personal_rap,$dxprinc_cod,$dxrelac_cod,$complica_cod,$formareali_rap,$valor_unit_detfac){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="INSERT INTO rips_ap(id_ccobro,id_detfac,fechaproc_rap,numeroauto_rap,codigoproc_rap,ambito_rap,finalidad_rap,personal_rap,dxprincipal_rap,dxrelac_rap,complica_rap,formareali_rap,valor_rap)
		VALUES('$idccob','$id_detfac','$fecha_proc','$numeroauto_rap','$codigo_cdet','$ambito_cod','$finalidad_cod','$personal_rap','$dxprinc_cod','$dxrelac_cod','$complica_cod','$formareali_rap','$valor_unit_detfac')";
		//echo "<br>".$sql;
		$guardado=mysqli_query($conexion,$sql);
		return($guardado);
	}

	public function eliminar($idripsac){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM rips_ac WHERE id_ripsac='$idripsac'";
		return mysqli_query($conexion,$sql);
	}

	public function eliminarap($idripsap){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM rips_ap WHERE id_ripsap='$idripsap'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
