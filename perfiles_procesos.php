<?php
header('Content-Type: text/html; charset=ISO-8849-1'); 
require('include/fpdf/fpdf.php');
include('funcionmandirl_email.php');

$bd=$_POST['bd'];
$accion=$_GET['accion'];
$conexion=mysqli_connect('localhost','sp417','mgrasAS7102',$bd);
/* 
echo"
Base de datos: $bd ||
";
if($conexion){
	echo"Conectado ||";
}else{
	echo"No conectado ||";
}
 */
/////////////Empleados inicio////////////////////////////////////////////////////////
//Empleados datos generales //////////////////////////
$nombre=utf8_decode($_POST['nombre']);
$apellidop=utf8_decode($_POST['apaterno']);
$apellidom=utf8_decode($_POST['amaterno']);
$ncompleto=$nombre." ".$apellidop." ".$apellidom;
$curp=$_POST['curp'];
$rfc=$_POST['rfc'];
$codpos=$_POST['codpos'];//codigopostal
$estado=$_POST['estado'];
$municipio=$_POST['municipio'];
$colonia=$_POST['colonia'];
$calle=$_POST['calle'];
$next=$_POST['next'];//Numero exterior
$nint=$_POST['nint'];//Numero interior
$telc=$_POST['telc'];//Telefono
$telcel=$_POST['telcel'];//Celular
$ecivil=$_POST['ecivil'];
$vivienda=$_POST['vivienda'];
$hijos=$_POST['hijos'];
$nhijos=$_POST['nhijos'];
$npersonal=$_POST['npersonal'];
$sexo=$_POST['sexo'];
$correo=$_POST['correo'];
$mbaja=$_POST['mbaja'];
$sucursal=$_POST['suc'];
$elegible=$_POST['eleg'];
$recontratable=$_POST['recon'];
$llam_emergencia=$_POST['llam_emergencia'];

$fnac=$_POST['fnac'];//Fecha de nacimiento
if(empty($_POST['fnac'])){$fnacf="";}else{
	$date =date_create($fnac);
	$fnacf = date_format($date, 'Y-m-d');
}
$tsang=$_POST['tsang'];//Tipo de sangre
$puesto=$_POST['puesto'];
$fechaA=$_POST['fechaalta'];
if(empty($_POST['fechaalta'])){$fechaAf="";}else{
	$date2 =date_create($fechaA);
	$fechaAf = date_format($date2, 'Y-m-d');
}
$fechaB=$_POST['fechabaja'];
if(empty($_POST['fechabaja'])){$fechaBf="";}else{
	$date3 =date_create($fechaB);	
	$fechaBf = date_format($date3, 'Y-m-d');
}

/* 
echo"
|||||||||Datos generales empleados||||||||||||
Nombre: $nombre ||
Apellido p: $apellidop ||
Apellido m: $apellidom ||
CURP: $curp ||
RFC: $rfc ||
Codigop: $codpos ||
Estado: $estado ||
Municipio: $municipio ||
Colonia: $colonia ||
Calle: $calle ||
Numero exterior: $next ||
Numero interior: $nint ||
Telefono c: $telc ||
Celular: $telcel ||
Correo: $correo ||
Fecha nacimiento: $fnac ||
Tipo de sagre: $tsang ||
Puesto: $puesto ||
FechaA: $fechaA ||
FechaB: $fechaB ||
FechaAF: $fechaAf ||
FechaBF: $fechaBf ||
||||||||||||||||||||||||||||||||||||||
";
  */
//empleados datos laborales//////////////////
$escmax=$_POST['escmax'];//escolaridad maxima
$sald=$_POST['sald'];//Salario diario
$com=$_POST['com'];//comision
$pet=$_POST['pet'];//periodo de trabajo
$tipo=$_POST['tipo'];
$diad=$_POST['diad'];//dia de descanso
$area=$_POST['area'];
$dep=$_POST['dep'];//departamento
$zona=$_POST['zona'];
$tp=$_POST['tp'];//Tipo de pago
$dp=$_POST['dp'];//Dia de pago
$te=$_POST['te'];//Tipo de empleado
$fingbf=$_POST['fing'];//Fecha de ingreso
list($dia1,$mes1,$anio1)=explode("-",$fingbf);
$fing=$anio1."-".$mes1."-".$dia1;
$fsalbf=$_POST['fsal'];//Fecha de salida
list($dia2,$mes2,$anio2)=explode("-",$fsalbf);
$fsal=$anio2."-".$mes2."-".$dia2;
$vlbf=$_POST['vl'];//vencimiento de licencia
list($dia3,$mes3,$anio3)=explode("-",$vlbf);
$vl=$anio3."-".$mes3."-".$dia3;
$hen=$_POST['hen'];//Hora de entrada
$hsa=$_POST['hsa'];//hora de salida
$noimss=$_POST['noimss'];
$nacionalidad=$_POST['nacionalidad'];

// echo"
// |||||||||Datos laborales empleados||||||||||||
// Escolaridad: $escmax ||
// Saldo diario: $sald ||
// Comision: $com ||
// Periodo de trabajo: $pet ||
// Eventual: $tipo ||
// Dia de descanso: $diad ||
// Area: $area ||
// Departamento $dep ||
// Zona: $zona ||
// Tipo de pago: $tp ||
// Dia de pago: $dp ||
// Tipo de empleado: $te ||
// Fecha de ingreso: $fing ||
// Fecha de egreso: $fsal ||
// VencimientoL: $vl ||
// Hora entrada: $hen ||
// Hora salida: $hsa ||
// ||||||||||||||||||||||||||||||| 
// ";

//empleados documentos
/* if(empty($_FILES['imss']['name'])){}else{	//IMSS
$ruta_log= "archivosRH/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_IMSS_'.$_FILES['imss']['name'];
copy($_FILES['imss']['tmp_name'],$destino_log);
$imss=$destino_log;	
}

if(empty($_FILES['ife']['name'])){}else{	//IFE
$ruta_log= "archivosRH/"; 
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_IFE_'.$_FILES['ife']['name'];
copy($_FILES['ife']['tmp_name'],$destino_log);
$ife=$destino_log;	
}

if(empty($_FILES['lic']['name'])){}else{	//Licencia
$ruta_log= "archivosRH/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_Licencia-'.$_FILES['lic']['name'];
copy($_FILES['lic']['tmp_name'],$destino_log);
$lic=$destino_log;	
}

if(empty($_FILES['cn']['name'])){}else{	//Certificado de nacimiento
$ruta_log= "archivosRH/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_Certtificado_'.$_FILES['cn']['name'];
copy($_FILES['cn']['tmp_name'],$destino_log);
$cn=$destino_log;	
} */

if($accion=="1"){//Guardar empleados
	$insertar_personal="insert personal (nombre,apellido_paterno,apellido_materno,curp,rfc,cps,estado,municipio,colonia,calle,numeroExterior,numeroInterior,telefonoCasa,telefonoCelular,correo,fechaNacimiento,tiposangre,escolaridad,sueldodiario,comision,periodo_t,eventual,dia_descanso,area,departamento,zona,tipopago,diapago,tipoempleado,fechaIngreso,fechaSalida,fechavlicencia,h1,h2,puesto,fechaAlta,fechaBaja,activo,ecivil,vivienda,hijos,nhijos,npersonal,sexo,mbaja,sucursal,elegible,recontratable,llam_emergencia,nacionalidad,noimss) values('$nombre','$apellidop','$apellidom','$curp','$rfc','$codpos','$estado','$municipio','$colonia','$calle','$next','$nint','$telc','$telcel','$correo','$fnacf','$tsang','$escmax','$sald','$com','$pet','$tipo','$diad','$area','$dep','$zona','$tp','$dp','$te','$fing','$fsal','$vl','$hen','$hsa','$puesto','$fechaAf','$fechaBf','1','$ecivil','$vivienda','$hijos','$nhijos','$npersonal','$sexo','$mbaja','$sucursal','$elegible','$recontratable','$llam_emergencia','$nacionalidad','$noimss')";
	// echo $insertar_personal;
	mysqli_query($conexion,$insertar_personal);

	$buscar_registro_guardado_empleado="select idPersonal from personal order by idPersonal DESC limit 1";
	$res_brge=mysqli_query($conexion,$buscar_registro_guardado_empleado);
	$r_brge=mysqli_fetch_array($res_brge);
	$id_personal=$r_brge['idPersonal'];
}else{//Editar empleados

	if(empty($_GET['getper'])){
			$idus=$_GET['getid'];
			$buscar_id_personal="select idPersonal from personal where id_usuario='$idus'";
			$res_bip=mysqli_query($conexion,$buscar_id_personal);
			$r_bip=mysqli_fetch_array($res_bip);
			$id_personal=$r_bip['idPersonal'];
			if(empty($r_bip['idPersonal'])){//noexiste empleado
				$insertar_personal="insert personal (nombre,apellido_paterno,apellido_materno,curp,rfc,cps,estado,municipio,colonia,calle,numeroExterior,numeroInterior,telefonoCasa,telefonoCelular,correo,fechaNacimiento,tiposangre,escolaridad,sueldodiario,comision,periodo_t,eventual,dia_descanso,area,departamento,zona,tipopago,diapago,tipoempleado,fechaIngreso,fechaSalida,fechavlicencia,h1,h2,puesto,fechaAlta,fechaBaja,activo,id_usuario,ecivil,vivienda,hijos,nhijos,npersonal,sexo,mbaja,sucursal,elegible,recontratable,llam_emergencia,nacionalidad,noimss) values('$nombre','$apellidop','$apellidom','$curp','$rfc','$codpos','$estado','$municipio','$colonia','$calle','$next','$nint','$telc','$telcel','$correo','$fnacf','$tsang','$escmax','$sald','$com','$pet','$tipo','$diad','$area','$dep','$zona','$tp','$dp','$te','$fing','$fsal','$vl','$hen','$hsa','$puesto','$fechaAf','$fechaBf','1','$idus','$ecivil','$vivienda','$hijos','$nhijos','$npersonal','$sexo','$mbaja','$sucursal','$elegible','$recontratable','$llam_emergencia','$nacionalidad','$noimss')";
				// echo $insertar_personal;
				mysqli_query($conexion,$insertar_personal);

				$buscar_registro_guardado_empleado="select idPersonal from personal order by idPersonal DESC limit 1";
				$res_brge=mysqli_query($conexion,$buscar_registro_guardado_empleado);
				$r_brge=mysqli_fetch_array($res_brge);
				$id_personal=$r_brge['idPersonal'];
				
				$actualizar_usuarios="update usuarios set personal='$id_personal' where usuarioid='$idus'";
				mysqli_query($conexion,$actualizar_usuarios);
			}
	}else{
			$id_personal=$_GET['getper'];
	}
	$estado_activo=$_POST['text_activo'];
	// $fecha_baja=$_POST['fechabaja'];
	$comentario=$_POST['comentarios'];
	
	$update_personal="update personal set  nombre='$nombre',apellido_paterno='$apellidop',apellido_materno='$apellidom',curp='$curp',rfc='$rfc',cps='$codpos',estado='$estado',municipio='$municipio',colonia='$colonia',calle='$calle',numeroExterior='$next',numeroInterior='$nint',telefonoCasa='$telc',telefonoCelular='$telcel',correo='$correo',fechaNacimiento='$fnacf',tiposangre='$tsang',escolaridad='$escmax',sueldodiario='$sald',comision='$com',periodo_t='$pet',eventual='$tipo',dia_descanso='$diad',area='$area',departamento='$dep',zona='$zona',tipopago='$tp',diapago='$dp',tipoempleado='$te',fechaIngreso='$fing',fechaSalida='$fsal',fechavlicencia='$vl',h1='$hen',h2='$hsa',puesto='$puesto',fechaAlta='$fechaAf',fechaBaja='$fechaBf',activo='$estado_activo',comentarios='$comentario',ecivil='$ecivil',vivienda='$vivienda',hijos='$hijos',nhijos='$nhijos',npersonal='$npersonal',sexo='$sexo',mbaja='$mbaja',sucursal='$sucursal',elegible='$elegible',recontratable='$recontratable',llam_emergencia='$llam_emergencia',nacionalidad='$nacionalidad',noimss='$noimss' where idPersonal='$id_personal'";
	mysqli_query($conexion,$update_personal);
}

//empleados documentos uploads/sp417_auwi_01/images/rh
if(empty($_FILES['imss']['name'])){}else{	//IMSS
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_IMSS_'.$_FILES['imss']['name'];
// copy($_FILES['imss']['tmp_name'],$destino_log);
move_uploaded_file($_FILES['imss']['tmp_name'],$destino_log);
$imss=$destino_log;	

$update_archivos="update personal set imss='$imss' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['ife']['name'])){}else{	//IFE
$ruta_log= "../../uploads/".$bd."/docs/rh/"; 
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_IFE_'.$_FILES['ife']['name'];
copy($_FILES['ife']['tmp_name'],$destino_log);
$ife=$destino_log;	

$update_archivos="update personal set ife='$ife' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['lic']['name'])){}else{	//Licencia
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_Licencia-'.$_FILES['lic']['name'];
copy($_FILES['lic']['tmp_name'],$destino_log);
$lic=$destino_log;	

$update_archivos="update personal set licencia='$lic' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['cn']['name'])){}else{	//Certificado de nacimiento
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_Certificado_'.$_FILES['cn']['name'];
copy($_FILES['cn']['tmp_name'],$destino_log);
$cn=$destino_log;	

$update_archivos="update personal set certificado='$cn' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['foto']['name'])){}else{	//foto 
$ruta_log= "../../uploads/".$bd."/images/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_Foto_'.$_FILES['foto']['name'];
copy($_FILES['foto']['tmp_name'],$destino_log);
$foto=$destino_log;	

$update_archivos="update personal set foto='$foto' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['curp_file']['name'])){}else{	//CURP FILE
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_curp_file_'.$_FILES['curp_file']['name'];
copy($_FILES['curp_file']['tmp_name'],$destino_log);
$curp_file=$destino_log;	

$update_archivos="update personal set curp_file='$curp_file' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['cdomicilio']['name'])){}else{	//Comprobante de domicilio
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_cdomicilio_'.$_FILES['cdomicilio']['name'];
copy($_FILES['cdomicilio']['tmp_name'],$destino_log);
$cdomicilio=$destino_log;	

$update_archivos="update personal set cdomicilio='$cdomicilio' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['creferencia']['name'])){}else{	//Carta referencia
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_creferencia_'.$_FILES['creferencia']['name'];
copy($_FILES['creferencia']['tmp_name'],$destino_log);
$creferencia=$destino_log;	

$update_archivos="update personal set creferencia='$creferencia' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['cretencion']['name'])){}else{	//Carta retencion
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_cretencion_'.$_FILES['cretencion']['name'];
copy($_FILES['cretencion']['tmp_name'],$destino_log);
$cretencion=$destino_log;	

$update_archivos="update personal set cretencion='$cretencion' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['rfc_file']['name'])){}else{	//RFC FILE
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_rfc_file_'.$_FILES['rfc_file']['name'];
copy($_FILES['rfc_file']['tmp_name'],$destino_log);
$rfc_file=$destino_log;	

$update_archivos="update personal set rfc_file='$rfc_file' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['cestudios']['name'])){}else{	//Comprobante de estudios
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_cestudios_'.$_FILES['cestudios']['name'];
copy($_FILES['cestudios']['tmp_name'],$destino_log);
$cestudios=$destino_log;	

$update_archivos="update personal set cestudios='$cestudios' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['Fotografia2']['name'])){}else{	//Comprobante de estudios
$ruta_log= "../../uploads/".$bd."/images/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_Fotografia2_'.$_FILES['Fotografia2']['name'];
copy($_FILES['Fotografia2']['tmp_name'],$destino_log);
$Fotografia2=$destino_log;	

$update_archivos="update personal set Fotografia2='$Fotografia2' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['Contrato']['name'])){}else{	//Comprobante de estudios
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log); 
$destino_log = $ruta_log.$nombre.'_Contrato_'.$_FILES['Contrato']['name'];
copy($_FILES['Contrato']['tmp_name'],$destino_log);
$Contrato=$destino_log;	

$update_archivos="update personal set Contrato='$Contrato' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['Renuncia']['name'])){}else{	//Comprobante de estudios
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_Renuncia_'.$_FILES['Renuncia']['name'];
copy($_FILES['Renuncia']['tmp_name'],$destino_log);
$Renuncia=$destino_log;	

$update_archivos="update personal set Renuncia='$Renuncia' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['Otros']['name'])){}else{	//Comprobante de estudios
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_Otros_'.$_FILES['Otros']['name'];
copy($_FILES['Otros']['tmp_name'],$destino_log);
$Otros=$destino_log;	

$update_archivos="update personal set Otros='$Otros' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);
}

if(empty($_FILES['FileContrato']['name'])){}else{	//Contrato
$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$nombre.'_Contrato_'.$_FILES['FileContrato']['name'];
$nombre_archivo=$_FILES['FileContrato']['name'];
copy($_FILES['FileContrato']['tmp_name'],$destino_log);
$archivo_contrato=$destino_log;	
$fechafirmasf = $_POST['FechaContrato'];
list($dia,$mes,$año)=explode("/", $fechafirmasf);
$fechafirma=$año."-".$mes."-".$dia;
$update_archivos="update personal set archivo_contrato='$archivo_contrato' where idPersonal='$id_personal'";
mysqli_query($conexion,$update_archivos);

$insert_detalle_contratos="insert into  detalle_contratos (nombre, fecha_subida, fecha_firma, id_relacion) values('$nombre_archivo', now(), '$fechafirma', '$id_personal')";
	mysqli_query($conexion, $insert_detalle_contratos);
}
// echo"
// Id de registro guardado: $id_personal ||
// ";
/////////////Empleados Final////////////////////////////////////////////////////////
/////////////Usuarios inicio////////////////////////////////////////////////////////
$user=$_POST['user'];//usuario
$pass=$_POST['pass'];//password
$perfil=$_POST['select_perfil'];//perfil
$paquete=$_POST['paquete_select'];
if(empty($user)){
	$id_de_usuario="NA";
}else{
	if($accion=="1"){//Agregar usuarios
		$hoy=date("Y-m-d");
	$buscar_en_system="select Usuariotipo,No_empresa,Empresa from system limit 1";
	$res_bes=mysqli_query($conexion,$buscar_en_system);
	$r_bes=mysqli_fetch_array($res_bes);
	$usuario_tipo=$r_bes['Usuariotipo'];
	$id_empresa=(int)$r_bes['No_empresa'];
	$no_empresa=$r_bes['No_empresa'];
	$nombre_empresa=$r_bes['Empresa'];
	$usuario_final=$user."@".$no_empresa;
	
	////////Verificar si usuario ya existe Inicio////////////
	$buscar_si_usuario_existe="select usuario from usuarios where usuario='$usuario_final'";
	$res_bsue=mysqli_query($conexion,$buscar_si_usuario_existe);
	$r_bsue=mysqli_num_rows($res_bsue);
	if($r_bsue==0){
		
	
	////////Verificar si usuario ya existe Final////////////
	
	$insertar_usuario="insert into usuarios (usuario,usuariopas,usuarionombre,usuariotipo,activo,active,fecha,id_empresa,Telefono,Celular,foliouser,foliorem,personal,usuariocorreo,Id_paquete,puesto_usu,perfil_usu) values('$usuario_final','$pass','$ncompleto','$usuario_tipo','1','1','$hoy','$id_empresa','$telc','$telcel','F','R','$id_personal','$correo','$paquete','$puesto','$perfil')";
	mysqli_query($conexion,$insertar_usuario);
	
	actualizar_paquetes($paquete,$conexion);
	// mandar_aplicacion($correo,$usuario_final,$pass,$no_empresa);
	///////////////////Correo inicio///////////////////////////////
	list($usuario,$empresa)=explode("@",$usuario_final);
    $mensaje = "Bienvenida (o)<br><br> 
						Auwi es un conjunto de soluciones móviles y WEB que se comunican entre sí, permitiéndote un mayor control e información de tu negocio.
						\n<br><br>
						\n<br>Usuario: ".$usuario."
						\n<br>Contraseña:".$pass."
						\n<br>Número de empresa:".$no_empresa."
						<br><br>Para ingresar al sistema hacer clic en la siguiente liga: <a href='https://sistema.auwi.mx/session.php'>AUWIMX</a>";
   
	
     $asunto = "AUWIMX usuario y contraseña";
   
    //nombre del archivo
    
	$contactos_correo=$correo;
	// $contactos_correo=$correo_cliente;
    //$mail->AddAddress("edgar.hernandez@acesistemas.com");
      if( $contactos_correo ){
        $contactos_correo_ex = explode(";", $contactos_correo);
        foreach ($contactos_correo_ex  as $correos) {
            $ml_s = $correos;
            mail_mandrill($ml_s, $asunto, $mensaje );
        }
    }
	///////////////////Correo FIN///////////////////////////////
	
	$buscar_ultimo_usuario="select usuarioid from usuarios order by usuarioid desc limit 1";
	$res_buu=mysqli_query($conexion,$buscar_ultimo_usuario);
	$r_buu=mysqli_fetch_array($res_buu);
	$id_de_usuario=$r_buu['usuarioid'];
	crearEditarCuentaNoBancaria($conexion,1,$id_de_usuario,$ncompleto);
	/* 
	echo"
	Id usuario: $id_de_usuario ||
	";
	 */
	 $actualizar_personal="update personal set id_usuario='$id_de_usuario' where idPersonal='$id_personal'";
	 mysqli_query($conexion,$actualizar_personal);
	 
	 $abc = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
			$a = 0;
			$b = 0;
			$c = 0;
			$n = $id_de_usuario;

			// $n=726;
			// echo $n.' ';

			//////Primera Letra//////////
			for($i=0; $i < 27; $i++)
			{
				$ask1 = 676 * $i;
				if( $n <= $ask1 ){
					$a = $i - 1;
					$n2 = $ask1 - $n;
					$i = 27;
				} else{
					
				}
			}
			//////Segunda Letra///////////
			for( $k = 0; $k < 27; $k++ ){
				$ask2 = 26 * $k;
				if( $n2 <= $ask2 ){
					$b = $k - 1;
					$n3 = $ask2 - $n2;
					$k = 27;
				} else{
					
				}
			}
			//////Tercera Letra//////////
			for( $j = 0; $j < 27; $j++ ){
				$ask3 = 1 * $j;
				if( $n3 <= $ask3 ){
					$c = $j - 1;
					$j = 27;
				}else{
					
				}
			}
			/////Resultados////////////
			if( $a < 0){
				$a = 25;
			} 
			if($b < 0){
				$b = 25;
			} 
			if($c < 0){
				$c = 25;
			}

			$cod_usuario = $abc[$a] . $abc[$b] . $abc[$c];
			
			$actualizar_usuarios="update usuarios set cod_usuario='$cod_usuario' where usuarioid='$id_de_usuario'";
			mysqli_query($conexion,$actualizar_usuarios);
			
			$asignar_perfil="insert into auwimx_miembros (Usuario,Grupo) values('$id_de_usuario','$perfil')";
			mysqli_query($conexion,$asignar_perfil);
			
			$conn_control=mysqli_connect('localhost','sp417','mgrasAS7102','sp417_auwi_control');
			
			$insertar_usuario_control="insert into usuarios (Empresa,No_empresa,usuario,usuariopas,Nombre,Fecha,DB,usuariocorreo,Telefono,Celular,id_empresa,Id_usuario_rel) values('$nombre_empresa','$no_empresa','$usuario_final','$pass','$ncompleto','$hoy','$bd','$correo','$telc','$telcel','$no_empresa','$id_de_usuario')";
			mysqli_query($conn_control,$insertar_usuario_control);
			
			    $estatus_usuario="NE";
			}else{
				$estatus_usuario="UE";
			}
	}else{//Editar usuarios
			$estado_activo_user=(int)$_POST['text_activo'];
			if(empty($_GET['getid'])){//No existia usuario hay que crearlo
						
					$buscar_usuario_en_personal="select id_usuario from personal where idPersonal='$id_personal'";
					$res_buep=mysqli_query($conexion,$buscar_usuario_en_personal);
					$r_buep=mysqli_fetch_array($res_buep);
					if(empty($r_buep['id_usuario'])){
								$hoy=date("Y-m-d");
					$buscar_en_system="select Usuariotipo,No_empresa,Empresa from system limit 1";
					$res_bes=mysqli_query($conexion,$buscar_en_system);
					$r_bes=mysqli_fetch_array($res_bes);
					$usuario_tipo=$r_bes['Usuariotipo'];
					$id_empresa=(int)$r_bes['No_empresa'];
					$no_empresa=$r_bes['No_empresa'];
					$nombre_empresa=$r_bes['Empresa'];
					$usuario_final=$user."@".$no_empresa;
					
					$buscar_si_usuario_existe="select usuario from usuarios where usuario='$usuario_final'";
					$res_bsue=mysqli_query($conexion,$buscar_si_usuario_existe);
					$r_bsue=mysqli_num_rows($res_bsue);
					if($r_bsue==0){
						
					$insertar_usuario="insert into usuarios (usuario,usuariopas,usuarionombre,usuariotipo,activo,active,fecha,id_empresa,Telefono,Celular,foliouser,foliorem,personal,usuariocorreo,Id_paquete,puesto_usu,perfil_usu) values('$usuario_final','$pass','$ncompleto','$usuario_tipo','1','1','$hoy','$id_empresa','$telc','$telcel','F','R','$id_personal','$correo','$paquete','$puesto','$perfil')";
					mysqli_query($conexion,$insertar_usuario);
					
					actualizar_paquetes($paquete,$conexion);
					// mandar_aplicacion($correo,$usuario_final,$pass,$no_empresa);
					///////////////////Correo inicio///////////////////////////////
	list($usuario,$empresa)=explode("@",$usuario_final);
    $mensaje = "Bienvenida (o)<br><br> 
						Auwi es un conjunto de soluciones móviles y WEB que se comunican entre sí, permitiéndote un mayor control e información de tu negocio.
						\n<br><br>
						\n<br>Usuario: ".$usuario."
						\n<br>Contraseña:".$pass."
						\n<br>Número de empresa:".$no_empresa."
						<br><br>Para ingresar al sistema hacer clic en la siguiente liga: <a href='https://sistema.auwi.mx/session.php'>AUWIMX</a>";
   
	
     $asunto = "AUWIMX usuario y contraseña";
   
    //nombre del archivo
    
	$contactos_correo=$correo;
	// $contactos_correo=$correo_cliente;
    //$mail->AddAddress("edgar.hernandez@acesistemas.com");
      if( $contactos_correo ){
        $contactos_correo_ex = explode(";", $contactos_correo);
        foreach ($contactos_correo_ex  as $correos) {
            $ml_s = $correos;
            mail_mandrill($ml_s, $asunto, $mensaje );
        }
    }
	///////////////////Correo FIN///////////////////////////////
					$buscar_ultimo_usuario="select usuarioid from usuarios order by usuarioid desc limit 1";
					$res_buu=mysqli_query($conexion,$buscar_ultimo_usuario);
					$r_buu=mysqli_fetch_array($res_buu);
					$id_de_usuario=$r_buu['usuarioid'];
					crearEditarCuentaNoBancaria($conexion,1,$id_de_usuario,$ncompleto);
					/* 
					echo"
					Id usuario: $id_de_usuario ||
					";
					 */
					 $actualizar_personal="update personal set id_usuario='$id_de_usuario' where idPersonal='$id_personal'";
					 mysqli_query($conexion,$actualizar_personal);
					 
					 $abc = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
							$a = 0;
							$b = 0;
							$c = 0;
							$n = $id_de_usuario;

							// $n=726;
							// echo $n.' ';

							//////Primera Letra//////////
							for($i=0; $i < 27; $i++)
							{
								$ask1 = 676 * $i;
								if( $n <= $ask1 ){
									$a = $i - 1;
									$n2 = $ask1 - $n;
									$i = 27;
								} else{
									
								}
							}
							//////Segunda Letra///////////
							for( $k = 0; $k < 27; $k++ ){
								$ask2 = 26 * $k;
								if( $n2 <= $ask2 ){
									$b = $k - 1;
									$n3 = $ask2 - $n2;
									$k = 27;
								} else{
									
								}
							}
							//////Tercera Letra//////////
							for( $j = 0; $j < 27; $j++ ){
								$ask3 = 1 * $j;
								if( $n3 <= $ask3 ){
									$c = $j - 1;
									$j = 27;
								}else{
									
								}
							}
							/////Resultados////////////
							if( $a < 0){
								$a = 25;
							} 
							if($b < 0){
								$b = 25;
							} 
							if($c < 0){
								$c = 25;
							}

							$cod_usuario = $abc[$a] . $abc[$b] . $abc[$c];
							
							$actualizar_usuarios="update usuarios set cod_usuario='$cod_usuario' where usuarioid='$id_de_usuario'";
							mysqli_query($conexion,$actualizar_usuarios);
							
							$asignar_perfil="insert into auwimx_miembros (Usuario,Grupo) values('$id_de_usuario','$perfil')";
							mysqli_query($conexion,$asignar_perfil);
							
							$conn_control=mysqli_connect('localhost','sp417','mgrasAS7102','sp417_auwi_control');
							
							$insertar_usuario_control="insert into usuarios (Empresa,No_empresa,usuario,usuariopas,Nombre,Fecha,DB,usuariocorreo,Telefono,Celular,id_empresa,Id_usuario_rel) values('$nombre_empresa','$no_empresa','$usuario_final','$pass','$ncompleto','$hoy','$bd','$correo','$telc','$telcel','$no_empresa','$id_de_usuario')";
							mysqli_query($conn_control,$insertar_usuario_control);
							$estatus_usuario="NE";
							}else{
								$estatus_usuario="UE";
							}	
					}else{	
							$id_de_usuario=$r_buep['id_usuario'];
							$buscar_en_system="select No_empresa from system limit 1";
							$res_bes=mysqli_query($conexion,$buscar_en_system);
							$r_bes=mysqli_fetch_array($res_bes);
							$no_empresa=$r_bes['No_empresa'];
							$usuario_final=$user."@".$no_empresa;
							
							
							$buscar_si_usuario_existe="select usuario from usuarios where usuario='$usuario_final'";
							$res_bsue=mysqli_query($conexion,$buscar_si_usuario_existe);
							$r_bsue=mysqli_num_rows($res_bsue);
							if($r_bsue==0){
							
							$buscar_en_usuarios="select usuario,usuariopas from usuarios where usuarioid='$id_de_usuario'";
							$res_beu=mysqli_query($conexion,$buscar_en_usuarios);
							$r_beu=mysqli_fetch_array($res_beu);
							$usuario_anterior=$r_beu['usuario'];
							$password_anterior=$r_beu['usuariopas'];
							
							if($estado_activo_user==1){
								
							}else{
								$paquete="null";
							}
							
							$update_usuario="update  usuarios set  usuario='$usuario_final',usuariopas='$pass',usuarionombre='$ncompleto',Telefono='$telc',Celular='$telcel',usuariocorreo='$correo',activo='$estado_activo_user',active='$estado_activo_user',Id_paquete='$paquete', puesto_usu = '$puesto', perfil_usu = '$perfil' where usuarioid='$id_de_usuario'";
							mysqli_query($conexion,$update_usuario);
							
							if($usuario_anterior!=$usuario_final || $password_anterior!=$pass){
								// mandar_aplicacion($correo,$usuario_final,$pass,$no_empresa);
								///////////////////Correo inicio///////////////////////////////
	list($usuario,$empresa)=explode("@",$usuario_final);
    $mensaje = "Bienvenida (o)<br><br> 
						Auwi es un conjunto de soluciones móviles y WEB que se comunican entre sí, permitiéndote un mayor control e información de tu negocio.
						\n<br><br>
						\n<br>Usuario: ".$usuario."
						\n<br>Contraseña:".$pass."
						\n<br>Número de empresa:".$no_empresa."
						<br><br>Para ingresar al sistema hacer clic en la siguiente liga: <a href='https://sistema.auwi.mx/session.php'>AUWIMX</a>";
   
	
     $asunto = "AUWIMX usuario y contraseña";
   
    //nombre del archivo
    
	$contactos_correo=$correo;
	// $contactos_correo=$correo_cliente;
    //$mail->AddAddress("edgar.hernandez@acesistemas.com");
      if( $contactos_correo ){
        $contactos_correo_ex = explode(";", $contactos_correo);
        foreach ($contactos_correo_ex  as $correos) {
            $ml_s = $correos;
            mail_mandrill($ml_s, $asunto, $mensaje );
        }
    }
	///////////////////Correo FIN///////////////////////////////
								}
							
							actualizar_paquetes($paquete,$conexion);
							
							crearEditarCuentaNoBancaria($conexion,2,$id_de_usuario,$ncompleto);
							
								$update_perfil="update  auwimx_miembros set Grupo ='$perfil' where Usuario='$id_de_usuario'";
								mysqli_query($conexion,$update_perfil);
							
							$conn_control=mysqli_connect('localhost','sp417','mgrasAS7102','sp417_auwi_control');
							
							$update_usuario_control="update  usuarios set usuario='$usuario_final',usuariopas='$pass',Nombre='$ncompleto',usuariocorreo='$correo',Telefono='$telc',Celular='$telcel' where usuario='$usuario_anterior'";
							mysqli_query($conn_control,$update_usuario_control);
							$estatus_usuario="NE";
							}else{
								$estatus_usuario="UE";
							}	
					}
					
			}else{//Ya existia usuario
				$id_de_usuario=$_GET['getid'];
				
				$buscar_en_system="select No_empresa from system limit 1";
				$res_bes=mysqli_query($conexion,$buscar_en_system);
				$r_bes=mysqli_fetch_array($res_bes);
				$no_empresa=$r_bes['No_empresa'];
				$usuario_final=$user."@".$no_empresa;
				
				$buscar_en_usuarios="select usuario,usuariopas from usuarios where usuarioid='$id_de_usuario'";
				$res_beu=mysqli_query($conexion,$buscar_en_usuarios);
				$r_beu=mysqli_fetch_array($res_beu);
				$usuario_anterior=$r_beu['usuario'];
				$password_anterior=$r_beu['usuariopas'];
				
				if($usuario_anterior==$usuario_final){
					
					if($estado_activo_user==1){
								
							}else{
								$paquete="null";
							}
				
				$update_usuario="update  usuarios set  usuario='$usuario_final',usuariopas='$pass',usuarionombre='$ncompleto',Telefono='$telc',Celular='$telcel',usuariocorreo='$correo',activo='$estado_activo_user',active='$estado_activo_user',Id_paquete='$paquete', puesto_usu = '$puesto', perfil_usu = '$perfil' where usuarioid='$id_de_usuario'";
				mysqli_query($conexion,$update_usuario);
					
					if($usuario_anterior!=$usuario_final || $password_anterior!=$pass){
								// mandar_aplicacion($correo,$usuario_final,$pass,$no_empresa);
								///////////////////Correo inicio///////////////////////////////
	list($usuario,$empresa)=explode("@",$usuario_final);
    $mensaje = "Bienvenida (o)<br><br> 
						Auwi es un conjunto de soluciones móviles y WEB que se comunican entre sí, permitiéndote un mayor control e información de tu negocio.
						\n<br><br>
						\n<br>Usuario: ".$usuario."
						\n<br>Contraseña:".$pass."
						\n<br>Número de empresa:".$no_empresa."
						<br><br>Para ingresar al sistema hacer clic en la siguiente liga: <a href='https://sistema.auwi.mx/session.php'>AUWIMX</a>";
   
	
     $asunto = "AUWIMX usuario y contraseña";
   
    //nombre del archivo
    
	$contactos_correo=$correo;
	// $contactos_correo=$correo_cliente;
    //$mail->AddAddress("edgar.hernandez@acesistemas.com");
      if( $contactos_correo ){
        $contactos_correo_ex = explode(";", $contactos_correo);
        foreach ($contactos_correo_ex  as $correos) {
            $ml_s = $correos;
            mail_mandrill($ml_s, $asunto, $mensaje );
        }
    }
	///////////////////Correo FIN///////////////////////////////
								}
					
					actualizar_paquetes($paquete,$conexion);
					crearEditarCuentaNoBancaria($conexion,2,$id_de_usuario,$ncompleto);
					
					$update_perfil="update  auwimx_miembros set Grupo ='$perfil' where Usuario='$id_de_usuario'";
					mysqli_query($conexion,$update_perfil);
				
				$conn_control=mysqli_connect('localhost','sp417','mgrasAS7102','sp417_auwi_control');
				
				$update_usuario_control="update  usuarios set usuario='$usuario_final',usuariopas='$pass',Nombre='$ncompleto',usuariocorreo='$correo',Telefono='$telc',Celular='$telcel' where usuario='$usuario_anterior'";
				mysqli_query($conn_control,$update_usuario_control);
				}else{	
						$buscar_en_usuarios="select usuario,usuariopas from usuarios where usuarioid='$id_de_usuario'";
						$res_beu=mysqli_query($conexion,$buscar_en_usuarios);
						$r_beu=mysqli_fetch_array($res_beu);
						$usuario_anterior=$r_beu['usuario'];
						$password_anterior=$r_beu['usuariopas'];
							
						$buscar_si_usuario_existe="select usuario from usuarios where usuario='$usuario_final'";
						$res_bsue=mysqli_query($conexion,$buscar_si_usuario_existe);
						$r_bsue=mysqli_num_rows($res_bsue);
						if($r_bsue==0){
							
							if($estado_activo_user==1){
								
							}else{
								$paquete="null";
							}
							
						$update_usuario="update  usuarios set  usuario='$usuario_final',usuariopas='$pass',usuarionombre='$ncompleto',Telefono='$telc',Celular='$telcel',usuariocorreo='$correo',activo='$estado_activo_user',active='$estado_activo_user',Id_paquete='$paquete', puesto_usu = '$puesto', perfil_usu = '$perfil' where usuarioid='$id_de_usuario'";
						mysqli_query($conexion,$update_usuario);
						
						if($usuario_anterior!=$usuario_final || $password_anterior!=$pass){
								// mandar_aplicacion($correo,$usuario_final,$pass,$no_empresa);
								///////////////////Correo inicio///////////////////////////////
	list($usuario,$empresa)=explode("@",$usuario_final);
    $mensaje = "Bienvenida (o)<br><br> 
						Auwi es un conjunto de soluciones móviles y WEB que se comunican entre sí, permitiéndote un mayor control e información de tu negocio.
						\n<br><br>
						\n<br>Usuario: ".$usuario."
						\n<br>Contraseña:".$pass."
						\n<br>Número de empresa:".$no_empresa."
						<br><br>Para ingresar al sistema hacer clic en la siguiente liga: <a href='https://sistema.auwi.mx/session.php'>AUWIMX</a>";
   
	
     $asunto = "AUWIMX usuario y contraseña";
   
    //nombre del archivo
    
	$contactos_correo=$correo;
	// $contactos_correo=$correo_cliente;
    //$mail->AddAddress("edgar.hernandez@acesistemas.com");
      if( $contactos_correo ){
        $contactos_correo_ex = explode(";", $contactos_correo);
        foreach ($contactos_correo_ex  as $correos) {
            $ml_s = $correos;
            mail_mandrill($ml_s, $asunto, $mensaje );
        }
    }
	///////////////////Correo FIN///////////////////////////////
								}
						
						actualizar_paquetes($paquete,$conexion);
						crearEditarCuentaNoBancaria($conexion,2,$id_de_usuario,$ncompleto);
						
							$update_perfil="update  auwimx_miembros set Grupo ='$perfil' where Usuario='$id_de_usuario'";
							mysqli_query($conexion,$update_perfil);
						
						$conn_control=mysqli_connect('localhost','sp417','mgrasAS7102','sp417_auwi_control');
						
						$update_usuario_control="update  usuarios set usuario='$usuario_final',usuariopas='$pass',Nombre='$ncompleto',usuariocorreo='$correo',Telefono='$telc',Celular='$telcel' where usuario='$usuario_anterior'";
						mysqli_query($conn_control,$update_usuario_control);
						$estatus_usuario="NE";
					}else{
						$estatus_usuario="UE";
					}	
				}
			}
		
	}
	
			
			
}
echo "CO{division}".$id_de_usuario."{division}".$id_personal."{division}".$estatus_usuario."{division}"."Usuario anterior: ".$usuario_anterior." Usuario final: ".$usuario_final;
/* echo"
|||||||||||||||||Datos Usuario general|||||||||||||||||
Usuario: $user ||
Password: $pass ||
Perfil: $perfil ||
|||||||||||||||||||||||||||||
"; */
function actualizar_paquetes($paquete,$conn){
	$buscar_en_paquetes_comprados="select Usuarios_comprados,Usuarios_asignados from paquetes_comprados where Id='$paquete'";
	$res_bepc=mysqli_query($conn,$buscar_en_paquetes_comprados);
	$r_bepc=mysqli_fetch_array($res_bepc);
	if(empty($r_bepc['Usuarios_comprados'])){
		
	}else{
		$uc=(int)$r_bepc['Usuarios_comprados'];
		
		$buscar_en_usuariosP="select count(usuario) as total from usuarios where Id_paquete='$paquete'";
		$res_beup=mysqli_query($conn,$buscar_en_usuariosP);
		$r_beup=mysqli_fetch_array($res_beup);
		$total_asignados=(int)$r_beup['total'];
		
		$actualizar="update paquetes_comprados set Usuarios_asignados='$total_asignados' where Id='$paquete'";
		mysqli_query($conn,$actualizar);
	}
}
function crearEditarCuentaNoBancaria($conn,$tipo_mov,$usuario,$ncompleto){
		$hoy=date("Y-m-d");
	switch($tipo_mov){
		case 1://Crear cuenta no bancaria
				$crearCuenta="insert into flujoefectivo (tipocta,nombre,saldo,limitesaldo,ingreso,egreso,encargado,fechaalta,usuario_id) values('2','$ncompleto (Cuenta no bancaria)','0','40000','0','0','$usuario','$hoy','$usuario')";
				mysqli_query($conn,$crearCuenta);
		break;
		case 2://Editar cuenta no bancaria
				$editarCuenta="update flujoefectivo set nombre='$ncompleto (Cuenta no bancaria)' where usuario_id='$usuario'";
				mysqli_query($conn,$editarCuenta);
		break;
		default: //Sin acciones
		break;
	}
}
/////////////Usuarios Final////////////////////////////////////////////////////////
function mandar_aplicacion($correo_dir,$usuario_final,$pass,$no_empresa){
				
				
				/* 
				$to=$correo;
				$subject= "AUWIMX Usuario y contraseña";
				$headers.="CC:info@acesistemas.com \r\n";
				$headers.= 'MIME-Version: 1.0' . "\r\n";
				$headers.= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$headers.= 'From: info@acesistemas.com';
				$body = "Bienvenida (o)<br><br> 
						Auwi es un conjunto de soluciones móviles y WEB que se comunican entre sí, permitiéndote un mayor control e información de tu negocio.
						\n<br><br>
						\n<br>Usuario: ".$usuario."
						\n<br>Contraseña:".$pass."
						\n<br>Número de empresa:".$no_empresa."
						<br><br>Para ingresar al sistema hacer clic en la siguiente liga: <a href='https://sistema.auwi.mx/session.php'>AUWIMX</a>
						";
				$send=mail($to, $subject, $body, $headers);
				if($send){
					echo"Su usuario y contraseña han sido enviados a su correo{division}";
				}else{
					echo"Problemas al enviar el correo{division}";//Correo fallido
				} */
				///////////////////Madrindil function/////////////////////////////
				//MAIL-----------------------------------------------------


    //usuario de destino y cuerpo del mensaje
	list($usuario,$empresa)=explode("@",$usuario_final);
    $mensaje = "Bienvenida (o)<br><br> 
						Auwi es un conjunto de soluciones móviles y WEB que se comunican entre sí, permitiéndote un mayor control e información de tu negocio.
						\n<br><br>
						\n<br>Usuario: ".$usuario."
						\n<br>Contraseña:".$pass."
						\n<br>Número de empresa:".$no_empresa."
						<br><br>Para ingresar al sistema hacer clic en la siguiente liga: <a href='https://sistema.auwi.mx/session.php'>AUWIMX</a>";
   
	
     $asunto = "AUWIMX usuario y contraseña";
   
    //nombre del archivo
    
	$contactos_correo=$correo_dir;
	// $contactos_correo=$correo_cliente;
    //$mail->AddAddress("edgar.hernandez@acesistemas.com");
      if( $contactos_correo ){
        $contactos_correo_ex = explode(";", $contactos_correo);
        foreach ($contactos_correo_ex  as $correo) {
            $ml_s = $correo;
           $send= mail_mandrill($ml_s, $asunto, $mensaje );
        }
    }
	
	 $mensaje2 = "Mensaje: Reporte estado de cuenta <br>
				 Enviado a: $contactos_correo
				";
	if($send){
					echo"Su usuario y contraseña han sido enviados a su correo{division}";
				}else{
					echo"Problemas al enviar el correo{division}";//Correo fallido
				}
	// $correo_adicional="dayan.silva@acesistemas.com";
    // if( $correo_adicional ){
        // $correo_adic_ex = explode(";", $correo_adicional);
        // foreach ($correo_adic_ex as $c){
            // $ml_snd = $c;
            // mail_mandrill($ml_snd, $asunto, $mensaje2, $adjunto, "estados_de_cuenta", "pdf" );
				// }
			// }
		// }
   
   // }

    // header ("Location: ../index.php?modulo=listado_autorizacion_compras&accion=ver");

//MAIL-----------------------------------------------------
//header ("Location: ../index.php?modulo=aceptacion_compras&accion=editar&id=122");
				
}
?>