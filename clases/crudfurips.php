<?php
session_start();

class crudfurips{
	
	public function agregar_reclamacion($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		if($_SESSION['gid_reclamacion']==0){
			$sql="INSERT INTO furips_reclamacion (numero_recant,respglo_recla,id_factura,condi_victima,naturaleza_even,descripcion_even,direccion_even,fecha_even,municipio_even,zona_even,id_operador)
			VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]','$datos[9]','$_SESSION[gusuario_log]')";
			//echo $sql;
			$guardado=mysqli_query($conexion,$sql);
			$id_reclamacion=mysqli_insert_id($conexion);
			if($guardado==1){$_SESSION['gid_reclamacion']=$id_reclamacion;}
		}
		else{
			$sql="UPDATE furips_reclamacion SET numero_recant='$datos[0]',respglo_recla='$datos[1]',id_factura='$datos[2]',condi_victima='$datos[3]',naturaleza_even='$datos[4]',descripcion_even='$datos[5]',direccion_even='$datos[6]',fecha_even='$datos[7]',municipio_even='$datos[8]',zona_even='$datos[9]' WHERE id_reclamacion=$_SESSION[gid_reclamacion]";			
			$guardado=mysqli_query($conexion,$sql);
		}		
		return $guardado;
	}

	public function agregar_vehiculo($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$id_vehiculo=0;
		$cons_vehiculo="SELECT id_vehiculo FROM furips_vehiculo WHERE id_reclamacion='$_SESSION[gid_reclamacion]'";
		$cons_vehiculo=mysqli_query($conexion,$cons_vehiculo);
		if(mysqli_num_rows($cons_vehiculo)<>0){
			$rowvehi=mysqli_fetch_row($cons_vehiculo);
			$id_vehiculo=$rowvehi[0];
		}
		if($id_vehiculo==0){
			$sql="INSERT INTO furips_vehiculo (id_reclamacion,estado_aseg,marca_vehiculo,placa_vehiculo,tipo_vehiculo,codigo_aseg,nombre_aseg,numero_poliza,fecha_inicio,fecha_final,intervencion_aut,cobro_excedente,placa_vehiculo2,tipoiden_propvehi2,identprop_vehi2,placa_vehiculo3,tipoiden_propvehi3,identprop_vehi3,id_propietario,id_conductor)
			VALUES ('$_SESSION[gid_reclamacion]','$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]','$datos[9]','$datos[10]','$datos[11]','$datos[12]','$datos[13]','$datos[14]','$datos[15]','$datos[16]','$datos[17]','$datos[18]')";
			//echo $sql;
			$guardado=mysqli_query($conexion,$sql);
		}
		else{
			$sql="UPDATE furips_vehiculo SET estado_aseg='$datos[0]',marca_vehiculo='$datos[1]',placa_vehiculo='$datos[2]',tipo_vehiculo='$datos[3]',codigo_aseg='$datos[4]',nombre_aseg='$datos[5],numero_poliza='$datos[6]',fecha_inicio='$datos[7]',fecha_final='$datos[8]',intervencion_aut='$datos[9]',cobro_excedente='$datos[10]',placa_vehiculo2='$datos[11]',tipoiden_propvehi2='$datos[12]',identprop_vehi2='$datos[13]',placa_vehiculo3='$datos[14]',tipoiden_propvehi3='$datos[15]',identprop_vehi3='$datos[16]',id_propietario='$datos[17]',id_conductor='$datos[18]' WHERE id_vehiculo=$id_vehiculo";
			//echo $sql;
			$guardado=mysqli_query($conexion,$sql);	
		}
		return $guardado;
	}

	public function agregar_remision($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$id_remision=0;
		$cons_remi="SELECT id_remision FROM furips_remision WHERE id_reclamacion='$_SESSION[gid_reclamacion]'";
		$cons_remi=mysqli_query($conexion,$cons_remi);
		if(mysqli_num_rows($cons_remi)<>0){
			$rowremi=mysqli_fetch_row($cons_remi);
			$id_remision=$rowremi[0];
		}
		if($id_remision==0){
			$sql="INSERT INTO furips_remision (id_reclamacion,tipo_refer,fecha_remi,hora_salida,cod_habilitacion_remi,nombre_ent_remite,profesional_remite,cargo_remite,fecha_ingre_remi,id_profesional_recibe)
			VALUES ('$_SESSION[gid_reclamacion]','$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]')";
			//echo $sql;
			$guardado=mysqli_query($conexion,$sql);
		}
		else{
			$sql="UPDATE furips_remision SET tipo_refer='$datos[0]',fecha_remi='$datos[1]',hora_salida='$datos[2]',cod_habilitacion_remi='$datos[3]',nombre_ent_remite='$datos[4]',profesional_remite='$datos[5]',cargo_remite='$datos[6]',fecha_ingre_remi='$datos[7]',id_profesional_recibe='$datos[8]' WHERE id_remision=$id_remision";
			//echo $sql;
			$guardado=mysqli_query($conexion,$sql);
		}
		return $guardado;
	}

	public function agregar_atencion($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$id_atencion=0;
		$cons_aten="SELECT id_atencion FROM furips_atencion WHERE id_reclamacion='$_SESSION[gid_reclamacion]'";
		//echo $cons_aten;
		$cons_aten=mysqli_query($conexion,$cons_aten);
		if(mysqli_num_rows($cons_aten)<>0){
			$rowaten=mysqli_fetch_row($cons_aten);
			$id_atencion=$rowaten[0];
		}
		if($id_atencion==0){
			$sql="INSERT INTO furips_atencion (id_reclamacion,fecha_ingreso,fecha_egreso,dx_principal_ingre,dx_relac1_ingre,dx_relac2_ingre,dx_principal_egre,dx_relac1_egre,dx_relac2_egre,id_profesional)
			VALUES ('$_SESSION[gid_reclamacion]','$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]')";
			//echo $sql;
			$guardado=mysqli_query($conexion,$sql);
		}
		else{
			$sql="UPDATE furips_atencion SET fecha_ingreso='$datos[0]',fecha_egreso='$datos[1]',dx_principal_ingre='$datos[2]',dx_relac1_ingre='$datos[3]',dx_relac2_ingre='$datos[4]',dx_principal_egre='$datos[5]',dx_relac1_egre='$datos[6]',dx_relac2_egre='$datos[7]',id_profesional='$datos[8]'
			 WHERE id_atencion=$id_atencion";
			//echo $sql;
			$guardado=mysqli_query($conexion,$sql);
		}
		return $guardado;
	}

	public function agregar_amparo($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$id_amparo=0;
		$cons_amparo="SELECT id_amparo FROM furips_amparo WHERE id_reclamacion='$_SESSION[gid_reclamacion]'";
		//echo $cons_aten;
		$cons_amparo=mysqli_query($conexion,$cons_amparo);
		if(mysqli_num_rows($cons_amparo)<>0){
			$rowamparo=mysqli_fetch_row($cons_amparo);
			$id_amparo=$rowamparo[0];
		}
		if($id_amparo==0){
			$sql="INSERT INTO furips_amparo (id_reclamacion,total_facturado,total_reclamo,total_transporte,total_reclamo_trans,total_folios)
			VALUES ('$_SESSION[gid_reclamacion]','$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]')";
			//echo $sql;
			$guardado=mysqli_query($conexion,$sql);
		}
		else{
			$sql="UPDATE furips_amparo SET 
			total_facturado='$datos[0]',total_reclamo='$datos[1]',total_transporte='$datos[2]',total_reclamo_trans='$datos[3]',total_folios='$datos[4]'
			WHERE id_amparo=$id_amparo";
			//echo $sql;
			$guardado=mysqli_query($conexion,$sql);
		}
		return $guardado;
	}

	public function obtenDatosfurips($idreclamacion){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT numero_recant,respglo_recla,furips_reclamacion.id_factura,condi_victima,naturaleza_even,descripcion_even,direccion_even,fecha_even,municipio_even,zona_even,estado_recla,fecha_reg,id_operador,
		vw_factura_lista.descripcion,
		municipio.nombre_mun
		FROM furips_reclamacion 
		INNER JOIN vw_factura_lista ON vw_factura_lista.id_factura=furips_reclamacion.id_factura
		LEFT JOIN municipio ON municipio.codigo_mun=furips_reclamacion.municipio_even
		WHERE id_reclamacion='$idreclamacion'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array('numero_recant' =>$ver[0],
			'respglo_recla' =>$ver[1],
			'id_factura' =>$ver[2],
			'condi_victima' =>$ver[3],
			'naturaleza_even' =>$ver[4],
			'descripcion_even' =>$ver[5],
			'direccion_even' =>$ver[6],
			'fecha_even' =>$ver[7],
			'municipio_even' =>$ver[8],
			'zona_even' =>$ver[9],
			'estado_recla' =>$ver[10],
			'fecha_reg' =>$ver[11],
			'id_operador' =>$ver[12],
			'descripcion' =>$ver[13],
			'nombre_mun' =>$ver[14]
			);
		return $datos;
	}

	public function obtenDatosvehiculo($idreclamacion){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_vehiculo,estado_aseg,marca_vehiculo,placa_vehiculo,tipo_vehiculo,codigo_aseg,nombre_aseg,numero_poliza,fecha_inicio,fecha_final,intervencion_aut,cobro_excedente,placa_vehiculo2,tipoiden_propvehi2,identprop_vehi2,placa_vehiculo3,tipoiden_propvehi3,identprop_vehi3,furips_vehiculo.id_propietario,furips_vehiculo.id_conductor,
		propietario.nombre AS nombre_propietario,
		conductor.nombre AS nombre_conductor
		FROM furips_vehiculo
		LEFT JOIN vw_furips_nopersona AS propietario ON propietario.id_persona=furips_vehiculo.id_propietario
		LEFT JOIN vw_furips_nopersona AS conductor ON conductor.id_persona=furips_vehiculo.id_conductor
		WHERE id_reclamacion='$idreclamacion'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array('id_vehiculo' =>$ver[0],
			'estado_aseg' =>$ver[1],
			'marca_vehiculo' =>$ver[2],
			'placa_vehiculo' =>$ver[3],
			'tipo_vehiculo' =>$ver[4],
			'codigo_aseg' =>$ver[5],
			'nombre_aseg' =>$ver[6],
			'numero_poliza' =>$ver[7],
			'fecha_inicio' =>$ver[8],
			'fecha_final' =>$ver[9],
			'intervencion_aut' =>$ver[10],
			'cobro_excedente' =>$ver[11],
			'placa_vehiculo2' =>$ver[12],
			'tipoiden_propvehi2' =>$ver[13],
			'identprop_vehi2' =>$ver[14],
			'placa_vehiculo3' =>$ver[15],
			'tipoiden_propvehi3' =>$ver[16],
			'identprop_vehi3' =>$ver[17],
			'id_propietario' =>$ver[18],
			'id_conductor' =>$ver[19],
			'nombre_propietario' =>$ver[20],
			'nombre_conductor' =>$ver[21]
			);
		return $datos;
	}

	public function obtenDatosremision($idreclamacion){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_remision,tipo_refer,fecha_remi,hora_salida,cod_habilitacion_remi,nombre_ent_remite,profesional_remite,cargo_remite,fecha_ingre_remi,id_profesional_recibe
		FROM furips_remision
		WHERE id_reclamacion='$idreclamacion'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array('id_remision' =>$ver[0],
			'tipo_refer' =>$ver[1],
			'fecha_remi' =>$ver[2],
			'hora_salida' =>$ver[3],
			'cod_habilitacion_remi' =>$ver[4],
			'nombre_ent_remite' =>$ver[5],
			'profesional_remite' =>$ver[6],
			'cargo_remite' =>$ver[7],
			'fecha_ingre_remi' =>$ver[8],
			'id_profesional_recibe' =>$ver[9]
			);
		return $datos;
	}

	public function obtenDatosatencion($idreclamacion){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_atencion,fecha_ingreso,fecha_egreso,dx_principal_ingre,dx_relac1_ingre,dx_relac2_ingre,dx_principal_egre,dx_relac1_egre,dx_relac2_egre,id_profesional,
		cie_princ_ing.descripcion AS desc_principal_ingre,
		cie_princ_egr.descripcion AS desc_principal_egre,
		cie_rela1_ing.descripcion AS desc_relac1_ingre,
		cie_rela2_ing.descripcion AS desc_relac2_ingre,
		cie_rela1_egr.descripcion AS desc_relac1_egre,
		cie_rela2_egr.descripcion AS desc_relac2_egre
		FROM furips_atencion
		INNER JOIN vw_cie AS cie_princ_ing ON cie_princ_ing.id_cie=dx_principal_ingre
		INNER JOIN vw_cie AS cie_princ_egr ON cie_princ_egr.id_cie=dx_principal_egre
		LEFT JOIN vw_cie AS cie_rela1_ing ON cie_rela1_ing.id_cie=dx_relac1_ingre
		LEFT JOIN vw_cie AS cie_rela2_ing ON cie_rela2_ing.id_cie=dx_relac2_ingre
		LEFT JOIN vw_cie AS cie_rela1_egr ON cie_rela1_egr.id_cie=dx_relac1_egre
		LEFT JOIN vw_cie AS cie_rela2_egr ON cie_rela2_egr.id_cie=dx_relac2_egre
		WHERE id_reclamacion='$idreclamacion'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array('id_atencion' =>$ver[0],
			'fecha_ingreso' =>$ver[1],
			'fecha_egreso' =>$ver[2],
			'dx_principal_ingre' =>$ver[3],
			'dx_relac1_ingre' =>$ver[4],
			'dx_relac2_ingre' =>$ver[5],
			'dx_principal_egre' =>$ver[6],
			'dx_relac1_egre' =>$ver[7],
			'dx_relac2_egre' =>$ver[8],
			'id_profesional' =>$ver[9],
			'desc_principal_ingre' =>$ver[10],
			'desc_principal_egre' =>$ver[11],
			'desc_relac1_ingre' =>$ver[12],
			'desc_relac2_ingre' =>$ver[13],
			'desc_relac1_egre' =>$ver[14],
			'desc_relac2_egre' =>$ver[15]
			);
		return $datos;
	}

	public function obtenDatosamparo($idreclamacion){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_amparo,total_facturado,total_reclamo,total_transporte,total_reclamo_trans,total_folios
		FROM furips_amparo
		WHERE id_reclamacion='$idreclamacion'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array('id_amparo' =>$ver[0],
			'total_facturado' =>$ver[1],
			'total_reclamo' =>$ver[2],
			'total_transporte' =>$ver[3],
			'total_reclamo_trans' =>$ver[4],
			'total_folios' =>$ver[5]
			);
		return $datos;
	}

	public function cerrar($idrec){
		$obj=new conectar();
		$conexion=$obj->conexion();		
		$sql="UPDATE furips_reclamacion SET estado_recla='C' WHERE id_reclamacion='$idrec'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
