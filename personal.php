	
	<?php
	setlocale(LC_MONETARY, 'es_MX');
	
	$usr=$_SESSION['UserID'];
	$based=$_SESSION['DB'];
	$buscar_id_usuario="select usuarioid from usuarios where usuario='$usr'";
	$res_biu=mysqli_query($conn,$buscar_id_usuario);
	$r_biu=mysqli_fetch_array($res_biu);
	$usuarioid=$r_biu['usuarioid'];//id del usuario actual
	
	$buscar_perfil_actual="select Grupo from auwimx_miembros where Usuario='$usuarioid'";
	$res_bpa=mysqli_query($conn,$buscar_perfil_actual);
	$r_bpa=mysqli_fetch_array($res_bpa);
	$pefil_actual=$r_bpa['Grupo'];//Id del perfil actual al que pertenece el usuario en uso.
	

	
	if($_GET['accion']=="editar"){
			if(empty($_GET['id'])){
				$id_del_personal=$_GET['id_pe'];
				$buscar_usuario_en_personal="select id_usuario from personal where idPersonal='$id_del_personal'";
				$res_buep=mysqli_query($conn,$buscar_usuario_en_personal);
				$r_buep=mysqli_fetch_array($res_buep);
				$id_del_usuario=$r_buep['id_usuario'];
				$buscar_en_personal="select id_usuario from personal where idPersonal='$id_del_personal'";
			}else{
				$id_del_usuario=$_GET['id'];
				$buscar_en_personal="select id_usuario from personal where id_usuario='$id_del_usuario'";
			}
			
			$res_bep=mysqli_query($conn,$buscar_en_personal);
			$r_bep=mysqli_num_rows($res_bep);
			
			$buscar_en_usuarios="select usuario,usuariopas,Id_paquete from usuarios where usuarioid='$id_del_usuario'";
			$res_beu=mysqli_query($conn,$buscar_en_usuarios);
			$r_beu=mysqli_fetch_array($res_beu);
			
			$buscar_perfil_actual="select Grupo from auwimx_miembros where Usuario='$id_del_usuario'";
			$res_bpa=mysqli_query($conn,$buscar_perfil_actual);
			$r_bpa=mysqli_fetch_array($res_bpa);
			
			///datos usuario inicio/////////
			if(empty($r_beu['usuario'])){
				$usr_usuario="";
			}else{
				$usr_usuario=$r_beu['usuario'];
			}
			if(empty($r_beu['usuariopas'])){
				$pass_usuario="";
			}else{
				$pass_usuario=$r_beu['usuariopas'];
			}
			$paquete_usuario=$r_beu['Id_paquete'];
			$pefil_actual=$r_bpa['Grupo'];//Id del perfil actual al que pertenece el usuario en uso.
			
			
			$condicion_in="in(";
			$buscar_modulos_en_perfil="select Distinct(modulo) as modo from auwimx_derechos_copy where Id_G='$pefil_actual' and (Agregar='1' or Editar='1'  or Eliminar='1' or Visualizar='1' or Importar='1' or Exportar='1' or Imprimir='1' )";
			$res_bmep=mysqli_query($conn,$buscar_modulos_en_perfil);
			while($r_bmep=mysqli_fetch_array($res_bmep)){
				$modo=$r_bmep['modo'];
				if($condicion_in=="in("){
					$condicion_in.=$modo;
				}else{
					$condicion_in.=",".$modo;
				}
			}
			$condicion_in.=")";//Condicion para obtener los modulos pertenecientes al perfil actual.
			///datos usuario final/////////
			if(empty($_GET['id'])){
				$buscar_per_en_personal="select nombre,puesto,afecta_preciofuv,apellido_paterno,telefonoCasa,telefonoCelular,correo,fechaIngreso,fechaSalida,fechavlicencia,tipoempleado,tipopago,diapago,area,departamento,zona,periodo_t,dia_descanso,eventual,fechaNacimiento,escolaridad,comision,sueldodiario,cps,estado,municipio,colonia,calle,numeroExterior,numeroInterior,curp,rfc,fechaAlta,fechaBaja,tiposangre,apellido_materno,v_movil,vendedor,t_movil,op_crm,l_crm,cajero,Chofer,foto,h1,h2,activo,comentarios,ecobranza,ecivil,vivienda,hijos,nhijos,npersonal,sexo, promotor,curp_file,cdomicilio,creferencia,cretencion,rfc_file,cestudios,imss,ife,licencia,certificado,mbaja,Fotografia2,Contrato,Renuncia,Otros,grados,floor(datediff(curdate(),fechaNacimiento) / 365) as edadActual,floor(datediff(curdate(),fechaIngreso)) as IngresoDias,TIMESTAMPDIFF(MONTH, fechaIngreso, curdate()) as IngresoMeses,floor(datediff(curdate(),fechaIngreso) / 365) as IngresoAños,sucursal,elegible,recontratable,TIMESTAMPDIFF( YEAR, fechaIngreso, curdate() ) as _year
				, TIMESTAMPDIFF( MONTH, fechaIngreso, curdate() ) % 12 as _month
				, FLOOR( TIMESTAMPDIFF( DAY, fechaIngreso, curdate() ) % 30.4375 ) as _day,editar_remision,llam_emergencia,nacionalidad,noimss,FechaInicial,Dias_duracion,Fecha_Final from personal where idPersonal='$id_del_personal'";
			}else{
				$buscar_per_en_personal="select nombre,puesto,afecta_preciofuv,apellido_paterno,telefonoCasa,telefonoCelular,correo,fechaIngreso,fechaSalida,fechavlicencia,tipoempleado,tipopago,diapago,area,departamento,zona,periodo_t,dia_descanso,eventual,fechaNacimiento,escolaridad,comision,sueldodiario,cps,estado,municipio,colonia,calle,numeroExterior,numeroInterior,curp,rfc,fechaAlta,fechaBaja,tiposangre,apellido_materno,v_movil,vendedor,t_movil,op_crm,l_crm,cajero,Chofer,foto,h1,h2,activo,comentarios,ecobranza,ecivil,vivienda,hijos,nhijos,npersonal,sexo, promotor,curp_file,cdomicilio,creferencia,cretencion,rfc_file,cestudios,imss,ife,licencia,certificado,mbaja,Fotografia2,Contrato,Renuncia,Otros,grados,floor(datediff(curdate(),fechaNacimiento) / 365) as edadActual,floor(datediff(curdate(),fechaIngreso)) as IngresoDias,TIMESTAMPDIFF(MONTH, fechaIngreso, curdate()) as IngresoMeses,floor(datediff(curdate(),fechaIngreso) / 365) as IngresoAños,sucursal,elegible,recontratable,TIMESTAMPDIFF( YEAR, fechaIngreso, curdate() ) as _year
				, TIMESTAMPDIFF( MONTH, fechaIngreso, curdate() ) % 12 as _month
				, FLOOR( TIMESTAMPDIFF( DAY, fechaIngreso, curdate() ) % 30.4375 ) as _day,editar_remision,llam_emergencia,nacionalidad,noimss,FechaInicial,Dias_duracion,Fecha_Final from personal where id_usuario='$id_del_usuario'";
			}
			
			$res_bpep=mysqli_query($conn,$buscar_per_en_personal);
			$r_bpep=mysqli_fetch_array($res_bpep);
			$FechaInicial=$r_bpep['FechaInicial'];
			$Dias_duracion=$r_bpep['Dias_duracion'];
			$Fecha_Final=$r_bpep['Fecha_Final'];

			$vendedor_movil=(int)$r_bpep['v_movil'];
			$edadActual=(int)$r_bpep['edadActual'];
			if($edadActual>0){
				$edad=$edadActual." Años";
			}else{
				$edad="N/A";
			}
			$IngresoDias=(int)$r_bpep['IngresoDias'];
			$IngresoAños=(int)$r_bpep['IngresoAños'];
			$IngresoMeses=(int)$r_bpep['IngresoMeses'];
			$llam_emergencia=(int)$r_bpep['llam_emergencia'];
			$nacionalidad=$r_bpep['nacionalidad'];
			$noimss=$r_bpep['noimss'];
			$days=(int)$r_bpep['_day'];
			$month=(int)$r_bpep['_month'];
			if($IngresoDias>364){
				$tiempoIngreso=$IngresoAños." Años ".$month." Meses ".$days." Días";				
			}else{
				$tiempoIngreso=$IngresoAños." Años ".$month." Meses ".$days." Días";
			}
			$vendedor=(int)$r_bpep['vendedor'];
			$sucursal=(int)$r_bpep['sucursal'];
			$elegible=(int)$r_bpep['elegible'];
			$recontratable=(int)$r_bpep['recontratable'];
			$tecnico_movil=(int)$r_bpep['t_movil'];
			$operador_movil=(int)$r_bpep['op_crm'];
			$lider_movil=(int)$r_bpep['l_crm'];
			$cajero=(int)$r_bpep['cajero'];
			$chofer=(int)$r_bpep['Chofer'];
			$afecta_preciofuv=(int)$r_bpep['afecta_preciofuv'];
			$encargado_cobranza=(int)$r_bpep['ecobranza'];
			$promotor = (int)$r_bpep['promotor'];
			$ecivil = (int)$r_bpep['ecivil'];
			$vivienda = (int)$r_bpep['vivienda'];
			$hijos = (int)$r_bpep['hijos'];
			$nhijos = (int)$r_bpep['nhijos'];
			$npersonal =$r_bpep['npersonal'];
			$sexo = (int)$r_bpep['sexo'];
			$mbaja = (int)$r_bpep['mbaja'];
			$grados = (int)$r_bpep['grados'];
			$editar_remision = (int)$r_bpep['editar_remision'];
			
			$arreglo_movil_asignado=array();
			$arreglo_movil_noasignado=array();
			if($vendedor_movil==1){
				array_push($arreglo_movil_asignado,"Vendedor móvil,1");
			}else{
				array_push($arreglo_movil_noasignado,"Vendedor móvil,1");
			}
			if($vendedor==1){
				array_push($arreglo_movil_asignado,"Vendedor,2");
			}else{
				array_push($arreglo_movil_noasignado,"Vendedor,2");
			}
			if($tecnico_movil==1){
				array_push($arreglo_movil_asignado,"Técnico móvil,3");
			}else{
				array_push($arreglo_movil_noasignado,"Técnico móvil,3");
			}
			if($operador_movil==1){
				array_push($arreglo_movil_asignado,"Operador CRM,4");
			}else{
				array_push($arreglo_movil_noasignado,"Operador CRM,4");
			}
			if($lider_movil==1){
				array_push($arreglo_movil_asignado,"Líder CRM,5");
			}else{
				array_push($arreglo_movil_noasignado,"Líder CRM,5");
			}
			if($cajero==1){
				array_push($arreglo_movil_asignado,"Cajero,6");
			}else{
				array_push($arreglo_movil_noasignado,"Cajero,6");
			}
			if($chofer==1){
				array_push($arreglo_movil_asignado,"APP de repartidor,7");
			}else{
				array_push($arreglo_movil_noasignado,"APP de repartidor,7");
			}
			if($afecta_preciofuv==1){
				array_push($arreglo_movil_asignado,"Edita precio factura/remisión,8");
			}else{
				array_push($arreglo_movil_noasignado,"Edita precio factura/remisión,8");
			}
			if($encargado_cobranza==1){
				array_push($arreglo_movil_asignado,"Encargado de cobranza,9");
			}else{
				array_push($arreglo_movil_noasignado,"Encargado de cobranza,9");
			}
			if($promotor ==1){
				array_push($arreglo_movil_asignado,"Promotor,11");
			}else{
				array_push($arreglo_movil_noasignado,"Promotor,11");
			}

			if($editar_remision ==1){
				array_push($arreglo_movil_asignado,"Editar remisión,12");
			}else{
				array_push($arreglo_movil_noasignado,"Editar remisión,12");
			}
			//Datos de empleado incio//
	$nombre_empleado=$r_bpep['nombre'];
	$puesto_empleado=$r_bpep['puesto'];
	$apellidop_empleado=$r_bpep['apellido_paterno'];
	$apellidom_empleado=$r_bpep['apellido_materno'];
	if($r_bpep['fechaAlta']=="0000-00-00"){
		$fechaAlta_empleado ="";
	}else{
	$date =date_create($r_bpep['fechaAlta']);
	$fechaAlta_empleado = date_format($date, 'd-m-Y');
	}
	if($r_bpep['fechaBaja']=="0000-00-00"){
		$fechaBaja_empleado ="";
	}else{
	$date =date_create($r_bpep['fechaBaja']);
	$fechaBaja_empleado = date_format($date, 'd-m-Y');
	}
	$curp_empleado=$r_bpep['curp'];
	$rfc_empleado=$r_bpep['rfc'];
	$tsangre_empleado=$r_bpep['tiposangre'];
	$estado_empleado=$r_bpep['estado'];
	$municipio_empleado=$r_bpep['municipio'];
	$colonia_empleado=$r_bpep['colonia'];
	$calle_empleado=$r_bpep['calle'];
	$nexterior_empleado=$r_bpep['numeroExterior'];
	$ninterior_empleado=$r_bpep['numeroInterior'];
	$tcasa_empleado=$r_bpep['telefonoCasa'];
	$tcelular_empleado=$r_bpep['telefonoCelular'];
	$correo_empleado=$r_bpep['correo'];
	if($r_bpep['fechaNacimiento']=="0000-00-00"){
		$fechaNacimiento_empleado = "";
	}else{
	$date2 =date_create($r_bpep['fechaNacimiento']);
	$fechaNacimiento_empleado = date_format($date2, 'd-m-Y');
	}
	$codigopostal_empleado=$r_bpep['cps'];
	$escolaridad_empleado=$r_bpep['escolaridad'];
	$salariodiario_empleado=str_replace(" ","",money_format('%(#10n', $r_bpep['sueldodiario']));
	$comision_empleado=$r_bpep['comision']."%";
	$periodoTrabajo_empleado=$r_bpep['periodo_t'];
	$tipo_empleado=$r_bpep['eventual'];
	if($tipo_empleado=="Eventual"){
		$eventual="checked";
		$planta="";
	}else{
		$eventual="";
		$planta="checked";
	}
	$diaDescanso_empleado=$r_bpep['dia_descanso'];
	$area_empleado=$r_bpep['area'];
	$departamento_empleado=$r_bpep['departamento'];
	$zona_empleado=$r_bpep['zona'];
	$diaDePago_empleado=$r_bpep['diapago'];
	$tipoPago_empleado=$r_bpep['tipopago'];
	$tipoemp_empleado=$r_bpep['tipoempleado'];
	if($r_bpep['fechaIngreso']=="0000-00-00"){
		$fechaIngreso_empleado="";
	}else{
	$date3 =date_create($r_bpep['fechaIngreso']);
	$fechaIngreso_empleado = date_format($date3, 'd-m-Y');
	}
	if($r_bpep['fechaSalida']=="0000-00-00"){
		$fechaSalida_empleado ="";
	}else{
		$date4 =date_create($r_bpep['fechaSalida']);
		$fechaSalida_empleado = date_format($date4, 'd-m-Y');
	}
	if($r_bpep['fechavlicencia']=="0000-00-00"){
		$fechaLicencia_empleado ="";
	}else{
		$date5 =date_create($r_bpep['fechavlicencia']);
	$fechaLicencia_empleado = date_format($date5, 'd-m-Y');
	}
	
	$foto_empleado=$r_bpep['foto'];
	$hora1=$r_bpep['h1'];
	$hora2=$r_bpep['h2'];
	if(empty($r_bpep['activo']) || $r_bpep['activo']==0){
		if(empty($_GET['id'])){
			$activo_empleado=1;
		}else{
			$activo_empleado=0;
		}
	}else{
		$activo_empleado=(int)$r_bpep['activo'];
	}
	
	if($activo_empleado==1){
			$estado_boton1="";
			$estado_boton2="style='display: none;'";
		}else{
			$estado_boton1="style='display: none;'";
			$estado_boton2="";
		}
		$comentarios_empleado=$r_bpep['comentarios'];
		if($r_bpep['imss']){
			$imssFile="<a href='modulos/".$r_bpep['imss']."' download>Descargar</a>";
		}else{
			$imssFile="";		
		}
		if($r_bpep['ife']){
			$ife="<a href='modulos/".$r_bpep['ife']."' download>Descargar</a>";
			
		}else{
			$ife="";			
		}
		
		if($r_bpep['licencia']){
			$licencia="<a href='modulos/".$r_bpep['licencia']."' download>Descargar</a>";
		}else{
			$licencia="";
		}
		if($r_bpep['certificado']){
			$certificado="<a href='modulos/".$r_bpep['certificado']."' download>Descargar</a>";
		}else{
			$certificado="";
		}
		if($r_bpep['curp_file']){
			$curp_file="<a href='modulos/".$r_bpep['curp_file']."' download>Descargar</a>";
		}else{
			$curp_file="";
		}
		if($r_bpep['cdomicilio']){
			$cdomicilio="<a href='modulos/".$r_bpep['cdomicilio']."' download>Descargar</a>";
		}else{
			$cdomicilio="";
		}
		if($r_bpep['creferencia']){
			$creferencia="<a href='modulos/".$r_bpep['creferencia']."' download>Descargar</a>";
		}else{
			$creferencia="";
		}
		if($r_bpep['cretencion']){
			$cretencion="<a href='modulos/".$r_bpep['cretencion']."' download>Descargar</a>";
		}else{
		$cretencion="";
		}
		if($r_bpep['rfc_file']){
			$rfc_file="<a href='modulos/".$r_bpep['rfc_file']."' download>Descargar</a>";
		}else{
		$rfc_file="";
		}
		if($r_bpep['cestudios']){
			$cestudios="<a href='modulos/".$r_bpep['cestudios']."' download>Descargar</a>";
		}else{
		$cestudios="";
		}
		if($r_bpep['Fotografia2']){
			$Fotografia2="<a href='modulos/".$r_bpep['Fotografia2']."' download>Descargar</a>";
		}else{
		$Fotografia2="";
		}
		if($r_bpep['Contrato']){
			$Contrato="<a href='modulos/".$r_bpep['Contrato']."' download>Descargar</a>";
		}else{
		$Contrato="";
		}
		if($r_bpep['Renuncia']){
			$Renuncia="<a href='modulos/".$r_bpep['Renuncia']."' download>Descargar</a>";
		}else{
		$Renuncia="";
		}
		if($r_bpep['Otros']){
			$Otros="<a href='modulos/".$r_bpep['Otros']."' download>Descargar</a>";
		}else{
		$Otros="";
		}
		
	//Datos de empleado final//
	}else{//Variables limpias cuando no es editar
		$nombre_empleado="";
		$puesto_empleado="";
		$apellidop_empleado="";
		$apellidom_empleado="";
		$fechaAlta_empleado=date("d-m-Y");
		$fechaBaja_empleado ="";
		$curp_empleado="";
		$rfc_empleado="";
		$tsangre_empleado="";
		$estado_empleado="";
		$municipio_empleado="";
		$colonia_empleado="";
		$calle_empleado="";
		$nexterior_empleado="";
		$ninterior_empleado="";
		$tcasa_empleado="";
		$tcelular_empleado="";
		$correo_empleado="";
		$fechaNacimiento_empleado="";
		$salariodiario_empleado="";
		$escolaridad_empleado="";
		$comision_empleado="";
		$periodoTrabajo_empleado="";
		$tipo_empleado="";
		$eventual="";
		$planta="";
		$diaDescanso_empleado="";
		$area_empleado="";
		$departamento_empleado="";
		$zona_empleado="";
		$diaDePago_empleado="";
		$tipoPago_empleado="";
		$tipoemp_empleado="";
		$fechaIngreso_empleado="";
		$fechaSalida_empleado="";
		$fechaLicencia_empleado="";
		$usr_usuario="";
		$pass_usuario="";
		$foto_empleado="";
		$hora1="";
		$hora2="";
		$activo_empleado="";
		$estado_boton1="";
		$estado_boton2="";
		$comentarios_empleado="";
		$paquete_usuario="";
		$ecivil ="";
		$vivienda ="";
		$hijos ="";
		$nhijos ="";
		$npersonal ="";
		$sexo ="";
		$imssFile="";
		$ife="";
		$licencia="";
		$certificado="";
		$curp_file="";
		$cdomicilio="";
		$creferencia="";
		$cretencion="";
		$rfc_file="";
		$cestudios="";
		$llam_emergencia="";
		$nacionalidad="";
		$noimss="";
		
		$condicion_in="in(";
		$buscar_modulos_en_perfil="select Distinct(modulo) as modo from auwimx_derechos_copy where Id_G='$pefil_actual' and (Agregar='1' or Editar='1'  or Eliminar='1' or Visualizar='1' or Importar='1' or Exportar='1' or Imprimir='1' )";
		$res_bmep=mysqli_query($conn,$buscar_modulos_en_perfil);
		while($r_bmep=mysqli_fetch_array($res_bmep)){
			$modo=$r_bmep['modo'];
			if($condicion_in=="in("){
				$condicion_in.=$modo;
			}else{
				$condicion_in.=",".$modo;
			}
		}
		$condicion_in.=")";//Condicion para obtener los modulos pertenecientes al perfil actual.
	}

	
	?>
	<!-- BEGIN BASE-->
		<div id="base">

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS LEFT -->

			<!-- BEGIN CONTENT-->
			<div id="content">
				<section>
					<div class="section-header">
						<ol class="breadcrumb">
						<li><a href="?modulo="><H4>Recursos humanos / Empleados - Usuarios / 
						Agregar nuevo</H4></a></li>
						<?php 
						if($accion=='agregar'){
							echo"<li class='active'>Añadir </li>";
						}
						if($accion=='editar'){
							echo"<li class='active'>Editar </li>";
							$readonly="readonly";
						}
						if($accion=='ver'){
							echo"<li class='active'>Ver </li>";
							$desactivar="disabled";
						}
						if($accion=='borrar'){
							echo"<li class='active'>Borrar </li>";	
                           $desactivar="disabled";							
						}
						?>
							
						</ol>
					</div>
					<div class="section-body contain-lg">
						<div class="row">
							<!-- BEGIN ADD CONTACTS FORM -->	
									<form method='POST'  enctype="multipart/form-data"  id='rhh' class='form' runat="server">
									<input type='hidden' value='<?php echo $based; ?>' name='bd'>
							<div class="col-md-12">
							<div class="card">
								<div class="card-head style-primary">
									<header style="padding: 18px 24px; color: white;" >
									<!---------Contenido inicio------->
									<!--<table style='color: white;' class='table'>-->
									<div class='card-body style-primary form-inverse'>
									<div class='row'>
									<div class='col-xs-12'>
									<div class='row' style="width: 1150">
									<div class="col-md-4">
											<div class="form-group floating-label">
												<input data-type='text' id="nombre" name="nombre" type="text" class="form-control hinp" value="<?php echo $nombre_empleado; ?>">
												<label for="nombre">Nombre</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group floating-label">
												<input data-type='text' id="apaterno" name="apaterno" type="text" class="form-control hinp" value="<?php echo $apellidop_empleado; ?>">
												<label for="nombre">Apellido paterno</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group floating-label">
												<input data-type='text' id="amaterno" name="amaterno" type="text" class="form-control hinp" value="<?php echo $apellidom_empleado; ?>">
												<label for="nombre">Apellido materno</label>
											</div>
										</div>
										<div class="col-md-2">
											<?php
											if(empty($foto_empleado) || $foto_empleado==""){
											?>
										<img style='float: right;' id='fotoperfil' src="https://assets.rebelcircus.com/blog/wp-content/uploads/2016/05/facebook-avatar.jpg" width="100" height="100">
											<?php
											}else{
											?>
										<img style='float: right; cursor: move;' class='fotoperfil' id='fotoperfil' src="<?php echo "modulos/".$foto_empleado;?>" width="100" height="100">
											<?php
											}
											?>
										</div>
										
									</div>
									<div class='row'>
									<div class="col-md-2">										 
											<div class="form-group floating-label">
												<select class="form-control hinpsel" id="puesto" name='puesto'>
													<option value="0">Seleccionar...</option>
														<?php 
															$pu = mysqli_query($conn,"SELECT *  FROM puestos");
															while($p = mysqli_fetch_array($pu)){
																if($puesto_empleado==$p['id']){
																	echo "<option value='".$p['id']."' selected>".$p['puesto']."</option>";
																}else{
																	echo "<option value='".$p['id']."'>".$p['puesto']."</option>";
																}
																
															 
															}
														?>
												</select>
												<label for="puesto">Puesto</label>
											</div>
										</div>
										<div class="col-md-3">
												<div class="form-group">
												   <input type="text" name="fechaalta" id="fechaalta" class="form-control hinp" value="<?php echo $fechaAlta_empleado;?>">
												   <label for="fechaalta">Fecha alta</label>
												</div>	
											</div>
										<div class="col-md-3">
												<div class="form-group">
												   <input type='text' name='correo' id='correo_djss' class='form-control' value='<?php echo $correo_empleado;?>'>
												   <label for="correo">Correo</label>
												</div>	
											</div>
										<div class="col-md-2">
											<div class="form-group floating-label">
												Foto: <input type='file' id="foto" name="foto" type="text" class="hinp" value="<?php// echo $datas['nombre']?>">
												
											</div>
										</div>
										
										
										<div class='col-md-2'>
											<!--
											<img src="https://assets.rebelcircus.com/blog/wp-content/uploads/2016/05/facebook-avatar.jpg" width="100" height="100">
										-->
										</div>
										
												</div>
												<?php
												if($_GET['accion']=="editar"){
												?>
									<div class='row'>
									<div class="col-md-2">											
											<!--<input type='button' value='Desactivar' id='btn_desactivar' class='btn btn-info' <?php //echo $estado_boton1;?>>
											<input type='button' value='Activar' id='btn_activar' class='btn btn-info' <?php //echo $estado_boton2;?>>-->
											<input type='hidden' value='<?php echo $activo_empleado;?>' id='text_activo' name='text_activo' class='btn btn-info'>
										</div>
										<?php 
										if($activo_empleado==1){
											$estado_cols_bc="style='display:none;'";
										}else{
											$estado_cols_bc="";
										}
										?>
							<!-- 			<div class="col-md-3">
											<div class="form-group" id='fb' <?php //echo $estado_cols_bc;?>>
											   <input type="text" name="fechabaja" id="fechabaja" class="form-control hinp" value="<?php// echo $fechaBaja_empleado;?>">
											   <label for="fechabaja">Fecha baja</label>
											</div>	
										</div> -->
										<!-- <div class="col-md-3">
											<div class="form-group" id='mb' <?php //echo $estado_cols_bc;?>>
											   <select class='form-control' name='mbaja' id='mbaja'>
												<option value="0">Seleccionar...</option>
												<?php
													// $motivo_de_bajaq = mysqli_query($conn,"SELECT * FROM motivos_sat");
													// while($e = mysqli_fetch_array($motivo_de_bajaq)){
													// 	if($mbaja==$e['Id']){
													// 		echo "<option value='".$e['Id']."' selected>".$e['Descripcion']."</option>";
													// 	}else{
													// 		echo "<option value='".$e['Id']."'>".$e['Descripcion']."</option>";
													// 	}
													
													//}
												?>
												</select>
											   <label for="fechabaja">Motivo baja</label>
											</div>	
										</div> -->
								<!-- 		<div class="col-md-3">
											<div class="form-group" id='coment' <?php// echo $estado_cols_bc;?>>
											  <textarea name='comentarios' id='comentarios' class='form-control' style="margin: 0px 0.371094px 0px 0px; width: 238px; height: 39px;"><?php //echo $comentarios_empleado;?></textarea>
											   <label for="comentarios">Comentarios</label>
											</div>	
										</div> -->
									</div>
									<?php
										}
									?>
											</div>
										</div>
									</div>
									<!---------Contenido FIN------->
									</header>
								</div>
								<!------------Pestañas contenido Inicio---------->
									<div class="card-head style-primary">
											<ul class="nav nav-tabs tabs-text-contrast tabs-accent" data-toggle="tabs">
												<li class="active"><a href="#empleados">Empleados</a></li>
												<li><a href="#usuarios">Usuarios</a></li>												
											</ul>
										</div>
										<div class='card-body tab-content'>
									<div id='empleados' class='tab-pane active'><!------------empleados contenido Inicio---------->
									<div class="card-head style-primary">
											<ul class="nav nav-tabs tabs-text-contrast tabs-accent" data-toggle="tabs">
												<li class="active"><a href="#empleados_general">Datos generales</a></li>
												<li><a href="#empleados_laboral">Datos laborales</a></li>												
												<li><a href="#empleados_documentos">Documentos</a></li>		

												<li><a href="#empleados_contratos">Contratos</a></li>										
											</ul>
										</div>
										<div class='card-body tab-content'>
										<div id='empleados_general' class='tab-pane active'>

									<table class='table'> 
									<tr>
									<th>CURP</th>
									<td><input type='text' name='curp' class='form-control' value='<?php echo $curp_empleado;?>'></td>
									<th>RFC</th>
									<td><input type='text' name='rfc' class='form-control' value='<?php echo $rfc_empleado;?>'></td>
									<th>Código postal</th>
									<td><input type='text' name='codpos' class='form-control' value='<?php echo $codigopostal_empleado;?>'></td>
									</tr>
									<tr>
									<th>Estado</th>
									<td><input type='text' name='estado' class='form-control' value='<?php echo $estado_empleado;?>'></td>
									<th>Municipio</th>
									<td><input type='text' name='municipio' class='form-control' value='<?php echo $municipio_empleado;?>'></td>
									<th>Colonia</th>
									<td><input type='text' name='colonia' class='form-control' value='<?php echo $colonia_empleado;?>'></td>
									</tr>
									<tr>
									<th>Calle</th>
									<td><input type='text' name='calle' class='form-control' value='<?php echo $calle_empleado;?>'></td>
									<th>Número exterior</th>
									<td><input type='text' name='next' class='form-control' value='<?php echo $nexterior_empleado;?>'></td>
									<th>Número interior</th>
									<td><input type='text' name='nint' class='form-control' value='<?php echo $ninterior_empleado;?>'></td>
									</tr>
									<tr>
									<th>Teléfono de casa</th>
									<td><input type='text' name='telc' class='form-control' value='<?php echo $tcasa_empleado;?>'></td>
									<th>Teléfono celular</th>
									<td><input type='text' name='telcel' class='form-control' value='<?php echo $tcelular_empleado;?>'></td>
									<th>Fecha de nacimiento</th>
									<td><input type='text' name='fnac' class='form-control' value='<?php echo $fechaNacimiento_empleado;?>'></td>
									</tr>
									<tr>
									<th>Tipo de sangre</th>
									<td>
										<select class="form-control" id="tiposangre" name="tsang">
												<option value="0">Seleccionar...</option>
												<option value='O-'>O-</option>
												<option value='O+'>O+</option>
												<option value='A+'>A+</option>
												<option value='A-'>A-</option>
												<option value='B+'>B+</option>
												<option value='B-'>B-</option>
												<option value='AB+'>AB+</option>
												<option value='AB-'>AB-</option>
										</select>
									</td>
									<th>Estado civil</th>
									<td>
									<select class='form-control' name='ecivil' id='ecivil'>
									<option value="0">Seleccionar...</option>
									<?php
																$estadoc = mysqli_query($conn,"SELECT * FROM estado_civil");
																while($e = mysqli_fetch_array($estadoc)){
																	if($ecivil==$e['Id']){
																		echo "<option value='".$e['Id']."' selected>".$e['Descripcion']."</option>";
																	}else{
																		echo "<option value='".$e['Id']."'>".$e['Descripcion']."</option>";
																	}
																
																}
									?>
									</select>
									</td>
									<th>Vivienda</th>
									<td>
									<select class='form-control' name='vivienda' id='vivienda'>
									<option value="0">Seleccionar...</option>
									<?php
																$viviendaq = mysqli_query($conn,"SELECT * FROM vivienda");
																while($e = mysqli_fetch_array($viviendaq)){
																	if($vivienda==$e['Id']){
																		echo "<option value='".$e['Id']."' selected>".$e['Descripcion']."</option>";
																	}else{
																		echo "<option value='".$e['Id']."'>".$e['Descripcion']."</option>";
																	}
																
																}
									?>
									</select>
									</td>
									</tr>
									<tr>
									<th>Hijos</th>
									<td>
									<select id='hijos' name='hijos' class='form-control'>
									<option value="0">Seleccionar...</option>
									<?php
																$opcionesh = mysqli_query($conn,"SELECT * FROM opcionesh");
																while($e = mysqli_fetch_array($opcionesh)){
																	if($hijos==$e['Id']){
																		echo "<option value='".$e['Id']."' selected>".$e['Descripcion']."</option>";
																	}else{
																		echo "<option value='".$e['Id']."'>".$e['Descripcion']."</option>";
																	}
																
																}
									?>
									</select>
									</td>
									<th>Número de hijos</th>
									<td>
									<input type='text' class='form-control' id='nhijos' name='nhijos' value='<?php echo $nhijos;?>'>
									</td>
									<th>Número de personal</th>
									<td>
									<input type='text' class='form-control' id='npersonal' name='npersonal' value='<?php echo $npersonal;?>'>
									</td>
									</tr>
									<tr>
									<th>Sexo</th>
									<td>
									<select id='sexo' name='sexo' class='form-control'>
									<option value="0">Seleccionar...</option>
									<?php
																$sexoq = mysqli_query($conn,"SELECT * FROM Genero");
																while($e = mysqli_fetch_array($sexoq)){
																	if($sexo==$e['Id']){
																		echo "<option value='".$e['Id']."' selected>".$e['Descripcion']."</option>";
																	}else{
																		echo "<option value='".$e['Id']."'>".$e['Descripcion']."</option>";
																	}
																
																}
									?>
									</select>
									</td>
									<th>Edad</th>
									<td><input type='text' value="<?php echo $edad;?>" class='form-control' title="Cálculo(Fecha de nacimiento a la fecha)" readonly></td>
									<th>Llamar en caso de emergencia</th>
									<td><input type='text' value="<?php echo $llam_emergencia;?>" name='llam_emergencia' id='llam_emergencia' class='form-control' title="En caso de emergencia llamar a" ></td> 
									</tr>
									</table>
									</div>
									<div id='empleados_laboral' class='tab-pane'>
									<table class='table' >
									<!--
									<tr>
									<th colspan='1' class='pestaña_inactiva  empleados_m1'>Datos generales</th>
									<th colspan='1' class='pestaña_activa empleados_m2'>Datos laborales</th>
									<th colspan='1' class='pestaña_inactiva empleados_m3'>Documentos</th>
									<th colspan='3' class='pestaña_inactiva'></th>
									</tr>
									-->
									<tr>
									<th>Escolaridad máxima</th>
									<td>
									<select id="escmax" name="escmax" class="form-control">
																<option value="0">Seleccionar...</option>
																<?php
																$esc = mysqli_query($conn,"SELECT * FROM escolaridad");
																while($e = mysqli_fetch_array($esc)){
																	if($escolaridad_empleado==$e['id']){
																		echo "<option value='".$e['id']."' selected>".$e['escolaridad']."</option>";
																	}else{
																		echo "<option value='".$e['id']."'>".$e['escolaridad']."</option>";
																	}
																
																}
																?>
															</select>
									</td>
									<th>Salario diario</th>
									<td><input type='text' name='sald' id='sald' class='form-control' value='<?php echo $salariodiario_empleado;?>'></td>
									<th>Comisión</th>
									<td><input type='text' name='com' id='com' class='form-control' value='<?php echo $comision_empleado;?>'></td>
									</tr>
									<tr>
									<th>Periodo de trabajo</th>
									<td>
									<select id="pet" name="pet" class="form-control">		
											<option value="0">Seleccionar...</option>		     
											<?php
												$pet = mysqli_query($conn,"SELECT * FROM periodo_t");
												while($t = mysqli_fetch_array($pet)){
													if($periodoTrabajo_empleado==$t['id']){
														echo "<option value='".$t['id']."' selected>".$t['periodo']."</option>";
													}else{
														echo "<option value='".$t['id']."'>".$t['periodo']."</option>";
													}
												
												}
											?>
									</select>
									</td>
									<th>Tipo</th>
									<td>
										<select id='eventual' name='tipo' class='form-control'>
										<option value="0">Seleccionar...</option>
										<option value="PLANTA">Planta</option>
										<option value="EVENTUAL">Eventual</option>
										</select>
									</td>
									<th>Día de descanso</th>
									<td>
									<select multiple id="diad" name='diad' class="form-control">
										<?php 
											$getdes = mysqli_query($conn,"SELECT * FROM dias_descanso");
											while($set = mysqli_fetch_array($getdes)){
												echo "<option value='".$set['id_dia']."'>".$set['dia']."</option>";
											}
										?>
									</select>
									</td>
									</tr>
									<tr>
									<th>Área</th>
									<td>
									<select id="area_djss" name='area' class="form-control">
										<option value="0">Seleccionar...</option>
										<?php 
											$area = mysqli_query($conn,"SELECT area, id FROM areas GROUP BY area");
											while($a = mysqli_fetch_array($area)){
												if($area_empleado==$a['id']){
													echo "<option value='".$a['id']."' selected>".$a['area']."</option>";
												}else{
													echo "<option value='".$a['id']."'>".$a['area']."</option>";
												}
												
											}
										?>
									</select>
									</td>
									<th>Departamento</th>
									<td>
									<select class="form-control" id="dep" name='dep'>
										<option value="0">Seleccionar...</option>
										<?php 
											$departamento = mysqli_query($conn,"SELECT * FROM areas");
											while ($d = mysqli_fetch_array($departamento)) {
												if($departamento_empleado==$d['id']){
													echo "<option value='".$d['id']."' selected>".$d['departamento']."</option>";
												}else{
													echo "<option value='".$d['id']."'>".$d['departamento']."</option>";
												}
												
											}
										?>
									</select>
									</td>
									<th>Zona</th>
									<td>
									<select class="form-control" id="zona" name="zona">
										<option value="0">Seleccionar...</option>
										<?php 
											$zona = mysqli_query($conn,"SELECT * from cat_zonas WHERE activo = 'SI'");
											while($z = mysqli_fetch_array($zona)){
												if($zona_empleado==$z['id']){
													echo "<option value='".$z['id']."' selected>".$z['zona']."</option>";
												}else{
													echo "<option value='".$z['id']."'>".$z['zona']."</option>";
												}
												
											}
										?>
										</option>
									</select>
									</td>
									</tr>
									<tr>
									<th>Tipo de pago</th>
									<td>
									<select class="form-control" id="tp" name='tp'>
										<option value="0">Seleccionar...</option>
										<?php 
											$dep = mysqli_query($conn,"SELECT * FROM tipodeposito");
											while($d = mysqli_fetch_array($dep)){
												if($tipoPago_empleado==$d['id']){
													echo "<option value='".$d['id']."' selected>".$d['descripcion']."</option>";
												}else{
													echo "<option value='".$d['id']."'>".$d['descripcion']."</option>";
												}
												
											}
										?>
										</option>
									</select>
									</td>
									<th>Día de pago</th>
									<td>
									<select class="form-control" id="dp" name='dp'>
										<option value="0">Seleccionar...</option>
										<?php 
											$dep = mysqli_query($conn,"SELECT * FROM dias_de_credito WHERE id_dias > 1 AND id_dias < 33");
											while($d = mysqli_fetch_array($dep)){
												if($diaDePago_empleado==$d['numero_dias']){
													echo "<option value='".$d['numero_dias']."' selected>".$d['numero_dias']."</option>";
												}else{
													echo "<option value='".$d['numero_dias']."'>".$d['numero_dias']."</option>";
												}
												
											}
										?>
										</option>
									</select>
									</td>
									<th>Tipo de empleado</th>
									<td>
									<select class="form-control" name="te" id="te">
										<option value="0">Seleccionar...</option>
										<?php 
											$tipoem = mysqli_query($conn,"SELECT * FROM tipoempleado");
											while($tip = mysqli_fetch_array($tipoem)){
												if($tipoemp_empleado==$tip['id']){
													echo "<option value='".$tip['id']."' selected>".$tip['tipo']."</option>";
												}else{
													echo "<option value='".$tip['id']."'>".$tip['tipo']."</option>";
												}
												
											} 
										?>
									</select>
									</td>
									</tr>
									<tr>
									<th>Fecha de ingreso</th>
									<td><input type='text' name='fing' class='form-control' value='<?php echo $fechaIngreso_empleado;?>'></td>
									<th>Fecha de salida</th>
									<td><input type='text' name='fsal' class='form-control' value='<?php echo $fechaSalida_empleado;?>'></td>
									<th>Vencimiento de licencia</th>
									<td><input type='text' name='vl' class='form-control' value='<?php echo $fechaLicencia_empleado;?>'></td>
									</tr>
									<tr>
									<th>Hora de entrada</th>
									<td><input type='text' name='hen' id='hen' class='form-control' value='<?php echo $hora1;?>'></td>
									<th>Hora de salida</th>
									<td><input type='text' name='hsa' id='hsa' class='form-control' value='<?php echo $hora2;?>'></td>
									<th>Antigüedad</th>
									<td><input type="text" class='form-control' value="<?php echo $tiempoIngreso;?>" title='Cálculo(Fecha ingreso a fecha actual)' readonly></td>
									</tr>
									<tr>
									<th>Recontratación</th>
									<td>
									<select id='recon' name='recon' class='form-control'>
									<option value='0'>Seleccionar</option>
									<option value='1' <?php if($recontratable==1){echo"selected";}?>>Si</option>
									<option value='2' <?php if($recontratable==2){echo"selected";}?>>No</option>
									</select>
									</td>
									<th>Elegible para contratación</th>
									<td>
									<select id='eleg' name='eleg' class='form-control'>
									<option value='0'>Seleccionar</option>
									<option value='1'<?php if($elegible==1){echo"selected";}?>>Si</option>
									<option value='2'<?php if($elegible==2){echo"selected";}?>>No</option>
									</select>
									</td>
									<th>Sucursal</th>
									<td>
									<select id='suc' name='suc' class='form-control'>
									<option value='0'>Seleccionar</option>
									<?php 
											$buscarSucursal = mysqli_query($conn,"SELECT * FROM sucursales");
											while($bs = mysqli_fetch_array($buscarSucursal)){
												if($sucursal==$bs['Id_Sucursal']){
													echo "<option value='".$bs['Id_Sucursal']."' selected>".$bs['Nombre_Sucursal']."</option>";
												}else{
													echo "<option value='".$bs['Id_Sucursal']."'>".$bs['Nombre_Sucursal']."</option>";
												}
												
											} 
										?>
									</select>
									</td>
									</tr>
									<tr>
									<th>No IMSS</th>
									<td><input type="text" class='form-control' name='noimss' id='noimss' value="<?php echo $noimss;?>" title='Numero del seguro social'></td>
									<th>Nacionalidad</th>
									<td>
									<select id='nacionalidad' name='nacionalidad' class='form-control'>
									<option value='0'>Seleccionar</option>
									<?php 
											$buscarSucursal = mysqli_query($conn,"SELECT * FROM c_pais");
											while($bs = mysqli_fetch_array($buscarSucursal)){
												if($nacionalidad==$bs['Id']){
													echo "<option value='".$bs['Id']."' selected>".$bs['c_descripcion']."</option>";
												}else{
													echo "<option value='".$bs['Id']."'>".$bs['c_descripcion']."</option>";
												}
												
											} 
										?>
									</select>
									</td>

									<th>Fecha final de contrato </th>
									<td><input type="text" class='form-control' name='Fecha_Final' id='Fecha_Final' value="<?php echo $Fecha_Final;?>" title='Fecha final'></td>
								</td>


									</tr>
									<tr>
									<th>Fecha Inicial </th>
									<td><input type="text" class='form-control' name='FechaInicial' id='FechaInicial' value="<?php echo $FechaInicial;?>" title='Fecha inicial'></td>
								</td>
								<th>Dias de duración del contrato</th>
								<td>
									<input type="text" class='form-control' name='Dias_duracion' id='Dias_duracion' value="<?php echo $Dias_duracion;?>" title='Dias_duracion'></td>
								<th>Contrato indefinido</th>
								<td>
									<input type="checkbox" class="custom-control-input" id="checkboxInd">
									<td>
									</td>

								</tr>



									</table>
									</div>
									<div id='empleados_documentos' class='tab-pane'>
									<table class='table'  >
									<!--
									<tr>
									<th colspan='1' class='pestaña_inactiva empleados_m1'>Datos generales</th>
									<th colspan='1' class='pestaña_inactiva empleados_m2'>Datos laborales</th>
									<th colspan='1' class='pestaña_activa empleados_m3'>Documentos</th>
									<th colspan='3' class='pestaña_inactiva'></th>
									</tr>
									-->
									<tr>
									<th>IMSS <?php echo $imssFile;?></th>
									<td><input type='file' name='imss' class='form-control'></td>
									<th>IFE <?php echo $ife;?></th>
									<td><input type='file' name='ife' class='form-control'></td>
									<th>Licencia <?php echo $licencia;?></th>
									<td><input type='file' name='lic' class='form-control'></td>
									</tr>
									<tr>
									<th>Certificado de nacimiento <?php echo $certificado;?></th>
									<td><input type='file' name='cn' class='form-control'></td>
									<th>CURP <?php echo $curp_file;?></th>
									<td><input type='file' name='curp_file' class='form-control'></td>
									<th>Comprobante de domicilio <?php echo $cdomicilio;?></th>
									<td><input type='file' name='cdomicilio' class='form-control'></td>
									</tr>
									<tr>
									<th>Carta de referencia <?php echo $creferencia;?></th>
									<td><input type='file' name='creferencia' class='form-control'></td>
									<th>Carta de retención <?php echo $cretencion;?></th>
									<td><input type='file' name='cretencion' class='form-control'></td>
									<th>RFC <?php echo $rfc_file;?></th>
									<td><input type='file' name='rfc_file' class='form-control'></td>
									</tr>
									<tr>
									<th>Comprobante de estudios <?php echo $cestudios;?></th>
									<td><input type='file' name='cestudios' class='form-control'></td>
									<th>Fotografia <?php echo $Fotografia2;?></th>
									<td><input type='file' name='Fotografia2' class='form-control'></td>
									<th>Contrato <?php echo $Contrato;?></th>
									<td><input type='file' name='Contrato' class='form-control'></td>
									</tr>
									<tr>
									<th>Renuncia <?php echo $Renuncia;?></th>
									<td><input type='file' name='Renuncia' class='form-control'></td>
									<th>Otros <?php echo $Otros;?></th>
									<td><input type='file' name='Otros' class='form-control'></td>									
									</tr>
									</table>
									</div>


											<div id='empleados_contratos' class='tab-pane'>
									<table class='table'>
									<!--
									<tr>
									<th colspan='1' class='pestaña_inactiva empleados_m1'>Datos generales</th>
									<th colspan='1' class='pestaña_inactiva empleados_m2'>Datos laborales</th>
									<th colspan='1' class='pestaña_activa empleados_m3'>Documentos</th>
									<th colspan='3' class='pestaña_inactiva'></th>
									</tr>
									-->
									<button type="button" class="btn btn-info" id='gen_contrato'>GENERAR CONTRATO</button>
									<button type="button" class="btn btn-info" id='gen_gafete' style="margin-left:10px;">GAFETE</button>		
									<button type="button" class="btn btn-info" id='mostrar_fileupload_contrato' style="margin-left: 10px">Subir contrato firmado</button>		


									<form>
										  <div class="form-group" id="ArchivoContrato" style="display:none">
										    <label for="exampleFormControlFile1">Sube tu archivo</label>
										    <input type="file" name="FileContrato" id="FileContrato" class="form-control-file"  >
										  </div>
										</form>
										 <input type="text" class="form-control" id="datepicker" name="FechaContrato" value="Click aqui para seleccionar la fecha" style="display: none"></p>
										 
									</table>




										<?php
										

										$bd = $_SESSION['DB'];

										 $condb = mysqli_connect("localhost", "sp417", "mgrasAS7102", $bd);
										 mysqli_set_charset($condb,"utf8");
									     $ejecucion="SELECT * FROM detalle_contratos where id_relacion = '".$_GET['id_pe']."'";
                                    $datos = [];
                                    $ar=mysqli_query($condb,$ejecucion);
                                    while($flow=mysqli_fetch_array($ar)){
                                        $datos[] = $flow;
                                    }

                                ?>

                                <table class="table">
                                <thead>
                                <tr>
                              
                                <tr>
                                </thead>
                                <tbody>
                                <?php
                                for($i=0; $i < count($datos); $i++){
                                echo "<tr><td>{$datos[$i]["nombre"]}</td>";
                                echo "<td>{$datos[$i]["fecha_subida"]}</td>
                                </th>";
                                echo "<td>{$datos[$i]["fecha_firma"]}</td>
                                </tr>";
                                }
                                ?>
                                </tbody>
                                </table>

									</div>
								



									</div>
									</div><!------------empleados contenido Fin---------->
									<div id='usuarios' class='tab-pane'><!------------usuarios contenido Inicio---------->
									<div class="card-head style-primary">
											<ul class="nav nav-tabs tabs-text-contrast tabs-accent" data-toggle="tabs">
												<li class="active"><a href="#usuarios_general">Datos generales</a></li>
												<li ><a href="#usuarios_paquetes">Paquetes</a></li>
												<li><a href="#usuarios_permisos">Permisos</a></li>
												<?php if( $_GET['id'] ){
																	if($r_bep==0){//No existe empleado con este usuario
				
																				}else{	
												?>
													<li><a href="#usuarios_permisosm">Permisos especiales</a></li>
													<?php
																				}
													?>
													<li><a href="#usuarios_cuentas">Cuentas</a></li>
													<li><a href="#usuarios_almacen">Almacen</a></li>
													<li><a href="#usuarios_cent_cost">Centros de costo</a></li>
												<?php }  ?>
											</ul>
										</div>
									<div class='card-body tab-content'>
										<div id='usuarios_general' class='tab-pane active'>
											<table class='table' id='usuarios_general'>
												<!--
												<tr>
													<th colspan='1' class='pestaña_activa usuarios_m1'>Datos generales</th>
													<th colspan='1' class='pestaña_inactiva usuarios_m2'>Permisos</th>
													<th colspan='1' class='pestaña_inactiva usuarios_m3'>Almacenes</th>
													<th colspan='4' class='pestaña_inactiva'></th>
												</tr>
												-->
												<tr>																		
												<th>Usuario</th>
												<?php
												$user_explode=explode("@",$usr_usuario);
												?>
												<td><input type='text' name='user' id='user' class='form-control' value='<?php echo $user_explode[0]; ?>' autocomplete=off><input type='text' style='display:none;' id='nothing' name='use'></td>
												
												<th>Contraseña</th>
												<td><input type='password' name='pass' id='pass' class='form-control' value='<?php echo $pass_usuario; ?>'autocomplete=off readonly onfocus="this.removeAttribute('readonly');"></td>
												<td>
												<?php
												if($_GET['accion']!="agregar" && $_GET['accion']!="editar"){}else{
													?>
													<i class='fa fa-eye' id='btn_ver'></i>
													<?php 
													} 
													?></td>
												</tr>
												<tr>
													<th>Paquete</th>
													<td>
														<select class='form-control' name='paquete_select' id='paquete_select'>
															<option value='0'>Seleccionar</option>
															<?php
															$buscar_paquetes_comprados_option="select Id,Num,Usuarios_comprados from paquetes_comprados";
															$res_bpco=mysqli_query($conn,$buscar_paquetes_comprados_option);
															while($r_bpco=mysqli_fetch_array($res_bpco)){
																$id_paq_op=$r_bpco['Id'];
																$fol_paq_op=$r_bpco['Num'];
																$usercom_paq_op=(int)$r_bpco['Usuarios_comprados'];
																
																$buscar_paquetes_en_usuarios="select count(usuario) as total from usuarios where Id_paquete='$id_paq_op'";
																$res_bpu=mysqli_query($conn,$buscar_paquetes_en_usuarios);
																$r_bpu=mysqli_fetch_array($res_bpu);
																$asignados_paq=(int)$r_bpu['total'];
																$disponibles_paq=$usercom_paq_op-$asignados_paq;
																if($paquete_usuario==$id_paq_op){
																		echo"
																		<option value='$id_paq_op' selected>$fol_paq_op</option>
																		";
																	}else{
																		if($disponibles_paq > 0){
																			echo"
																					<option value='$id_paq_op'>$fol_paq_op</option>
																				";
																		}
																		
																	}
																
																
															}
															?>
														</select>
													</td>
													<th>Usuarios disponibles</th>
													<td><input type='text' value='' class='form-control' id='cu_select' readonly></td>

												</tr>
												
												<tr>
												<th colspan='4'>
												*Es necesario crear usuario, para dar privilegios a permisos, permisos móviles,
												cuentas, almacén, centros de costos.
												</th>
												</tr>
											</table>
											<!--<input type="button" value="Dar de baja" name="dar_baja" id="dar_baja" class="btn btn-warning" >-->
											<table  width="1000px">
												<tr>
													<th>
													</th>
													<th style="text-align: center;"><label for="fechabaja" >Fecha baja</label></th>
													<th style="text-align: center;"> <label for="fechabaja">Motivo baja</label></th>
													<th style="text-align: center;"><label for="comentarios">Comentarios</label></th>

												</tr>
												<tr>

													<td style="padding-left: 13px; text-align: left;">


														<input type='button' value='Dar de baja' id='dar_bajadesac' class='btn btn-warning' <?php echo $estado_boton1;?>>

											<input type='button' value='Dar de baja' id='dar_baja' class='btn btn-warning' <?php echo $estado_boton2;?>>
													</td>
														
													<td style="padding-left: 13px;  text-align: left;">
														<div class="form-group" id='fb' <?php echo $estado_cols_bc;?>>
											   <input type="text" name="fechabaja" id="fechabaja" class="form-control hinp" value="<?php echo $fechaBaja_empleado;?>">
											   
											</div>	
													</td>
													 
													<td style="padding-left: 13px;  text-align: left;">
														<div class="form-group" id='mb' <?php echo $estado_cols_bc;?>>
											   <select class='form-control' name='mbaja' id='mbaja'>
												<option value="0">Seleccionar...</option>
												<?php
													$motivo_de_bajaq = mysqli_query($conn,"SELECT * FROM motivos_sat");
													while($e = mysqli_fetch_array($motivo_de_bajaq)){
														if($mbaja==$e['Id']){
															echo "<option value='".$e['Id']."' selected>".$e['Descripcion']."</option>";
														}else{
															echo "<option value='".$e['Id']."'>".$e['Descripcion']."</option>";
														}
													
													}
												?>
												</select>
											  
												
													</td>
													</div>
													<td style="padding-left: 65px;  text-align: left;">
														
														<div class="form-group" id='coment' <?php echo $estado_cols_bc;?>>
											  <textarea name='comentarios' id='comentarios' class='form-control' style="margin: 0px 0.371094px 0px 0px; width: 238px; height: 39px;"><?php echo $comentarios_empleado;?></textarea>
											  </div>

													</td>
												</tr>
											
										</table>
											</div>
											<div id='usuarios_paquetes' class='tab-pane'>
												<input type='button' id='btn_agregar_paquete' class='btn btn-warning' style='float:right;margin-right: 20px;' value='Agregar nuevo'><br><br>
												<div id='agregar_paquetes' style='display: none; box-shadow: inset 0px 0px 10px #000000; border-radius:10px; text-align: center; border: 2px solid #2b323a; margin-left:50px; width: 1000px; height: 400px;'>
													<div style='background-image: url("modulos/archivosRH/standar4_p.jpg"); box-shadow: inset 0px 0px 10px #000000; border-radius:10px; text-align: center; border: 2px solid #2b323a; margin-top: 10px; margin-left:150px; width: 200px;  height: 250px; float: left;'>
														<!--<img src="modulos/archivosRH/standar_p.png" style=" margin-top: 10px; width: 100px; height: 100px; border-radius: 50px">
														<h5>Mes/usuario </h5>-->
														<input type='radio' style='margin-top: 160px;' name='modalidad_paquetes' value='1'>
														<!--<br><h4>STANDAR</h4>-->
													</div>
														<div style='background-image: url("modulos/archivosRH/premium4_p.jpg"); box-shadow: inset 0px 0px 10px #000000; border-radius:10px; text-align: center; border: 2px solid #2b323a; margin-top: 10px; margin-left:50px; width: 200px;  height: 250px; float: left;'>
															<!--<img src="modulos/archivosRH/premium_p.png" style=" margin-top: 10px; width: 100px; height: 100px; border-radius: 50px">
															<h5>Mes / usuario / pagando 12 meses </h5>
															<br><h4>PREMIUM</h4>-->
															<input type='radio' style='margin-top: 160px;' name='modalidad_paquetes' value='2'>
															
														</div>
															<div style='background-image: url("modulos/archivosRH/gold4_p.jpg");box-shadow: inset 0px 0px 10px #000000;  border-radius:10px; text-align: center; border: 2px solid #2b323a; margin-top: 10px; margin-left:50px; width: 200px;  height: 250px; float: left;'>
																<!--<img src="modulos/archivosRH/gold_p.png" style=" margin-top: 10px; width: 100px; height: 100px; border-radius: 50px">
																<h5>+50 USD por año</h5>
																<br><h4>GOLD</h4>-->
																<input type='radio' style='margin-top: 160px;' name='modalidad_paquetes' value='3'>
															</div> 
														<div style='box-shadow: inset 0px 0px 10px #000000; border-radius:10px; text-align: left; border: 2px solid #2b323a; margin-top: 10px; margin-left:150px; width: 700px;  height: 50px; float: left;'>
															<div style='margin-left: 15px;'>
																<table>	
																<tr>
																	<td>	
																		<h4>Cantidad de usuarios: </h4>
																	</td>
																	<td>
																		<input type='number'  style='text-align: center; width: 50px;' class='form-control' name='cantidad_usuarios' value='0'>
																	</td>
																</tr>
																</table>
															</div>
														</div>	
														<div style='border-radius:10px; text-align: left;  margin-top: 30px; margin-left:150px; width: 800px;  height: 50px; float: left;'>
															<input type='button' style='float: right;' class='btn btn-info' id='btn_cancelar_paquete' value="Cancelar">
															<input type='button' style='float: right; margin-right: 10px;' class='btn btn-success' id='btn_guardar_paquete' value="Guardar paquete">

														</div>
												</div>
												<table class='table' id='tabla_paquetes'>
													<tr>
														<th style='text-align: center;'>Folio</th>
														<th style='text-align: center;'>Fecha inicial</th>
														<th style='text-align: center;'>Siguiente pago</th>
														<th style='text-align: center;'>Usuarios</th>
														<th style='text-align: center;'>Disponibles</th>
													</tr>
													<tbody id ='id_detalle_paquetes'>
												<?php
													$buscar_paquetes_comprados="select*from vista_paquetes_comprados";
													$res_bpc=mysqli_query($conn,$buscar_paquetes_comprados);
													while($r_bpc=mysqli_fetch_array($res_bpc)){
														$folio_paq=$r_bpc['Num'];
														$fechaInicial_paq=$r_bpc['Fecha_inicial'];
														$fechasp_paq=$r_bpc['Fecha_siguiente_pago'];
														$usuariosComprados_paq=$r_bpc['Usuarios_comprados'];
														$usuariosAsignados_paq=$r_bpc['Disponibles'];

															echo"
															<tr>
																<td style='text-align: center;'>$folio_paq</td>
																<td style='text-align: center;'>$fechaInicial_paq</td>
																<td style='text-align: center;'>$fechasp_paq</td>
																<td style='text-align: center;'>$usuariosComprados_paq</td>
																<td style='text-align: center;'>$usuariosAsignados_paq</td>
															</tr>
															";
													}
												?>
												</tbody>
												</table>		
											</div>
											<div id='usuarios_permisos' class='tab-pane'>
											<table class='table' >
												<!--
												<tr>
													<th colspan='1' class='pestaña_inactiva usuarios_m1'>Datos generales</th>
													<th colspan='1' class='pestaña_activa usuarios_m2'>Permisos</th>
													<th colspan='1' class='pestaña_inactiva usuarios_m3'>Almacenes</th>
													<th colspan='4' class='pestaña_inactiva'></th>
												</tr>
												-->
												<tr>
													<td>Perfil</td>
													<td>
														<select id='select_perfil' name='select_perfil' class='form-control'>
															<option value='0'>Seleccionar</option>
															<?php
															$buscar_perfiles="select*from auwimx_grupos";
															$res_bp=mysqli_query($conn,$buscar_perfiles);
															while($r_bp=mysqli_fetch_array($res_bp)){
																$id_perfil=$r_bp['Id'];
																$nom_perfil=$r_bp['Nombre'];
																if($id_perfil==$pefil_actual){
																	echo"
																		<option value='$id_perfil' selected>$nom_perfil</option>
																";
																}else{
																	echo"
																		<option value='$id_perfil'>$nom_perfil</option>
																";
																}
															}
															?>
														</select>
													</td>
													<th>
														<input type='button' class='btn btn-info' id='btn_vercp' value='Copiar perfil'>
														<input type='button' class='btn btn-danger' id='btn_cancelarcp' style='display:none;' value='Cancelar'>
													</th>
													<td><input type='text' class='form-control' Placeholder="Nuevo nombre de perfil" id='text_cp'style='display:none;'></td>
													<td><input type='button' class='btn btn-success' id='btn_aceptarcp' value='Aceptar' style='display:none;'></td>
													<td></td>
												</tr>
												<tr>
													<th colspan='2'  style='text-align: center;'><span style='font-size: 16px; margin-right: 100px;'>Sin acceso</span></th>
													<th colspan='1' style='text-align: center;'><span style='font-size: 16px; margin-right: 100px;'>Con acceso</span></th>
													<th colspan='4' style='font-size: 16px; text-align: center;'></th>
													
												</tr>
												<tr>
												<td colspan='6'>
													<ul id="sortable2" class="connectedSortable">
														<?php 
															$host='localhost';
															$username='sp417';
															$password='mgrasAS7102';
															$database='sp417_auwi_control';

															$conn_control=mysqli_connect($host,$username,$password,$database);
															
															$busqueda_modulos="select*from modulos2 where Id not $condicion_in";
															$res_bm=mysqli_query($conn_control,$busqueda_modulos);
															while($r_bm=mysqli_fetch_array($res_bm)){
																
																$modulo_id=$r_bm['Id'];
																$modulo_nom=utf8_encode($r_bm['Modulo']);
																echo"
																 <li class='ui-state-highlight items' id='item_$modulo_id'>$modulo_nom</li>
																";
															}
														?>
														<!-- <li class="ui-state-highlight">Item 1</li>
														<li class="ui-state-highlight">Item 2</li>
														<li class="ui-state-highlight">Item 3</li>
														<li class="ui-state-highlight">Item 4</li>
														<li class="ui-state-highlight">Item 5</li>-->
													</ul>
													<ul id="sortable1" class="connectedSortable">
														<?php
															$busqueda_modulos2="select*from modulos2 where Id  $condicion_in";
															$res_bm2=mysqli_query($conn_control,$busqueda_modulos2);
															while($r_bm2=mysqli_fetch_array($res_bm2)){
																
																$modulo_id2=$r_bm2['Id'];
																$modulo_nom2=utf8_encode($r_bm2['Modulo']);
																echo"
																 <li class='ui-state-active items' id='item_$modulo_id2'>$modulo_nom2 <div class='fa fa-question btn_detalle' id='sim_item_$modulo_id2'></div></li>
																";
															} 
														?><!--
														<li class="ui-state-default" id='item_23'>Item 1 <div class='fa fa-question btn_detalle' id='sim_item_23'></div></li> 
														<li class="ui-state-default" id='item_24'>Item 2 <div class='fa fa-question btn_detalle' id='sim_item_24'></div></li> 
														<li class="ui-state-default" id='item_25'>Item 3 <div class='fa fa-question btn_detalle' id='sim_item_25'></div></li>
														<li class="ui-state-default" id='item_26'>Item 4 <div class='fa fa-question btn_detalle' id='sim_item_26'></div></li>
														<li class="ui-state-default" id='item_27'>Item 5 <div class='fa fa-question btn_detalle' id='sim_item_27'></div></li>
														-->
													</ul>
												</td>
												<!--<td colspan='4'></td>-->
											
												</tr>
											</table>
											</div>
											<div id='usuarios_permisosm' class='tab-pane'>
											<table class='table'>
												<tr>
													<th style='font-size: 16px; text-align: center;'><span style='font-size: 16px; margin-right: 100px;'>Sin acceso</span></th>
													<th style='font-size: 16px; text-align: center;'><span style='font-size: 16px; margin-right: 100px;'>Con acceso</span></th>
													<td colspan='4'></td>
												</tr>
												<tr>
												<td colspan='2'>
													<ul id="sortable5" class="connectedSortable">
														<?php 
															
															
															foreach($arreglo_movil_noasignado as $data){
																list($nombre_etiqueta,$id_etiqueta)=explode(",",$data);
																
																echo"
																 <li class='ui-state-highlight items' id='item_$id_etiqueta'>$nombre_etiqueta</li>
																";
															}
														?>
														<!-- <li class="ui-state-highlight">Item 1</li>
														<li class="ui-state-highlight">Item 2</li>
														<li class="ui-state-highlight">Item 3</li>
														<li class="ui-state-highlight">Item 4</li>
														<li class="ui-state-highlight">Item 5</li>-->
													</ul>
													<ul id="sortable6" class="connectedSortable">
														<?php
															foreach($arreglo_movil_asignado as $data){
																list($nombre_etiqueta,$id_etiqueta)=explode(",",$data);
																
															
																echo"
																 <li class='ui-state-active items' id='item_$id_etiqueta'>$nombre_etiqueta</li>
																";
															} 
														?><!--
														<li class="ui-state-default" id='item_23'>Item 1 <div class='fa fa-question btn_detalle' id='sim_item_23'></div></li> 
														<li class="ui-state-default" id='item_24'>Item 2 <div class='fa fa-question btn_detalle' id='sim_item_24'></div></li> 
														<li class="ui-state-default" id='item_25'>Item 3 <div class='fa fa-question btn_detalle' id='sim_item_25'></div></li>
														<li class="ui-state-default" id='item_26'>Item 4 <div class='fa fa-question btn_detalle' id='sim_item_26'></div></li>
														<li class="ui-state-default" id='item_27'>Item 5 <div class='fa fa-question btn_detalle' id='sim_item_27'></div></li>
														-->
													</ul>
												</td>
												<td colspan='4'></td>
											
												</tr>
												</table>
											</div>
											<div id='usuarios_cuentas' class='tab-pane'>
												<div style='float: right; margin-right: 20px;'>
												<input type='button' class='btn btn-warning' id='btn_agregar_cuentas' value='Agregar cuenta'>
												</div><br><br>
												<table class='table'>
												<tr>
													<th style='font-size: 16px; text-align: center;'><span style='font-size: 16px; margin-right: 100px;'>Sin acceso</span></th>
													<th style='font-size: 16px; text-align: center;'><span style='font-size: 16px; margin-right: 100px;'>Con acceso</span></th>
													<td colspan='4'></td>
												</tr>
												<tr>
												<td colspan='2'>
													<ul id="sortable3" class="connectedSortable">
														<?php 
															
															
															$usr_id=$_GET['id'];
															$busqueda_cuentas="select*from flujoefectivo WHERE encargado!='$usr_id' and encargado not like '$usr_id,%'  and encargado not like '%,$usr_id'  and encargado not like '%,$usr_id,%';";
															$res_bc=mysqli_query($conn,$busqueda_cuentas);
															while($r_bc=mysqli_fetch_array($res_bc)){
																
																$cuenta_id=$r_bc['id'];
																$cuenta_nom=$r_bc['nombre'];
																echo"
																 <li class='ui-state-highlight items' id='item_$cuenta_id'>$cuenta_nom</li>
																";
															}
														?>
														<!-- <li class="ui-state-highlight">Item 1</li>
														<li class="ui-state-highlight">Item 2</li>
														<li class="ui-state-highlight">Item 3</li>
														<li class="ui-state-highlight">Item 4</li>
														<li class="ui-state-highlight">Item 5</li>-->
													</ul>
													<ul id="sortable4" class="connectedSortable">
														<?php
															$usr_id=$_GET['id'];
															$busqueda_cuentas2="select*from flujoefectivo WHERE encargado='$usr_id' or encargado like '$usr_id,%'  or encargado like '%,$usr_id'  or encargado like '%,$usr_id,%';";
															$res_bc2=mysqli_query($conn,$busqueda_cuentas2);
															while($r_bc2=mysqli_fetch_array($res_bc2)){
																
																$cuenta_id2=$r_bc2['id'];
																$cuenta_nom2=$r_bc2['nombre'];
																echo"
																 <li class='ui-state-active items' id='item_$cuenta_id2'>$cuenta_nom2</li>
																";
															} 
														?><!--
														<li class="ui-state-default" id='item_23'>Item 1 <div class='fa fa-question btn_detalle' id='sim_item_23'></div></li> 
														<li class="ui-state-default" id='item_24'>Item 2 <div class='fa fa-question btn_detalle' id='sim_item_24'></div></li> 
														<li class="ui-state-default" id='item_25'>Item 3 <div class='fa fa-question btn_detalle' id='sim_item_25'></div></li>
														<li class="ui-state-default" id='item_26'>Item 4 <div class='fa fa-question btn_detalle' id='sim_item_26'></div></li>
														<li class="ui-state-default" id='item_27'>Item 5 <div class='fa fa-question btn_detalle' id='sim_item_27'></div></li>
														-->
													</ul>
												</td>
												<td colspan='4'></td>
											
												</tr>
												</table>
											</div>
											<div id='usuarios_almacen' class='tab-pane'>
											<div style='float: right; margin-right: 20px;'>
												<input type='button' class='btn btn-warning' id='btn_agregar_almacen' value='Agregar almacen'>
												</div><br><br>
												<table class='table' >
													<tr>
														<th style='font-size: 16px; text-align: center;'><span style='font-size: 16px; margin-right: 100px;'>Sin acceso</span></th>
														<th style='font-size: 16px; text-align: center;'><span style='font-size: 16px; margin-right: 100px;'>Con acceso</span></th>
													</tr>
													<tr>
														<td colspan='2'>
															<ul id="almacen_ini" class="connect_almacen">
																<?php														
																	$busqueda_modulos = "SELECT A_Id, A_Nombre, COUNT(*) FROM almacen GROUP BY A_Id";
																	$res_bm=mysqli_query($conn,$busqueda_modulos);
																	while($r_bm=mysqli_fetch_array($res_bm)){
																		
																		$alm_id=$r_bm['A_Id'];

																		$sqls_alm_edit = "SELECT
																							almacen_movimientos.almacen,
																							almacen.A_Nombre
																						FROM
																							almacen_movimientos
																						INNER JOIN almacen ON almacen_movimientos.almacen = almacen.A_Id
																						WHERE usuario = '".$_GET['id']."' AND almacen = '$alm_id'";
																		$rss_alm_edit = mysqli_query($conn,$sqls_alm_edit);
																		$datas_alm_edit = mysqli_fetch_array($rss_alm_edit);
																		if( empty($datas_alm_edit) ){
																			$alm_nom=utf8_decode(utf8_encode($r_bm['A_Nombre']));
																			echo"<li class='ui-state-highlight items' id='alm_id_$alm_id'>$alm_nom</li>";
																		}
																	}
																?>
															</ul>
														
															<ul id="almacen_fin" class="connect_almacen">
																<?php														
																	$busqueda_modulos = "SELECT
																							almacen_movimientos.almacen,
																							almacen.A_Nombre
																						FROM
																							almacen_movimientos
																						INNER JOIN almacen ON almacen_movimientos.almacen = almacen.A_Id
																						WHERE usuario = '".$_GET['id']."'";
																	$res_bm=mysqli_query($conn,$busqueda_modulos);
																	while($r_bm=mysqli_fetch_array($res_bm)){
																		
																		$alm_id=$r_bm['almacen'];
																		$alm_nom=utf8_decode(utf8_encode($r_bm['A_Nombre']));
																		echo"<li class='ui-state-active items' id='alm_id_$alm_id'>$alm_nom</li>";
																	}
																?>
																
															</ul>
														</td>
													</tr>
												</table>
											</div>
											<div id='usuarios_cent_cost' class='tab-pane'>
											<div style='float: right; margin-right: 20px;'>
												<input type='button' class='btn btn-warning' id='btn_agregar_centroc' value='Agregar centro de costo'>
												</div><br><br>
												<table class='table' >
													<tr>
														<th style='font-size: 16px; text-align: center;'><span style='font-size: 16px; margin-right: 100px;'>Sin acceso</span></th>
														<th style='font-size: 16px; text-align: center;'><span style='font-size: 16px; margin-right: 100px;'>Con acceso</span></th>
													</tr>
													<tr>
														<td>
															<ul id="cent_cost_ini" class="connect_cent_cost">
																<?php														
																	$busqueda_modulos = "SELECT id, abreviacion, c_costo FROM catalogo_centrodecosto WHERE activo = 1";
																	$res_bm=mysqli_query($conn,$busqueda_modulos);
																	while($r_bm=mysqli_fetch_array($res_bm)){
																		$alm_id=$r_bm['id'];
																		$alm_nom=$r_bm['c_costo'];

																		$sqls_cc = "SELECT 
																							catalogo_centrodecosto.id, 
																							catalogo_centrodecosto.abreviacion
																						FROM
																							catalogo_centrodecosto
																						INNER JOIN autorizacion_niveles ON catalogo_centrodecosto.id = autorizacion_niveles.enlace_cc
																						INNER JOIN centrocosto_oc ON catalogo_centrodecosto.id = centrocosto_oc.c_costo
																						INNER JOIN visual_oc ON catalogo_centrodecosto.id = visual_oc.c_costo
																						WHERE 
																							( autorizacion_niveles.usuario = '".$_GET['id']."' OR 
																							centrocosto_oc.usuario = '".$_GET['id']."' OR 
																							visual_oc.usuarios = '".$_GET['id']."' ) AND 
																							catalogo_centrodecosto.id = '$alm_id'
																						GROUP BY catalogo_centrodecosto.id";
																		$rss_cc = mysqli_query($conn,$sqls_cc);
																		$datas_cc = mysqli_fetch_array($rss_cc);

																		if( $datas_cc ){

																		}else{
																			echo"<li class='ui-state-highlight items' id='cc_id_$alm_id'>$alm_nom</li>";
																		}
																	}
																?>
															</ul>
														</td>
														<td>
															<ul id="cent_cost_fin" class="connect_cent_cost">
																<?php														
																	$busqueda_modulos = "SELECT 
																							catalogo_centrodecosto.id, 
																							catalogo_centrodecosto.abreviacion
																						FROM
																							catalogo_centrodecosto
																						INNER JOIN autorizacion_niveles ON catalogo_centrodecosto.id = autorizacion_niveles.enlace_cc
																						INNER JOIN centrocosto_oc ON catalogo_centrodecosto.id = centrocosto_oc.c_costo
																						INNER JOIN visual_oc ON catalogo_centrodecosto.id = visual_oc.c_costo
																						WHERE 
																							autorizacion_niveles.usuario = '".$_GET['id']."' OR 
																							centrocosto_oc.usuario = '".$_GET['id']."' OR 
																							visual_oc.usuarios = '".$_GET['id']."'
																						GROUP BY catalogo_centrodecosto.id";
																	$res_bm=mysqli_query($conn,$busqueda_modulos);
																	while($r_bm=mysqli_fetch_array($res_bm)){
																		$alm_id = $r_bm['id'];
																		$alm_nom = $r_bm['abreviacion'];
																		echo"<li class='ui-state-active items' id='cc_id_$alm_id'>$alm_nom<div class='fa fa-question btn_det_cc' id='cc_id_item_$alm_id'></div></li>";
																	}
																?>
															</ul>
														</td>
													</tr>
												</table>
											</div>


										</div>
									</div><!------------usuarios contenido Fin---------->
									</div>
									<div style='float: right; margin-right: 20px; padding-bottom: 10px;'>
									<?php
									if($_GET['accion']=="agregar"){
										echo"
										<input type='button' value='Guardar' id='btn_guardar' class='btn btn-success'><br>
										";
									}elseif($_GET['accion']=="editar"){
										echo"
										<input type='button' value='Guardar' id='btn_editar' class='btn btn-success'><br>
										";
									}
									?>
									
									</div>
									<!---------Inicio de modal---------------->
									<!-- Large modal -->
							<button type="button" class="btn btn-primary" id='btn_modal' style='display:none;' data-toggle='modal' data-target='.bd-example-modal-lg'>Large modal</button>

							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-lg modal-dialog-centered">
								<div class="modal-content" id='detalle_permisos_div'>
								 	
								 		
								 	
							  </div>
							</div>

							<!-- Small modal --> 
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm" style='display:none;'>Small modal</button>

							<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-sm">
								<div class="modal-content" >
								...
								</div>
							  </div>
							</div>
									<!---------Final de modal----------------->
								<!------------Pestañas contenido Fin---------->
                             </div><!--end .row -->
						</div>
						</form>
						<!-- end ADD CONTACTS FORM -->	
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			</div>
			</div>
			<!-- END CONTENT -->
			
<script src="styles/js/libs/jquery/jquery-3.0.0.js"></script>

<script>

$(document).ready(main);

	$("#mostrar_fileupload_contrato").click(function(){
		$('#ArchivoContrato').toggle(1000,function() {
			$('#datepicker').toggle(1000,function(){
			

					
				

                $( "#datepicker" ).datepicker();

            });
		
	});
});
	
					

	$("#gen_contrato").click(function(){
			var ck;
	if( $("#checkboxInd").prop("checked") ){
		ck = 'True';
	}
	else{
		ck='False';
	}
		var FechaInicial = $('#FechaInicial').val();
		var Dias_duracion = $('#Dias_duracion').val();
		var idemp = "<?php echo $_GET['id_pe']?>";
		var bd ="<?php echo base64_encode($_SESSION['DB']);?>";
		window.open("http://auwi.mx/auwi_pruebas/v5/modulos/generarPDF.php?id=" + idemp +"&bd="+bd+"&FechaInicial="+FechaInicial+"&Dias_duracion="+Dias_duracion +"&ck=" +ck);

	});
	$('#gen_gafete').click(function(){
		var idemp ="<?php echo $_GET['id_pe']?>";
		var bd ="<?php echo base64_encode($_SESSION['DB']);?>";
		window.open("http://auwi.mx/auwi_pruebas/v5/modulos/gafete_pdf.php?id="+ idemp + "&bd="+bd);
	});



var paqueteActual=$("#paquete_select").val();
var id_usuario="<?php echo $_GET['id']; ?>";
var sort1=[];
var sort2=[];
var longitud1=0;
var longitud2=0;
var item_seleccionado="";
 var regExp = new RegExp('[a-zA-Z]');
function main(){
		<?php
		if($grados){
			?>
		var degree=<?php echo $grados?>;
		$(".fotoperfil").css({ WebkitTransform: 'rotate(' + degree + 'deg)'});
		<?php	
		}else{
		?>
		var degree=0;
		<?php	
		}
		?>
	$(".fotoperfil").click(function(){
		 degree+=90;
			
		$(this).css({ WebkitTransform: 'rotate(' + degree + 'deg)'});
		
			$.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=rotacion&id=<?php echo $_GET['id_pe'];?>",
				   data:'grados='+degree,
				   success:llegada_rotacion,
				   timeout:4000,
				   error:problemas_rotacion
				 }); 
	});
	function llegada_rotacion(){
		
	}
	function problemas_rotacion(){
		
	}
	$("#hen").clockTimePicker(); 
	$("#hsa").clockTimePicker(); 
	 // $("#hen").timer();
	 $("#tiposangre option[value='<?php echo $tsangre_empleado;?>']").prop('selected', true);
	//////////Calendario inicio/////////////
	$.datepicker.regional['es'] = {
                      closeText: 'Cerrar',
                      prevText: '<Ant',
                      nextText: 'Sig>',
                      currentText: 'Hoy',
                      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                      weekHeader: 'Sm',
                      dateFormat: 'dd/mm/yy',
                      firstDay: 1,
                      isRTL: false,
                      showMonthAfterYear: false,
                      yearSuffix: ''
                      };
                      $.datepicker.setDefaults($.datepicker.regional['es']);
					  $("[name=fechaalta],[name=fechabaja],[name=fnac],[name=fing],[name=fsal],[name=vl]").datepicker({dateFormat: "dd-mm-yy"});
	
	function readURL(input) {
		  if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			  $('#fotoperfil').attr('src', e.target.result);
			}
			
			reader.readAsDataURL(input.files[0]);
		  }
		}

		$("#foto").change(function() {
		  readURL(this);
		});
	//////////Calendario Final/////////////
	$("body").mouseover(function(){
		$(".moneda").css("text-align","right");
	});

	$(".moneda").live("change",function(){
		var solo = $(this).val().replace("$","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
		var formmoneda = (new Intl.NumberFormat('es-MX', { //Se cambia a formato moneda ----------------
			style: 'currency',
			currency: 'MXN'
		}).format(solo)); //------------------------------
		$(this).val(formmoneda);
	});
	
	$("#btn_vercp").click(function(){
		$(this).hide();
		$("#btn_cancelarcp").show();
		$("#text_cp").show();
		$("#btn_aceptarcp").show();
	});
	$("#btn_cancelarcp").click(function(){
		$(this).hide();
		$("#btn_vercp").show();
		$("#text_cp").hide();
		$("#btn_aceptarcp").hide();
	});
	$("#btn_aceptarcp").click(function(){
		var valor=$("#text_cp").val();
		// alert(valor.length);
		if(valor.length<3){
			alert("¡El nombre del perfil debe tener al menos 3 caracteres!");
		}else{
			var id_perfil=$("#select_perfil").val();
			$.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=copiar_perfil&perfil="+id_perfil,
				   data:'nombre_nuevo='+valor,
				   success:llegada_copiar_perfil,
				   timeout:4000,
				   error:problemas_copiar_perfil
				 }); 	
		}
	});
	function llegada_copiar_perfil(datos){
		var sep=datos.split("{separar}");
		if(sep[0]=="true"){
			$("#select_perfil").append("<option value='"+sep[1]+"'>"+sep[2]+"</option>");
			$("#select_perfil option[value='"+sep[1]+"']").prop('selected', true);
			$("#btn_cancelarcp").hide();
			$("#btn_vercp").show();
			$("#text_cp").val('');
			$("#text_cp").hide();
			$("#btn_aceptarcp").hide();
		}else{
			problemas_copiar_perfil();
		}
	}
	function problemas_copiar_perfil(){
		alert("¡Problemas al copiar perfil!");
	}
	$('body').on("change","#select_perfil",function(){
		var id_perfil=$(this).val();
		$.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=cambio_de_perfil&perfil="+id_perfil,
				   data:'valores',
				   success:llegada_cambio_de_perfil,
				   timeout:4000,
				   error:problemas_cambio_de_perfil
				 }); 	
	});
	function llegada_cambio_de_perfil(permisos_actuales){
		$("#sortable1").empty();
		$("#sortable2").empty();
		var sep=permisos_actuales.split("{separacion}");
		$("#sortable1").append(sep[1]);
		$("#sortable2").append(sep[0]);
		sort1=[];
		// console.log("despues de igualar a cero sort1: "+sort1.length);
		$("#sortable1 li").each(function(){
		sort1.push($(this).attr("id"));
		// console.log(sort1);
		});
		sort2=[];
		// console.log("despues de igualar a cero sort2: "+sort2.length);
		$("#sortable2 li").each(function(){
		sort2.push($(this).attr("id"));
		// console.log(sort2);
		});
	}
	function problemas_cambio_de_perfil(){
		alert("Problemas en cambio de perfil");
	}
	////Reconocer cambio de asignaciones inicio
	$("#sortable1 li").each(function(){
		sort1.push($(this).attr("id"));
		// console.log(sort1);
	});
	$("#sortable2 li").each(function(){
		sort2.push($(this).attr("id"));
		// console.log(sort2);
	});
	//Segundas funciones de permisos a sustituir Inicio
	/* $('body').on("mouseout","#sortable1 li",function(){
		var sort3=[];
		longitud1=sort1.length;
		console.log("Sort 1 antes: "+sort1.length);
		console.log("Sort 3 antes: "+sort3.length);
		$("#sortable1 li").each(function(){
			sort3.push($(this).attr("id"));
			// console.log(sort3);
			
		});	
		var longitud3=sort3.length;
		if(longitud1==longitud3){
			// alert("Sin cambios");
		}else{
			// alert("Asignado");
			// alert($(this).attr("id"));
		}
		sort1=sort3;
		console.log("Antes de igualar a cero sort2: "+sort2.length);
		sort2=[];
		console.log("despues de igualar a cero sort2: "+sort2.length);
		$("#sortable2 li").each(function(){
		sort2.push($(this).attr("id"));
		// console.log(sort2);
		});
		console.log("nuevo valor a cero sort2: "+sort2.length);
		console.log("Sort 1 despues: "+sort1.length);
		console.log("Sort 3 despues: "+sort3.length);
	}); */
	/* $('body').on("mouseout","#sortable2 li",function(){
		var sort4=[];
		longitud2=sort2.length;
		console.log("Sort 2 antes: "+sort2.length);
		console.log("Sort 4 antes: "+sort4.length);
		$("#sortable2 li").each(function(){
			sort4.push($(this).attr("id"));
			// console.log(sort4);
		});	
		var longitud4=sort4.length;
		if(longitud2==longitud4){
			// alert("Sin cambios");
		}else{
			alert("Des-asignado");
			var sepitm=$(this).attr("id").split("_");
			// alert(sepitm[1]);
			quitar_permisos_del_moudulo(sepitm[1]);
		}
		sort2=sort4;
		console.log("Antes de igualar a cero sort1: "+sort1.length);
		sort1=[];
		console.log("despues de igualar a cero sort1: "+sort1.length);
		$("#sortable1 li").each(function(){
		sort1.push($(this).attr("id"));
		// console.log(sort1);
		});
		console.log("con valor nuevo sort1: "+sort1.length);
		console.log("Sort 2 despues: "+sort2.length);
		console.log("Sort 4 despues: "+sort4.length);
	}); */
	//Segundas funciones de permisos a sustituir Final
	function poner_permisos_del_modulo(submodulo){
		var id_perfil=$("#select_perfil").val();
		 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=poner_permisos&perfil="+id_perfil+"&submodulo="+submodulo,
				   data:'valores',
				   success:llegada_poner_permisos,
				   timeout:4000,
				   error:problemas_poner_permisos
				 }); 
	}
	function llegada_poner_permisos(){
		
	}
	function problemas_poner_permisos(){
	alert("Problemas al poner permisos");	
	}
	function quitar_permisos_del_moudulo(submodulo){
		var id_perfil=$("#select_perfil").val();
		 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=quitar_permisos&perfil="+id_perfil+"&submodulo="+submodulo,
				   data:'valores',
				   success:llegada_quitar_permisos,
				   timeout:4000,
				   error:problemas_quitar_permisos
				 }); 
	}
	function llegada_quitar_permisos(){
		
	}
	function problemas_quitar_permisos(){
	alert("Problemas al quitar permisos");	
	}
	// $('body').on("mouseout","#sortable2 li",function(){
		// var this_id=$(this).attr("id");
		// alert(this_id);
		// setTimeout(agregarOquitar_simbolo_interrogacion(),2000);
	// });
	////Reconocer cambio de asignaciones final
	//guardar permisos indivudal por cuadro inicio///////////
	$('body').on("click",".agregar_check",function(){
		var valores_accion=[];
		var id_perfil=$("#select_perfil").val();
		var id_actual=$(this).attr( "id");
		var estado=$(this).prop( "checked");
		var tabla_actual=$(this).val();
				if(estado==true){//Checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+1);
				}else{//No checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+0);
				}
				 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=guardar_permisos&tipo=Accion&perfil="+id_perfil,
				   data:{'valores': JSON.stringify(valores_accion)},
				   success:llegada_permisos,
				   timeout:4000,
				   error:problemas_permisos
				 }); 

		  // return false;
	});
	$('body').on("click",".editar_check",function(){
		var valores_accion=[];
		var id_perfil=$("#select_perfil").val();
		var id_actual=$(this).attr( "id");
		var estado=$(this).prop( "checked");
		var tabla_actual=$(this).val();
				if(estado==true){//Checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+1);
				}else{//No checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+0);
				}
				 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=guardar_permisos&tipo=Accion&perfil="+id_perfil,
				   data:{'valores': JSON.stringify(valores_accion)},
				   success:llegada_permisos,
				   timeout:4000,
				   error:problemas_permisos
				 }); 

		  // return false;
	});
	$('body').on("click",".eliminar_check",function(){
		// alert("inicio de funcion");
		var valores_accion=[];
		var id_perfil=$("#select_perfil").val();
		var id_actual=$(this).attr( "id");
		var estado=$(this).prop( "checked");
		var tabla_actual=$(this).val();
				if(estado==true){//Checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+1);
				}else{//No checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+0);
				}
				// alert(valores_accion);
				 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=guardar_permisos&tipo=Accion&perfil="+id_perfil,
				   data:{'valores': JSON.stringify(valores_accion)},
				   success:llegada_permisos,
				   timeout:4000,
				   error:problemas_permisos
				 }); 

		  // return false;
	});
	$('body').on("click",".visualizar_check",function(){
		var valores_accion=[];
		var id_perfil=$("#select_perfil").val();
		var id_actual=$(this).attr( "id");
		var estado=$(this).prop( "checked");
		var tabla_actual=$(this).val();
				if(estado==true){//Checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+1);
				}else{//No checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+0);
				}
				 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=guardar_permisos&tipo=Accion&perfil="+id_perfil,
				   data:{'valores': JSON.stringify(valores_accion)},
				   success:llegada_permisos,
				   timeout:4000,
				   error:problemas_permisos
				 }); 

		  // return false;
	});
	$('body').on("click",".importar_check",function(){
		var valores_accion=[];
		var id_perfil=$("#select_perfil").val();
		var id_actual=$(this).attr( "id");
		var estado=$(this).prop( "checked");
		var tabla_actual=$(this).val();
				if(estado==true){//Checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+1);
				}else{//No checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+0);
				}
				 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=guardar_permisos&tipo=Accion&perfil="+id_perfil,
				   data:{'valores': JSON.stringify(valores_accion)},
				   success:llegada_permisos,
				   timeout:4000,
				   error:problemas_permisos
				 }); 

		  // return false;
	});
	$('body').on("click",".exportar_check",function(){
		var valores_accion=[];
		var id_perfil=$("#select_perfil").val();
		var id_actual=$(this).attr( "id");
		var estado=$(this).prop( "checked");
		var tabla_actual=$(this).val();
				if(estado==true){//Checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+1);
				}else{//No checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+0);
				}
				 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=guardar_permisos&tipo=Accion&perfil="+id_perfil,
				   data:{'valores': JSON.stringify(valores_accion)},
				   success:llegada_permisos,
				   timeout:4000,
				   error:problemas_permisos
				 }); 

		  // return false;
	});
	$('body').on("click",".imprimir_check",function(){
		var valores_accion=[];
		var id_perfil=$("#select_perfil").val();
		var id_actual=$(this).attr( "id");
		var estado=$(this).prop( "checked");
		var tabla_actual=$(this).val();
				if(estado==true){//Checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+1);
				}else{//No checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+0);
				}
				 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=guardar_permisos&tipo=Accion&perfil="+id_perfil,
				   data:{'valores': JSON.stringify(valores_accion)},
				   success:llegada_permisos,
				   timeout:4000,
				   error:problemas_permisos
				 }); 

		  // return false;
	});
	//guardar permisos indivudal por cuadro fin///////////
	///Recorrer permisos por fila para guardar datos Inicio//////
	function tomar_datos_por_fila(id_fila){
		var arreglo_fila=[];
		var sep=id_fila.split("_");
		var modulo=sep[1];
		var submodulo=sep[2];
		var agr=0;
		var edi=0;
		var eli=0;
		var vis=0;
		var imp=0;
		var exp=0;
		var imr=0;
		var id_perfil=$("#select_perfil").val();
		var tabla_actual=$("#agr_"+modulo+"_"+submodulo).val();
		if($("#agr_"+modulo+"_"+submodulo).prop( "checked")==true){agr=1;}else{}
		if($("#edi_"+modulo+"_"+submodulo).prop( "checked")==true){edi=1;}else{}
		if($("#eli_"+modulo+"_"+submodulo).prop( "checked")==true){eli=1;}else{}
		if($("#vis_"+modulo+"_"+submodulo).prop( "checked")==true){vis=1;}else{}
		if($("#imp_"+modulo+"_"+submodulo).prop( "checked")==true){imp=1;}else{}
		if($("#exp_"+modulo+"_"+submodulo).prop( "checked")==true){exp=1;}else{}
		if($("#imr_"+modulo+"_"+submodulo).prop( "checked")==true){imr=1;}else{}
		
		arreglo_fila.push(tabla_actual+"_"+modulo+"_"+submodulo+"_"+agr+"_"+edi+"_"+eli+"_"+vis+"_"+imp+"_"+exp+"_"+imr);
		 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=guardar_permisos&tipo=Fila&perfil="+id_perfil,
				   data:{'valores': JSON.stringify(arreglo_fila)},
				   success:llegada_permisos2,
				   timeout:4000,
				   error:problemas_permisos2
				 }); 

		  return false;
	}
	function llegada_permisos2(info){
		// alert(info);
	}
	function problemas_permisos2(){
		alert("Problemas al guardar permisos");
	}
	///Recorrer permisos por fila para guardar datos Final//////
	///Recorrer permisos por accion para guardar datos Inicio//////
	function tomar_datos_por_accion(id_accion){
		var valores_accion=[];
		var id_perfil=$("#select_perfil").val();
		$("."+id_accion).each(function(){
				var estado=$(this).prop( "checked");
				var id_actual=$(this).attr( "id");
				var tabla_actual=$(this).val();
				
				if(estado==true){//Checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+1);
				}else{//No checked
					valores_accion.push(tabla_actual+"_"+id_actual+"_"+0);
				}
		});
		// alert(valores_accion);
		 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=guardar_permisos&tipo=Accion&perfil="+id_perfil,
				   data:{'valores': JSON.stringify(valores_accion)},
				   success:llegada_permisos,
				   timeout:4000,
				   error:problemas_permisos
				 }); 

		  return false;
		// llamada_ajax(valores_accion,"Accion");
	}
	///Recorrer permisos por accion para guardar datos Fin//////
	//Llamada ajax para guardar permisos Inicio//////////////
	function llegada_permisos(info){
		// alert(info);
	}
	function problemas_permisos(){
		alert("Problemas al guardar permisos");
	}
	//Llamada ajax para guardar permisos Final///////////////
	//Seleccionar por accion inicio//////////////////////////
	$('body').on("click",".accion_todo",function(){
		var this_id=$(this).attr("id");
		var estado=$(this).prop( "checked");
		if(estado==true){
			$("."+this_id).prop( "checked",true);
		}else{
			$("."+this_id).prop( "checked",false);
		}
		
		tomar_datos_por_accion(this_id);
	});
	//Seleccionar por accion fin/////////////////////////////
	//Seleccionar por submodulo inicio///////////////////////
	$('body').on("click",".submodulo_todo",function(){
		var this_id=$(this).attr("id");
		var sep=this_id.split("_");
		var modulo=sep[1];
		var submodulo=sep[2];
		
		var estado=$("#"+this_id).prop( "checked");
		if(estado==true){
			$("#agr_"+modulo+"_"+submodulo).prop( "checked",true);
			$("#edi_"+modulo+"_"+submodulo).prop( "checked",true);
			$("#eli_"+modulo+"_"+submodulo).prop( "checked",true);
			$("#vis_"+modulo+"_"+submodulo).prop( "checked",true);
			$("#imp_"+modulo+"_"+submodulo).prop( "checked",true);
			$("#exp_"+modulo+"_"+submodulo).prop( "checked",true);
			$("#imr_"+modulo+"_"+submodulo).prop( "checked",true);
		}else{
			$("#agr_"+modulo+"_"+submodulo).prop( "checked",false);
			$("#edi_"+modulo+"_"+submodulo).prop( "checked",false);
			$("#eli_"+modulo+"_"+submodulo).prop( "checked",false);
			$("#vis_"+modulo+"_"+submodulo).prop( "checked",false);
			$("#imp_"+modulo+"_"+submodulo).prop( "checked",false);
			$("#exp_"+modulo+"_"+submodulo).prop( "checked",false);
			$("#imr_"+modulo+"_"+submodulo).prop( "checked",false);
		}
		tomar_datos_por_fila(this_id);
	});
	//Seleccionar por submodulo fin/////////////////////////	
	$('body').on("click",".btn_detalle",function(){
		var id_detalle=$(this).attr("id");
		// alert(id_detalle); 
		var sep=id_detalle.split("_");
		// alert(sep[2]);
		var id_perfil=$("#select_perfil").val();
				 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=buscar_detalle_permisos",
				   data:"valores="+sep[2]+"{division}"+id_perfil,
				   success:llegada,
				   timeout:4000,
				   error:problemas
				 }); 

		  return false;
	});
	function llegada(datos){
		$("#detalle_permisos_div").empty();
		$("#detalle_permisos_div").append(datos);
		//inicializador de checkbox por accion inicio////////////
			var agr=$("#agregar_check_estatus").val();
			var edi=$("#editar_check_estatus").val();
			var eli=$("#eliminar_check_estatus").val();
			var vis=$("#visualizar_check_estatus").val();
			var imp=$("#importar_check_estatus").val();
			var exp=$("#exportar_check_estatus").val();
			var imr=$("#imprimir_check_estatus").val();
			if(agr==1){$("#agregar_check").prop("checked",true);}else{$("#agregar_check").prop("checked",false);}
			if(edi==1){$("#editar_check").prop("checked",true);}else{$("#editar_check").prop("checked",false);}
			if(eli==1){$("#eliminar_check").prop("checked",true);}else{$("#eliminar_check").prop("checked",false);}
			if(vis==1){$("#visualizar_check").prop("checked",true);}else{$("#visualizar_check").prop("checked",false);}
			if(imp==1){$("#importar_check").prop("checked",true);}else{$("#importar_check").prop("checked",false);}
			if(exp==1){$("#exportar_check").prop("checked",true);}else{$("#exportar_check").prop("checked",false);}
			if(imr==1){$("#imprimir_check").prop("checked",true);}else{$("#imprimir_check").prop("checked",false);}
		//inicializador de checkbox por accion fin///////////////
		$("#btn_modal").click();	
	}

	$("#save_cc").live("click", function(){
		var usuario = $(this).attr("usuario");
		var cc = $(this).attr("cc");
		var monto_ini = $("#monto_ini").val();
		var monto_fin = $("#monto_fin").val();
		var autorizac = $("#autoriza").val();
		var visualiza = $("#visual").val();
		var creacionn = $("#crea").val();

		$.post("?ajax=save_cc_all",{
				usuario:usuario,
				cc:cc,
				monto_ini:monto_ini,
				monto_fin:monto_fin,
				autorizac:autorizac,
				visualiza:visualiza,
				creacionn:creacionn
			},function(data_cc){

			if(data == 1){
				alert( "Se elimino con exito" );
				window.location.href = "index.php?modulo=catalogo_centrodecosto";
			}else{
				alert( "Problema al eliminar" );
			}
		});
	});

	$('body').on("click",".btn_det_cc",function(){
		var id_detalle = $(this).attr("id");
		var sep = id_detalle.split("_");

		$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"?ajax=buscar_det_cc",
			data:"valores="+sep[3]+"-/-"+id_usuario,
			success:llegada,
			timeout:4000,
			error:problemas
		}); 

		return false;
	});
	function problemas(){
		alert("problemas al buscar detalle de permisos");
	}
	
	////Primeras funciones de permisos a sustituir inicio
	/* $('body').on("mousemove","#sortable1 li",function(){
		$("#sortable2 li").each(function(){
			var this_id=$(this).attr("id");
			$("#sim_"+this_id).remove();
		});
		$("#sortable1 li").each(function(){
			var this_id=$(this).attr("id");
			$("#sim_"+this_id).remove();
			$("#"+this_id).append("<div class='fa fa-question btn_detalle' id='sim_"+this_id+"' ></div>");
			// console.log($("#"+this_id).text());
		});
	});
	$('body').on("mousemove","#sortable2 li",function(){
		$("#sortable2 li").each(function(){
			var this_id=$(this).attr("id");
			$("#sim_"+this_id).remove();
		});
		$("#sortable1 li").each(function(){
			var this_id=$(this).attr("id");
			$("#sim_"+this_id).remove();
			$("#"+this_id).append("<div class='fa fa-question btn_detalle' id='sim_"+this_id+"' ></div>");
			// console.log($("#"+this_id).text());
		});
	}); */
	///Primeras funciones de permisos a sustituir final
	/* $("#sortable1").mouseup(function(){
		// alert("ha cambiado s1");
		setTimeout(contarElementosUl,1000);
		
	});
	$("#sortable2").mouseup(function(){
		// alert("ha cambiado s2");
		contarElementosUl();
	}); */
		$("#FechaInicial").datepicker();
		// $("#Fecha_Final").datepicker();

	$('#Dias_duracion').on('input', function () { 
    						this.value = this.value.replace(/[^0-9]/g,'');
							});
	$("#btn_empleado").click(function(){		
		$("#btn_empleado").removeClass();
		$( "#btn_usuarios" ).removeClass();
		$( "#btn_empleado" ).addClass( "btn btn-info btn-block" );
		$( "#btn_usuarios" ).addClass( "btn  btn-block btn_inactivo" );		
		
		$("#usuarios").hide();
		$("#empleados").show();		
	});
	$("#btn_usuarios").click(function(){
		$("#empleados").hide();
		$("#usuarios").show();	
		$("#btn_empleado").removeClass();
		$( "#btn_usuarios" ).removeClass();
		$( "#btn_empleado" ).addClass( "btn  btn-block btn_inactivo" );
		$( "#btn_usuarios" ).addClass( "btn btn-info btn-block" );	
		
		
	});
	$(".empleados_m1").click(function(){
		// alert("uno");
		$("#empleados_general").show();
		$("#empleados_laboral").hide();
		$("#empleados_documentos").hide();
	});
	$(".empleados_m2").click(function(){
		// alert("dos");
		$("#empleados_general").hide();
		$("#empleados_laboral").show();
		$("#empleados_documentos").hide();
	});
	$(".empleados_m3").click(function(){
		// alert("tres");
		$("#empleados_general").hide();
		$("#empleados_laboral").hide();
		$("#empleados_documentos").show();
	});
	$(".usuarios_m1").click(function(){
		// alert("uno");
		$("#usuarios_general").show();
		$("#usuarios_permisos").hide();
		$("#usuarios_almacen").hide();
	});
	$(".usuarios_m2").click(function(){
		// alert("dos");
		$("#usuarios_general").hide();
		$("#usuarios_permisos").show();
		$("#usuarios_almacen").hide();
	});

	$(".usuarios_m3").click(function(){
		$("#usuarios_general").hide();
		$("#usuarios_permisos").hide();
		$("#usuarios_almacen").show();
	});
	
	$("#btn_ver").mouseover(function(){
		$("#pass").attr('type','text');
		$("#btn_ver").attr('class','fa fa-eye-slash');
	});
	$("#btn_ver").mouseout(function(){
		$("#pass").attr('type','password');
		$("#btn_ver").attr('class','fa fa-eye');
	});
	// $( function() {
    // $( "#sortable1, #sortable2" ).sortable({
      // connectWith: ".connectedSortable"
    // }).disableSelection();
  // } );
   $('#sortable1, #sortable2').sortable({
        connectWith: '.connectedSortable',
        receive: function(ev, ui) {
              // alert("cambio");
            if(ui.item.hasClass("ui-state-active")){
				ui.item.removeClass();
				ui.item.addClass( "ui-state-highlight items" );
				$("#sim_"+ui.item.attr("id")).remove();
				var sepitm=ui.item.attr("id").split("_");
				quitar_permisos_del_moudulo(sepitm[1]);
				// asignacion_de_cuenta("2",ui.item.attr("id"));
				// alert("Id usuario: "+id_usuario);
             // alert(ui.item.attr("id"));
            }else{
				ui.item.removeClass();
				ui.item.addClass( "ui-state-active items" );
				ui.item.append("<div class='fa fa-question btn_detalle' id='sim_"+ui.item.attr("id")+"' ></div>");
				var sepitm=ui.item.attr("id").split("_");
				poner_permisos_del_modulo(sepitm[1]);
				// asignacion_de_cuenta("1",ui.item.attr("id"));
				// alert("Id usuario: "+id_usuario);
				// alert(ui.item.attr("id"));
			}
        }
    });
  $('#sortable3, #sortable4').sortable({
        connectWith: '.connectedSortable',
        receive: function(ev, ui) {
              // alert("cambio");
            if(ui.item.hasClass("ui-state-active")){
				ui.item.removeClass();
				ui.item.addClass( "ui-state-highlight items" );
				asignacion_de_cuenta("2",ui.item.attr("id"));
				// alert("Id usuario: "+id_usuario);
             // alert(ui.item.attr("id"));
            }else{
				ui.item.removeClass();
				ui.item.addClass( "ui-state-active items" );
				asignacion_de_cuenta("1",ui.item.attr("id"));
				// alert("Id usuario: "+id_usuario);
				// alert(ui.item.attr("id"));
			}
        }
    });
  
   $('#sortable5, #sortable6').sortable({
        connectWith: '.connectedSortable',
        receive: function(ev, ui) {
              // alert("cambio");
            if(ui.item.hasClass("ui-state-active")){
				ui.item.removeClass();
				ui.item.addClass( "ui-state-highlight items" );
				asignacion_de_permisomovil("2",ui.item.attr("id"));
				// alert("Id usuario: "+id_usuario);
             // alert(ui.item.attr("id"));
            }else{
				ui.item.removeClass();
				ui.item.addClass( "ui-state-active items" );
				asignacion_de_permisomovil("1",ui.item.attr("id"));

				// alert("Id usuario: "+id_usuario);
				// alert(ui.item.attr("id"));
			}
        }
    });
  
	$('#almacen_ini, #almacen_fin').sortable({
		connectWith: '.connect_almacen',
		receive: function(ev, ui) {
			// alert("cambio");
			if(ui.item.hasClass("ui-state-active")){
				ui.item.removeClass();
				ui.item.addClass( "ui-state-highlight items" );
				asignacion_de_almacen("2",ui.item.attr("id"));
				// alert("Id usuario: "+id_usuario);
				// alert(ui.item.attr("id"));
			}else{
				ui.item.removeClass();
				ui.item.addClass( "ui-state-active items" );
				asignacion_de_almacen("1",ui.item.attr("id"));
				// alert("Id usuario: "+id_usuario);
				// alert(ui.item.attr("id"));
			}
		}
	});
  
	$('#cent_cost_ini, #cent_cost_fin').sortable({
		connectWith: '.connect_cent_cost',
		receive: function(ev, ui) {
			if(ui.item.hasClass("ui-state-active")){
				ui.item.removeClass();
				ui.item.addClass( "ui-state-highlight items" );
				$("#"+ui.item.attr("id")+"_id").remove();
				asignacion_de_cent_cost("2",ui.item.attr("id"));
			}else{
				ui.item.removeClass();
				ui.item.addClass( "ui-state-active items" );
				ui.item.append("<div class='fa fa-question btn_det_cc' id='cc_id_item_"+ui.item.attr("id").replace("cc_id_","")+"_id'></div>");
				asignacion_de_cent_cost("1",ui.item.attr("id"));
				// <li class='ui-state-active items' id='cc_id_$alm_id'>$alm_nom<div class='fa fa-question btn_det_cc' id='cc_id_item_$alm_id'></div></li>
			}
		}
	});
	function asignacion_de_cuenta(tipo,id_cuenta){
		 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=asignar_cuentas&usr="+id_usuario+"&tipo="+tipo+"&cuenta="+id_cuenta,
				   data:'valores=1',
				   success:llegada_asigcuenta,
				   timeout:4000,
				   error:problemas_asigcuenta
				 }); 
	}
	function asignacion_de_permisomovil(tipo,id_cuenta){
		// alert("Tipo: "+tipo+" Id permiso movil: "+id_cuenta);
		 $.ajax({
				   async:true,
				   type: "POST",
				   dataType: "html",
				   contentType: "application/x-www-form-urlencoded",
				   url:"?ajax=asignar_permisomovil&usr="+id_usuario+"&tipo="+tipo+"&cuenta="+id_cuenta,
				   data:'valores=1',
				   success:llegada_permisosmovil,
				   timeout:4000,
				   error:problemas_asigcuenta
				 }); 
	}
	function llegada_permisosmovil(datos_movil){
		var sep=datos_movil.split(",");
		if(sep[0]=="1"){
			// alert("¡"+sep[1]+"!");
			if(sep[1]=="CF"){
				alert("¡Correo invalido, favor de verificar que su correo este escrito correctamente!");
			}else{
				alert(sep[1]);
			}
			
		}else if(sep[0]=="3"){
			// alert("¡"+sep[1]+"!");
			if(sep[1]=="CF"){
				alert("¡Correo invalido, favor de verificar que su correo este escrito correctamente!");
			}else{
				alert(sep[1]);
			}
		}else if(sep[0]=="7"){
			// alert("¡"+sep[1]+"!");
			if(sep[1]=="CF"){
				alert("¡Correo invalido, favor de verificar que su correo este escrito correctamente!");
			}else{
				alert(sep[1]);
			}
		}else if(sep[0]=="11"){
			// alert("¡"+sep[1]+"!");
			if(sep[1]=="CF"){
				alert("¡Correo invalido, favor de verificar que su correo este escrito correctamente!");
			}else{
				alert(sep[1]);
			}
		}else{
			
		}
	}
	function asignacion_de_almacen(tipo,id_almacen){
		$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"?ajax=save_asignar_almacen&usr="+id_usuario+"&tipo="+tipo+"&almacen="+id_almacen,
			data:'valores=1',
			success:llegada_asigcuenta,
			timeout:4000,
			error:problemas_asigcuenta
		}); 
	}

	function asignacion_de_cent_cost(tipo,id_cent_cost){
		$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"?ajax=save_asignar_cent_cost&usr="+id_usuario+"&tipo="+tipo+"&cent_cost="+id_cent_cost,
			data:'valores=1',
			success:llegada_asigcuenta,
			timeout:4000,
			error:problemas_asigcuenta
		}); 
	}

	function llegada_asigcuenta(dato){
		
	}
	function problemas_asigcuenta(){
		alert("Problemas al asignar cuenta");
	}
	////Formato moneda de salario diario inicio///////////
	function formato_moneda_val(id_input){
	var v1=$("#"+id_input).val();
	var r1 = (new Intl.NumberFormat('es-MX', { 
	//Se cambia a formato moneda ----------------
    style: 'currency',
    currency: 'MXN'
    }).format(v1)); 
	$("#"+id_input).val(r1);
	}
	$("#sald").focus(function(){
		var valor_sin_formato = $(this).val().replace("$","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","");
		$(this).val(valor_sin_formato);
	});
	$("#sald").blur(function(){		
		formato_moneda_val("sald");
	});
	////Formato moneda de salario diario Final///////////
	//////Formato porcentaje de comision inicio/////////
	$("#com").focus(function(){
		var valor_sin_formato=$(this).val().replace("%","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","");
		$(this).val(valor_sin_formato);
	});
	$("#com").blur(function(){
		var valor_actual=$(this).val();
		$(this).val(valor_actual+"%");
	});
	//////Formato porcentaje de comision Final/////////
	//Activar y desactivar Inicio /////////////

	// $("#btn_desactivar").click(function(){
	// 	$("#text_activo").val("0");
	// 	$(this).hide();
	// 	$("#btn_activar").show();
	// 	$("#coment").show();
	// 	$("#fb").show();
	// 	$("#mb").show();
	// });
	// $("#btn_activar").click(function(){
	// 	$("#text_activo").val("1");
	// 	$(this).hide();
	// 	$("#btn_desactivar").show();
	// 	$("#coment").hide();
	// 	$("#fb").hide();
	// 	$("#mb").hide();
	// });

	$("#dar_baja").click(function(){


		$("#text_activo").val("0");
		$(this).hide();
		$("#dar_bajadesac").show();
		$("#coment").show();
		$("#fb").show();
		$("#mb").show();
	
	});
	$("#dar_bajadesac").click(function(){
		$("#text_activo").val("1");
		$(this).hide();
		$("#dar_baja").show();
		$("#coment").hide();
		$("#fb").hide();
		$("#mb").hide();
	});


	// $("#btn_desactivar").click(function(){
	// 	$("#text_activo").val("0");
	// 	$(this).hide();
	// 	$("#btn_activar").show();
	// 	$("#coment").show();
	// 	$("#fb").show();
	// 	$("#mb").show();
	// });
	// $("#btn_activar").click(function(){
	// 	$("#text_activo").val("1");
	// 	$(this).hide();
	// 	$("#btn_desactivar").show();
	// 	$("#coment").hide();
	// 	$("#fb").hide();
	// 	$("#mb").hide();
	// });
	//Activar y desactivar Final /////////////
	////////////paquetes Inicio///////////////
	$("#btn_agregar_paquete").click(function(){
		$(this).hide();
		$("#tabla_paquetes").hide();
		$("#agregar_paquetes").show();
	});
	$("#btn_cancelar_paquete").click(function(){
		$("#btn_agregar_paquete").show();
		$("#tabla_paquetes").show();
		$("#agregar_paquetes").hide();
	});
	 $('input[name=cantidad_usuarios]').on('keypress', function(e) {
        if (e.which == 32)
            return false;
        if($('input[name=cantidad_usuarios]')<0)
        	  return false;
    });
	$("#btn_guardar_paquete").click(function(){
		var paquete_radio=$('input[name=modalidad_paquetes]:checked').val();
		var cantUsuarios_paquete=parseInt($('input[name=cantidad_usuarios]').val());
		if(paquete_radio==undefined){
			alert("¡Debes seleccionar un paquete!");
		}else if(cantUsuarios_paquete==0 || cantUsuarios_paquete==""){
			alert("¡Debes asignar una cantidad de usuarios!");
		}else{
			//alert("paquete: "+paquete_radio+" Usuarios: "+cantUsuarios_paquete);
			$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"?ajax=paquetes_guardar&p="+paquete_radio+"&cu="+cantUsuarios_paquete,
			data:'valores=1',
			success:llegada_paquete,
			timeout:4000,
			error:problemas_paquete
			}); 
		}
		
	});
	function llegada_paquete(datos){
			//alert("¡Se guardó con éxito!");
			if(datos=="true"){
				alert("¡Se guardó con éxito!");
				actualizar_lista_paquetes();
				actualiza_select_paquetes();
				$("#btn_cancelar_paquete").click();
			}else{
				alert(datos);
			}
	}
	function problemas_paquete(){
		alert("¡Problemas al guardar paquete!");
	}
	function actualiza_select_paquetes(){
		$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"?ajax=actualizar_select_paquetes",
			data:'valores=1',
			success:llegada_selectPaquete,
			timeout:4000,
			error:problemas_selectPaquete
			}); 
	}
	function llegada_selectPaquete(datos){
		var sep=datos.split("{division}");
		var idpaq=sep[0];
		var numpaq=sep[1];
		$("#paquete_select").append("<option value='"+idpaq+"'>"+numpaq+"</option>");
	}
	function problemas_selectPaquete(){
		
	}
	 function actualizar_lista_paquetes(){
	 	$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"?ajax=actualizar_lista_paquetes",
			data:'valores=1',
			success:llegada_listaPaquete,
			timeout:4000,
			error:problemas_listaPaquete
			}); 
	 }
	 function llegada_listaPaquete(datos){
			$('input[name=modalidad_paquetes]').prop('checked', false); 
			$('input[name=cantidad_usuarios]').val('0');
	 		$("#id_detalle_paquetes").empty();
	 		$("#id_detalle_paquetes").append(datos);
	 		// alert(datos);
	 }
	 function problemas_listaPaquete(){

	 }
		actualizar_numero_asignados();
	  function actualizar_numero_asignados(){
		 var option_select=$("#paquete_select").val();
		 $.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"?ajax=autocompletar_usuarios_disponibles",
			data:'valores='+option_select,
			success:llegada_paqueteSelect,
			timeout:4000,
			error:problemas_paqueteSelect
			}); 
	 }
	 $("#paquete_select").change(function(){
		 var option_select=$(this).val();
		 $.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"?ajax=autocompletar_usuarios_disponibles",
			data:'valores='+option_select,
			success:llegada_paqueteSelect,
			timeout:4000,
			error:problemas_paqueteSelect
			}); 
	 });
	 function llegada_paqueteSelect(datos){
		 $("#cu_select").val(datos);
	 }
	 function problemas_paqueteSelect(){
		 
	 }
	////////////paquetes Final///////////////
	//////////Validacion no rellene con cookies inicio////////
	var cpas=$("#pass").val();
	if(cpas=="NO_USUARIO_DISPONIBLE"){
		$("#user").val('');
		$("#pass").val('');
	}
	var accion_php="<?php echo $_GET['accion']?>";
	if(accion_php=="agregar"){
		$("#user").val('');
		$("#pass").val('');
	}
	//////////Validacion no rellene con cookies final////////
	////////Validacion correo valido Inicio///////////////
	$("#correo_djss").blur(function(){
		var correo_string=$(this).val();
		if(correo_string!=""){
			if(correo_string.indexOf('@') == -1){
				alert("¡"+correo_string+" no es un correo valido!");
				$(this).val('');
			}
		}
	});
	////////Validacion correo valido Final///////////////
	//////////////Botones de agregar inicio//////////////
	$("#btn_agregar_cuentas").click(function(){
		window.open("http://auwi.mx/auwi_pruebas/v3/index.php?modulo=flujoefectivo&accion=agregar");
	});
	$("#btn_agregar_almacen").click(function(){
		window.open("http://auwi.mx/auwi_pruebas/v3/index.php?modulo=almacen&accion=agregar");
	});
	$("#btn_agregar_centroc").click(function(){
		window.open("http://auwi.mx/auwi_pruebas/v3/index.php?modulo=catalogo_centrodecosto&accion=agregar");
	});
	//////////////Botones de agregar Final//////////////
	/////////////////////Envio de datos ajax form data Inicio//////////////////
	$("#btn_guardar").click(function(){
		var ck;
	if( $("#checkboxInd").prop("checked") ){
		ck = 'True';
	}
	else{
		ck='False';
	}
		var valor_sin_formato = $("#sald").val().replace("$","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","");
		$("#sald").val(valor_sin_formato);
		var valor_sin_formato2=$("#com").val().replace("%","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","");
		$("#com").val(valor_sin_formato2);
		
		if($("#user").val().length < 1){//No crea usuario no es obligatorio el correo
			
		
		
			var fg = new FormData(document.getElementById("rhh"));
					$.ajax({
						url:"modulos/perfiles_procesos.php?accion=1&ck="+ck,
						type:"POST",
						data:fg,
						contentType: false,
						processData: false,
						success:function(data){
						var sep=data.split("{division}");
						if(sep[0]=="CO"){
							// alert("Camino 1");
									// var mensaje_correo=sep[0];
									var id_us=sep[1];
									var id_pe=sep[2];
									// alert(data);
										if(id_us=="NA"){
										alert("¡Se guardó con éxito! ");
										// alert(mensaje_correo);
											window.location.href = "index.php?modulo=personal";
										}else{
											alert("¡Se guardó con éxito! ");
											// alert(mensaje_correo);
											window.location.href = "index.php?modulo=personal";
										}	
						}else{
							// alert("Camino 2");
									var mensaje_correo=sep[0];
									var id_us=sep[3];
									var id_pe=sep[4];
									// alert("0: "+sep[0]+" 1: "+sep[1]+" 2: "+sep[2]+" 3: "+sep[3]+" 4: "+sep[4])
									// alert(data);
										if(id_us=="NA"){
										alert("¡Se guardó con éxito! ");
										alert(mensaje_correo);
											window.location.href = "index.php?modulo=personal";
										}else{
											alert("¡Se guardó con éxito! ");
											alert(mensaje_correo);
											window.location.href = "index.php?modulo=personal";
										}
						}
						
						},error:function(data){
						alert("Error: "+data);
					}
				});
			}else if($("#pass").val().length < 1){
				alert("¡Debe introducir una contraseña!");
			}else if($("#cu_select").val() > 0){//crea usuario correo obligatorio
			if($("#correo_djss").val().length < 1){//No tiene correo pedirlo
				alert("Correo obligatorio al crear usuario");
			}else{
					var fg = new FormData(document.getElementById("rhh"));
					$.ajax({
						url:"modulos/perfiles_procesos.php?accion=1&ck="+ck,
						type:"POST",
						data:fg,
						contentType: false,
						processData: false,
						success:function(data){
						var sep=data.split("{division}");
						if(sep[0]=="CO"){
											// var mensaje_correo=sep[0];
											var id_us=sep[1];
											var id_pe=sep[2];
											var estado_del_usuario=sep[3]; 
											// alert(data);
											if(estado_del_usuario=="UE"){
												alert("¡Usuario existente, favor de cambiarlo!");
												if(id_us=="NA"){ 
													// alert("¡Se guardo con exito! ");
													window.location='?modulo=personal&accion=editar&id_pe='+id_pe;
												}else{
													// alert("¡Se guardo con exito! ");
													window.location='?modulo=personal&accion=editar&id='+id_us+'&id_pe='+id_pe;
												}
											}else{
												if(id_us=="NA"){ 
													alert("¡Se guardó con éxito! ");
													// alert(mensaje_correo);
													window.location.href = "index.php?modulo=personal";
												}else{
													alert("¡Se guardó con éxito! ");
													// alert(mensaje_correo);
													window.location.href = "index.php?modulo=personal";
												}
											}
						}else{
											var mensaje_correo=sep[0];
											var id_us=sep[2];
											var id_pe=sep[3];
											var estado_del_usuario=sep[4]; 
											// alert(data);
											if(estado_del_usuario=="UE"){
												alert("¡Usuario existente, favor de cambiarlo!");
												if(id_us=="NA"){ 
													// alert("¡Se guardo con exito! ");
													window.location='?modulo=personal&accion=editar&id_pe='+id_pe;
												}else{
													// alert("¡Se guardo con exito! ");
													window.location='?modulo=personal&accion=editar&id='+id_us+'&id_pe='+id_pe;
												}
											}else{
												if(id_us=="NA"){ 
													alert("¡Se guardó con éxito! ");
													alert(mensaje_correo);
													window.location.href = "index.php?modulo=personal";
												}else{
													alert("¡Se guardó con éxito! ");
													alert(mensaje_correo);
													window.location.href = "index.php?modulo=personal";
												}
											}
						}
						
						},error:function(data){
						alert("Error: "+data);
					}
				});
			}
			
		}else{
			alert("¡Debes elegir un paquete disponible!");
		}
	});
	$("#btn_editar").click(function(){	
		var ck;
	if( $("#checkboxInd").prop("checked") ){
		ck = 'True';
	}
	else{
		ck='False';
	}
	var estatus_usuario=$("#text_activo").val();
	
	var valor_sin_formato = $("#sald").val().replace("$","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","");
		$("#sald").val(valor_sin_formato);
		var valor_sin_formato2=$("#com").val().replace("%","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","").replace(" ","");
		$("#com").val(valor_sin_formato2);
	
			 if($("#user").val().length < 1){
							var fg = new FormData(document.getElementById("rhh"));
							var get_usr='<?php echo $_GET['id'];?>';
							var get_per='<?php echo $_GET['id_pe'];?>';
							$.ajax({
								url:"modulos/perfiles_procesos.php?accion=2&getid="+get_usr+"&getper="+get_per+"&ck="+ck,
								type:"POST",
								data:fg,
								contentType: false,
								processData: false,
								success:function(data){
									
								var sep=data.split("{division}");
								if(sep[0]=="CO"){
												// var mensaje_correo=sep[0];
												var id_us=sep[1];
												var id_pe=sep[2]; 
												var estado_del_usuario=sep[3]; 
												var usuarios_s=sep[4]; 
												// var union_datos=id_us+"<>"+id_pe;
												// alert(data);
													if(estado_del_usuario=="UE"){
														// alert(usuarios_s);
														alert("¡Usuario existente, favor de cambiarlo!");
														if(id_us=="NA"){
														// alert("¡Se guardo con exito! ");
														window.location='?modulo=personal&accion=editar&id_pe='+id_pe;
														}else{
															// alert("¡Se guardo con exito! ");
															window.location='?modulo=personal&accion=editar&id='+id_us+'&id_pe='+id_pe;
														}
													}else{
														// alert(usuarios_s);
														if(id_us=="NA"){
														alert("¡Se guardó con éxito! ");
														// alert(mensaje_correo);
														window.location.href = "index.php?modulo=personal";
														}else{
															alert("¡Se guardó con éxito! ");
															// alert(mensaje_correo);
															window.location.href = "index.php?modulo=personal";
														}
													}
								}else{
										var mensaje_correo=sep[0];
										var id_us=sep[2];
										var id_pe=sep[3]; 
										var estado_del_usuario=sep[4]; 
										var usuarios_s=sep[5]; 
										// var union_datos=id_us+"<>"+id_pe;
										// alert(data);
											if(estado_del_usuario=="UE"){
												// alert(usuarios_s);
												alert("¡Usuario existente, favor de cambiarlo!");
												if(id_us=="NA"){
												// alert("¡Se guardo con exito! ");
												window.location='?modulo=personal&accion=editar&id_pe='+id_pe;
												}else{
													// alert("¡Se guardo con exito! ");
													window.location='?modulo=personal&accion=editar&id='+id_us+'&id_pe='+id_pe;
												}
											}else{
												// alert(usuarios_s);
												if(id_us=="NA"){
												alert("¡Se guardó con éxito! ");
												alert(mensaje_correo);
												window.location.href = "index.php?modulo=personal";
												}else{
													alert("¡Se guardó con éxito! ");
													alert(mensaje_correo);
													window.location.href = "index.php?modulo=personal";
												} 
											}
								}
								
									
								},error:function(data){
								alert("Error: "+data);
							}
						});	
			 }else if( estatus_usuario == 1 && $("#correo_djss").val().length < 1){
				 alert("¡Correo obligatorio al crear usuario!");
			 }else if( estatus_usuario == 1 && $("#pass").val().length < 1){
				 alert("¡Debe introducir una contraseña!");
			 }else if( estatus_usuario == 1 && ( (paqueteActual!=$("#paquete_select").val() || $("#paquete_select").val()==0) && $("#cu_select").val() < 1 )){
				 alert("¡Debes elegir un paquete disponible!");
			 }else{
						var fg = new FormData(document.getElementById("rhh"));
						var get_usr='<?php echo $_GET['id'];?>';
						var get_per='<?php echo $_GET['id_pe'];?>';
						$.ajax({
							url:"modulos/perfiles_procesos.php?accion=2&getid="+get_usr+"&getper="+get_per+"&ck="+ck,
							type:"POST",
							data:fg,
							contentType: false,
							processData: false,
							success:function(data){
								var sep=data.split("{division}");
								if(sep[0]=="CO"){
												
												// var mensaje_correo=sep[0];
												var id_us=sep[1];
												var id_pe=sep[2]; 
												var estado_del_usuario=sep[3]; 
												var usuarios_s=sep[4]; 
												// var union_datos=id_us+"<>"+id_pe;
												// alert(data);
													if(estado_del_usuario=="UE"){
														// alert(usuarios_s);
														alert("¡Usuario existente, favor de cambiarlo!");
														if(id_us=="NA"){
														// alert("¡Se guardo con exito! ");
														window.location='?modulo=personal&accion=editar&id_pe='+id_pe;
														}else{
															// alert("¡Se guardo con exito! ");
															window.location='?modulo=personal&accion=editar&id='+id_us+'&id_pe='+id_pe;
														}
													}else{
														// alert(usuarios_s);
														if(id_us=="NA"){
														alert("¡Se guardó con éxito! ");
														// alert(mensaje_correo);
														window.location.href = "index.php?modulo=personal";
														}else{
															alert("¡Se guardó con éxito! ");
															// alert(mensaje_correo);
															window.location.href = "index.php?modulo=personal";
														}
													}
								}else{
													var sep=data.split("{division}");
													var mensaje_correo=sep[0];
													var id_us=sep[2];
													var id_pe=sep[3]; 
													var estado_del_usuario=sep[4]; 
													var usuarios_s=sep[5]; 
													// var union_datos=id_us+"<>"+id_pe;
													// alert(data);
														if(estado_del_usuario=="UE"){
															// alert(usuarios_s);
															alert("¡Usuario existente, favor de cambiarlo!");
															if(id_us=="NA"){
															// alert("¡Se guardo con exito! ");
															window.location='?modulo=personal&accion=editar&id_pe='+id_pe;
															}else{
																// alert("¡Se guardo con exito! ");
																window.location='?modulo=personal&accion=editar&id='+id_us+'&id_pe='+id_pe;
															}
														}else{
															// alert(usuarios_s);
															if(id_us=="NA"){
															alert("¡Se guardó con éxito! ");
															alert(mensaje_correo);
															// window.location.href = "index.php?modulo=personal";
															}else{
																alert("¡Se guardó con éxito! ");
																alert(mensaje_correo);
																// window.location.href = "index.php?modulo=personal";
															}
														}
								}
							
								
							},error:function(data){
							alert("Error: "+data);
						}
					});
			 }
	
	});
	/////////////////////Envio de datos ajax form data Final//////////////////
}
</script>
<style>

.btn_detalle{
	float: right;
	border: 1px solid black;
	padding: 1px 1px 1px 1px;
	cursor: pointer;
	background-color: #AEC6CF;
	
}
.btn_det_cc{
	float: right;
	border: 1px solid black;
	padding: 1px 1px 1px 1px;
	cursor: pointer;
	background-color: #AEC6CF;
	
}
.pestaña_activa{
	background-color: #2196f3;
	color: white;
	border: 3px solid black;
}
.pestaña_inactiva{
	background-color: #CFCFC4;
	border: 2px solid black;
}
.btn_inactivo{
	color: black;
}
.empleados_m1,.empleados_m2,.empleados_m3,.usuarios_m1,.usuarios_m2,.usuarios_m3{
	cursor: pointer;
}
#btn_ver{
	border: 2px solid black;
}
 #sortable1, #sortable2, #sortable3, #sortable4,#sortable5, #sortable6, #almacen_ini, #almacen_fin, #cent_cost_ini, #cent_cost_fin {

   // border: 1px solid #eee;
   border: 1px solid #2b323a;;
    width: 500px;
    min-height: 200px;
    list-style-type: none;
    margin-left: 0;
    padding: 5px 0 0 0;
    float: left;
    margin-right: 10px;
  }
  #sortable1 li, #sortable2 li, #sortable3 li, #sortable4 li,#sortable5 li, #sortable6 li, #almacen_ini li, #almacen_fin li, #cent_cost_ini li, #cent_cost_fin li {
    margin: 0 5px 5px 5px;
    padding: 5px;
    font-size: 1.5em;
    width: 230px;
  }
  #btn_guardar{
	  padding: 10px 10px 10px 10 px;
  }
  .hinp{
	  color: black;
  }
  .hinpsel{
	  color: white;
  }
  .hinpsel:focus{
	  color: black;
  }
  input[type="file"]
{
    font-size:16px;
}
</style>
<!-- Clases -->
<script>
	$( "#btn_save" ).addClass( "btn ink-reaction btn-raised btn-primary" );
	$( "#btn_borrar" ).addClass( "btn ink-reaction btn-raised btn-primary" );
	$( "#btn_backlist" ).addClass( "btn ink-reaction btn-raised btn-primary" );
	$( "#reset" ).addClass( "btn ink-reaction btn-raised btn-primary" );
</script>
<!-- Clases -->