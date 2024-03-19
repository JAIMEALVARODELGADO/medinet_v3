<?php
session_start();

class crudconsulta{
	
	public function agregar($datos){
		$guardado=0;
		$obj=new conectar();
		$conexion=$obj->conexion();

		//$conhis="SELECT id_con FROM consulta WHERE id_agc='$_SESSION[gid_agc]'";
		$conhis="SELECT id_aten FROM atencion WHERE id_agc='$_SESSION[gid_agc]'";
		//echo "<br>".$conhis;
		$conhis=mysqli_query($conexion,$conhis);
		if(mysqli_num_rows($conhis)==0){
			$sql="INSERT INTO atencion(id_agc,id_profesional,estado_aten) VALUES('$_SESSION[gid_agc]','$_SESSION[gusuario_log]','A')";
			//echo "<br>".$sql;
			$guardado=mysqli_query($conexion,$sql);
			$id_aten=mysqli_insert_id($conexion);

			$sql="UPDATE agenda_cita SET estado_agc='En Atencion' WHERE id_agc='$_SESSION[gid_agc]'";
			mysqli_query($conexion,$sql);
		}
		else{
			$rowhis=mysqli_fetch_row($conhis);
			$id_aten=$rowhis[0];
			//echo "<br>id_aten... ".$id_aten;
		}		
		if(!empty($datos[21]) OR !empty($datos[22]) OR !empty($datos[23]) OR !empty($datos[26]) OR !empty($datos[27]) OR !empty($datos[28]) OR !empty($datos[29]) OR !empty($datos[30])){
			$consultacon="SELECT id_con FROM consulta WHERE id_aten='$id_aten'";	
			$consultacon=mysqli_query($conexion,$consultacon);
			if(mysqli_num_rows($consultacon)==0){
				$dxrel1=0;
			    $dxrel2=0;
			    $dxrel3=0;
			    if(!empty($datos[32])){$dxrel1=$datos[32];}
			    if(!empty($datos[33])){$dxrel2=$datos[33];}
			    if(!empty($datos[34])){$dxrel3=$datos[34];}
			    
				$sql="INSERT INTO consulta (id_aten,motivo_con,enfermedad_con,revisionsist_con,id_cups,finalidad_con,causaext_con,analisis_con,dxprinc_con,dxrela1_con,dxrela2_con,dxrela3_con,tipodx_con,plan_con,observacion_con,control_con,subjetivo_con,objetivo_con,violencia_sexual_con) VALUES('$id_aten', '$datos[21]', '$datos[22]', '$datos[23]', '$datos[26]', '$datos[27]', '$datos[28]', '$datos[29]', '$datos[30]',$dxrel1, $dxrel2, $dxrel3, '$datos[31]', '$datos[35]', '$datos[36]','$datos[50]','$datos[51]','$datos[52]','$datos[53]')";				
				//echo "<br>".$sql;

				$guardado=mysqli_query($conexion,$sql);
				$id_con=mysqli_insert_id($conexion);
			}
			else{
				$rowcon=mysqli_fetch_row($consultacon);
				$id_con=$rowcon[0];
				$dxrel1=0;
			    $dxrel2=0;
			    $dxrel3=0;
			    if(!empty($datos[32])){$dxrel1=$datos[32];}
			    if(!empty($datos[33])){$dxrel2=$datos[33];}
			    if(!empty($datos[34])){$dxrel3=$datos[34];}
				$sql="UPDATE consulta SET motivo_con='$datos[21]',enfermedad_con='$datos[22]',revisionsist_con='$datos[23]',id_cups='$datos[26]',finalidad_con='$datos[27]',causaext_con='$datos[28]',analisis_con='$datos[29]',dxprinc_con='$datos[30]',dxrela1_con='$dxrel1',dxrela2_con='$dxrel2',dxrela3_con='$dxrel3',tipodx_con='$datos[31]',plan_con='$datos[35]',observacion_con='$datos[36]',control_con='$datos[50]',subjetivo_con='$datos[51]',objetivo_con='$datos[52]',violencia_sexual_con='$datos[53]' WHERE id_con='$id_con'";				
				//echo "<br>".$sql;
				$guardado=mysqli_query($conexion,$sql);
				
			}
			$consultadp="SELECT id_con_dp FROM consulta_dpersonales WHERE id_aten='$id_aten'";	
			$consultadp=mysqli_query($conexion,$consultadp);
			if(mysqli_num_rows($consultadp)==0){
				$sql="INSERT INTO consulta_dpersonales(id_aten, tipoiden_dp, numeroiden_dp, nombre_dp, fechanac_dp, genero_dp, direccion_dp, telefono_dp, etnia_dp, ocupacion_dp, niveleduc_dp, estadociv_dp, tipovin_dp, tipoafil_dp, grupopob_dp, zonares_dp) VALUES('$id_aten', '$datos[0]', '$datos[1]', '$datos[2]', '$datos[5]', '$datos[6]', '$datos[3]', '$datos[4]', '$datos[7]', '$datos[8]', '$datos[9]', '$datos[10]', '$datos[11]', '$datos[12]', '$datos[13]', '$datos[14]')";
				//echo "<br>".$sql;
				mysqli_query($conexion,$sql);
			}
			else{
				$rowdp=mysqli_fetch_row($consultadp);
				$id_con_dp=$rowcon[0];
				$sql="UPDATE consulta_dpersonales SET tipoiden_dp='$datos[0]', numeroiden_dp='$datos[1]', nombre_dp='$datos[2]', fechanac_dp='$datos[5]', genero_dp='$datos[6]', direccion_dp='$datos[3]', telefono_dp='$datos[4]', etnia_dp='$datos[7]', ocupacion_dp='$datos[8]', niveleduc_dp='$datos[9]', estadociv_dp='$datos[10]', tipovin_dp='$datos[11]', tipoafil_dp='$datos[12]', grupopob_dp='$datos[13]', zonares_dp='$datos[14]' WHERE id_con_dp='$id_con_dp'";
				//echo "<br>".$sql;
				mysqli_query($conexion,$sql);	
			}

			$consultaacu="SELECT id_con_acu FROM consulta_acudiente WHERE id_aten='$id_aten'";			
			$consultaacu=mysqli_query($conexion,$consultaacu);
			if(mysqli_num_rows($consultaacu)==0){
				$sql="INSERT INTO consulta_acudiente(id_aten, tipoiden_acu, numeroiden_acu, nombre_acu, direccion_acu, telefono_acu, parentesco_acu) VALUES('$id_aten', '$datos[15]', '$datos[16]', '$datos[17]', '$datos[18]', '$datos[19]', '$datos[20]')";
				//echo "<br>".$sql;
				mysqli_query($conexion,$sql);
			}
			else{
				$rowacu=mysqli_fetch_row($consultaacu);
				$id_con_acu=$rowcon[0];
				$sql="UPDATE consulta_acudiente SET tipoiden_acu='$datos[15]', numeroiden_acu='$datos[16]', nombre_acu='$datos[17]', direccion_acu='$datos[18]', telefono_acu='$datos[19]', parentesco_acu='$datos[20]' WHERE id_con_acu='$id_con_acu'";
				//echo "<br>".$sql;
				mysqli_query($conexion,$sql);
			}

			if(!empty($datos[37]) OR !empty($datos[38]) OR !empty($datos[39]) OR !empty($datos[40]) OR !empty($datos[41]) OR !empty($datos[42]) OR !empty($datos[43]) OR !empty($datos[44]) OR !empty($datos[45]) OR !empty($datos[46])){
				$consultasv="SELECT id_sv FROM consulta_signos_vitales WHERE id_con='$id_con'";
				$consultasv=mysqli_query($conexion,$consultasv);
				if(mysqli_num_rows($consultasv)==0){
					$sql="INSERT INTO consulta_signos_vitales(id_con,tensionart_sv,frecresp_sv,freccard_sv,temperat_sv,perimetrocef_sv,peso_sv,talla_sv,indicemc_sv,indicecc_sv,observacion_sv)
					VALUES ('$id_con','$datos[37]','$datos[38]','$datos[39]','$datos[40]','$datos[41]','$datos[42]','$datos[43]','$datos[44]','$datos[45]','$datos[46]')";
					//echo "<br>".$sql;
					mysqli_query($conexion,$sql);
				}
				else{
					$rowsv=mysqli_fetch_row($consultasv);
					$id_sv=$rowcon[0];
					$sql="UPDATE consulta_signos_vitales SET tensionart_sv='$datos[37]',frecresp_sv='$datos[38]',freccard_sv='$datos[39]',temperat_sv='$datos[40]',perimetrocef_sv='$datos[41]',peso_sv='$datos[42]',talla_sv='$datos[43]',indicemc_sv='$datos[44]',indicecc_sv='$datos[45]',observacion_sv='$datos[46]' WHERE id_sv='$id_sv'";
					//echo "<br>".$sql;
					mysqli_query($conexion,$sql);
				}
			}

			//Aqui guardo los detalles del examen fisico
			$descripcion_exaf=$datos[47];
			$valor_exaf=$datos[48];
			$hallazgo_exaf=$datos[49];
			$cef=0;
			foreach ($valor_exaf as $valor_ ) {
				if($valor_<>''){
					$desc_=$descripcion_exaf[$cef];
					$hallaz_=$hallazgo_exaf[$cef];
					$consultaef="SELECT id_exaf FROM consulta_examen_fisico WHERE id_con='$id_con' AND descripcion_exaf='$desc_'";
					//echo "<br>".$consultaef;
					$consultaef=mysqli_query($conexion,$consultaef);
					if(mysqli_num_rows($consultaef)==0){
						$sql="INSERT INTO consulta_examen_fisico(id_con,descripcion_exaf,valor_exaf,hallazgo_exaf)
						VALUES ('$id_con','$desc_','$valor_','$hallaz_')";
						mysqli_query($conexion,$sql);
					}
					else{
						$rowef=mysqli_fetch_row($consultaef);
						$id_exaf=$rowef[0];
						$sql="UPDATE consulta_examen_fisico SET descripcion_exaf='$desc_',valor_exaf='$valor_',hallazgo_exaf='$hallaz_' WHERE id_exaf='$id_exaf'";
						mysqli_query($conexion,$sql);
					}
				}
				$cef++;
			}

			if(!empty($datos[24]) OR !empty($datos[25])){
				$consultaant="SELECT id_con_ante FROM consulta_antecedentes WHERE id_con='$id_con'";
				$consultaant=mysqli_query($conexion,$consultaant);
				if(mysqli_num_rows($consultaant)==0){
					$sql="INSERT INTO consulta_antecedentes(id_con,personales_ante,familiares_ante) VALUES('$id_con','$datos[24]','$datos[25]')";
					//echo "<br>".$sql;
					mysqli_query($conexion,$sql);
				}
				else{
					$rowant=mysqli_fetch_row($consultaant);
					$id_con_ante=$rowcon[0];
					$sql="UPDATE consulta_antecedentes SET personales_ante='$datos[24]',familiares_ante='$datos[25]' WHERE id_con_ante='$id_con_ante'";
					//echo "<br>".$sql;
					mysqli_query($conexion,$sql);
				}
			}
		}
		return ($guardado);
	}

	public function cerrarhistoria($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$sql="UPDATE agenda_cita SET estado_agc='Cumplida' WHERE id_agc='$_SESSION[gid_agc]'";
		//echo $sql;
		mysqli_query($conexion,$sql);

		$sql="UPDATE atencion SET estado_aten='C' WHERE id_aten='$datos[0]'";
		//echo $sql;
		$guardado=mysqli_query($conexion,$sql);
		return $guardado;
	}

	public function abrirhistoria($idaten){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$conscita="SELECT id_agc FROM atencion WHERE id_aten='$idaten'";
		//echo "<br>".$conscita;
		$conscita=mysqli_query($conexion,$conscita);
		if(mysqli_num_rows($conscita)<>0){
			$rowcita=mysqli_fetch_row($conscita);
			$id_agc=$rowcita[0];
			$sql="UPDATE agenda_cita SET estado_agc='En Atencion' WHERE id_agc='$id_agc'";
			//echo $sql;
			mysqli_query($conexion,$sql);
		}
		$sql="UPDATE atencion SET estado_aten='A' WHERE id_aten='$idaten'";
		//echo "<br>".$sql;
		$guardado=mysqli_query($conexion,$sql);
		return $guardado;
	}

	public function inasistencia($id_agc){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$sql="UPDATE agenda_cita SET estado_agc='Inasistencia' WHERE id_agc='$id_agc'";
		//echo $sql;
		$guardado=mysqli_query($conexion,$sql);
		return $guardado;
	}
}
?>
