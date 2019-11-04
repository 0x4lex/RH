<?php
$modulo=$_GET['modulo'];
$listacampo['c_BANCO'] = array('id','c_BANCO','Descripcion','Nombre_razonSocial','fecha_inVig', 'fecha_finVig');
$listatitulo['c_BANCO'] = array('Id','Banco','Descripcion','Razon social', 'Fecha de inicio de  vigencia', 'Fecha fin de vigencia');
$listacampo['c_ESTADO'] = array('id','c_ESTADO', 'c_Pais','Nombre_Estado');
$listatitulo['c_ESTADO'] = array( 'Id','Estado', 'Pais', 'Estado de Mexico');
$listacampo['c_OrigenRecurso'] = array('id','c_OrigenRecurso','Descripcion');
$listatitulo['c_OrigenRecurso'] = array( 'Id','Recuerdo origen','Descripcion');
$listacampo['c_Periodicidad'] = array('id','c_Periodicidad','Descripcion','Fecha_inVigencia','Fecha_FinVigencia');
$listatitulo['c_Periodicidad'] = array('Id','Periodicidad de pago', 'Descripcion',' Fecha inicial','Fecha final');
$listacampo['c_RegimenFiscal'] = array('id','c_RegimenFiscal','Descripcion','fisica','Motal','fecha_InVigencia','fecha_FinVigencia');
$listatitulo['c_RegimenFiscal']=array('Id','Regimen Fiscal','Descripcion', 'Persona fisica' ,'Persona moral','Fecha inicial','Fecha vigencia');
$listacampo['c_TipoContrato'] = array('id','c_TipoContrato','Descripcion');
$listatitulo['c_TipoContrato']= array('Id','c_TipoContrato','Descripcion');
$listacampo['c_TipoDeduccion']= array('id','c_TipoDeduccion','Descripcion','Fecha_InVigencia','Fecha_FinVigencia');
$listatitulo['c_TipoDeduccion'] = array('Id','c_TipoDeduccion','Descripcion', 'Fecha inicial','Fecha final');
$listacampo['c_TipoHoras'] = array('id','c_TipoHoras', 'Descripcion');
$listatitulo['c_TipoHoras'] = array('Id','c_TipoHoras',' Descripcion');
$listacampo['c_TipoIncapacidad'] = array('id','c_TipoIncapacidad', 'Descripcion');
$listatitulo['c_TipoIncapacidad'] = array('Id','c_TipoIncapacidad', 'Descripcion');
$listacampo['c_TipoJornada'] = array('id','c_TipoJornada','Descripcion');
$listatitulo['c_TipoJornada'] = array('Id','c_TipoJornada','Descripcion');
$listacampo['c_TipoNomina']  = array('id','c_TipoNomina', 'Descripcion');
$listatitulo['c_TipoNomina'] = array('Id','c_TipoNomina','Descripcion');
$listacampo['c_TipoOtroPago'] = array('id','c_TipoOtroPago','Descripcion','Fecha_InVigencia','Fecha_FinVigencia');
$listatitulo['c_TipoOtroPago'] = array('Id','c_TipoOtroPago','Descripcion','Fecha inicial', 'Fecha final');
$listacampo['c_TipoPercepcion'] = array('id','c_TipoPercepcion','Descripcion','Fecha_InVig','Fecha_FinVig');
$listatitulo['c_TipoPercepcion'] = array('Id','c_TipoPercepcion','Descripcion','Fecha inicial','Fecha final');
$listacampo['c_TipoRegimen'] = array('id','c_TipoRegimen','Descripcion','Fecha_InVig','Fecha_FinVig');
$listatitulo['c_TipoRegimen'] = array('Id','c_TipoRegimen','Descripcion','Fecha inicial', 'Fecha final');
$listacampo['c_RiesgoPuesto'] = array('id','c_RiesgoPuesto','Descripcion','Fecha_InVig','Fecha_FinVig');
$listatitulo['c_RiesgoPuesto'] = array('Id','c_RiesgoPuesto','Descripcion','Fecha inical','Fecha final');


switch($modulo){
	case 'c_BANCO':
	$modulonom = "Catalogo de bancos";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_BANCO'];
	$titulos = $listatitulo['c_BANCO'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;




	
	



	case 'c_ESTADO':
	$modulonom = "Catalogo de Estado";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_ESTADO'];
	$titulos = $listatitulo['c_ESTADO'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;


case 'c_OrigenRecurso':
	$modulonom = "Catalogo de Origen recuerso";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_OrigenRecurso'];
	$titulos = $listatitulo['c_OrigenRecurso'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;
case 'c_Periodicidad':
	$modulonom = "Catalogo de Periodicidad";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_Periodicidad'];
	$titulos = $listatitulo['c_Periodicidad'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;
case 'c_RegimenFiscal':
	$modulonom = "Catalogo de Regimen fiscal";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_RegimenFiscal'];
	$titulos = $listatitulo['c_RegimenFiscal'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;
	
	case 'c_TipoContrato':
	$modulonom = "Catalogo de Regimen fiscal";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_TipoContrato'];
	$titulos = $listatitulo['c_TipoContrato'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;

		case 'c_TipoDeduccion':
	$modulonom = "Tipo de deduccion";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_TipoDeduccion'];
	$titulos = $listatitulo['c_TipoDeduccion'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;


			case 'c_TipoHoras':
	$modulonom = "Tipo de horas";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_TipoHoras'];
	$titulos = $listatitulo['c_TipoHoras'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;



				case 'c_TipoIncapacidad':
	$modulonom = "Tipo de Incapacidad";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_TipoIncapacidad'];
	$titulos = $listatitulo['c_TipoIncapacidad'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;



				case 'c_TipoJornada':
	$modulonom = "Tipo de jornada";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_TipoJornada'];
	$titulos = $listatitulo['c_TipoJornada'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;



				case 'c_TipoNomina':
	$modulonom = "Tipo de nomina";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_TipoNomina'];
	$titulos = $listatitulo['c_TipoNomina'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;



				case 'c_TipoOtroPago':
	$modulonom = "Tipo de otro pago";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_TipoOtroPago'];
	$titulos = $listatitulo['c_TipoOtroPago'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;




				case 'c_TipoPercepcion':
	$modulonom = "Tipo de percepcion";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_TipoPercepcion'];
	$titulos = $listatitulo['c_TipoPercepcion'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;



				case 'c_TipoRegimen':
	$modulonom = "Tipo de Regimen";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_TipoRegimen'];
	$titulos = $listatitulo['c_TipoRegimen'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;



				case 'c_RiesgoPuesto':
	$modulonom = "Tipo de Riesgo de puesto";
	$rs11 =  mysqli_query($conn,"SELECT campos, titulos FROM listar WHERE usuario = '$usuario' AND modulo = '$modulo'");
	$datas11 = mysqli_fetch_array($rs11);
	if($datas11['campos']!=""){
		$campos = explode(",",$datas11['campos']);
		$titulos = explode(",",$datas11['titulos']);
	}
	else {
	$campos = $listacampo['c_RiesgoPuesto'];
	$titulos = $listatitulo['c_RiesgoPuesto'];
	}
	$condicion = "WHERE ";
	foreach($campos as $datt){
		if(isset($_GET[$datt])&&$_GET[$datt]!=""){
			$operacion = $_GET['cond-'.$datt];
			$operador = array('IGUAL'=>'=','NOESIGUAL'=>'!=','MAYORQUE'=>'>','MAYORIGUALQUE'=>'>=','MENORIGUALQUE'=>'<=','MENORQUE'=>'<');
			$valor = (strpos($datt,'fecha')!==false)?date("Y-m-d",strtotime($_GET[$datt])):$_GET[$datt];
			if($operacion=='ENTRE') {
				$valor = str_replace(' Y ','\' AND \'',str_replace(' y ','\' AND \'',$valor));
				$condicion .= " ($datt BETWEEN '{$valor}') AND ";
			}
			elseif($operacion=='CONTIENE'){
				$condicion .= " ($datt LIKE '{$valor}%' OR $datt LIKE '%{$valor}%' OR $datt LIKE '%{$valor}') AND ";
			}
			else{
				$valor =(is_numeric($valor))?$valor:'\''.$valor.'\''; 
				$condicion .= " $datt {$operador[$operacion]} {$valor} AND ";
			}
		}
	}
	$condicion .= " 1 = 1 ";
	if(isset($_GET['order'])) $condicion .= " ORDER BY ".$_GET['order']." ".$_GET['by']."";
	
	if(isset($_POST['accion'])&&$_POST['accion']=='borrar'){
	mysqli_query($conn,"DELETE FROM $modulo WHERE id = {$_POST['id']}");
	echo "Eliminado";
	exit();
	}
	break;

}



?>