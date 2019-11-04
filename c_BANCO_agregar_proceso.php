<?php

 $nom=json_decode($_POST['chain']);
 $regimen=json_decode($_POST['chain2']);
$fechai=json_decode($_POST['chain3']);
$fechaf=json_decode($_POST['chain4']);
$razon=json_decode($_POST['chain5']);
// // echo "Nombre:".$nom;
// print_r($nom);
// echo $_GET['accion'];
switch($_GET['accion']){
	case 'agregar'://Insertar
		$insert="insert into c_BANCO (c_BANCO,Descripcion,nombre_RazonSocial, fecha_inVig,feha_finVig) values('$regimen','$nom','$razon','$fechai','$fechaf')";
		mysqli_query($conn,$insert) or die(mysqli_error($conn));
	break;
	case 'editar'://editar
			$id=$_GET['id'];
		$update="UPDATE c_BANCO SET c_BANCO='$regimen',Descripcion='$nom',nombre_RazonSocial='$razon',fecha_inVig='$fechai',fecha_finVig='$fechaf' where id = '$id'";
		mysqli_query($conn,$update) or die(mysqli_error($conn));
	break;
	case 'eliminar'://eliminar
	$id=$_GET['id'];
		$eliminar="DELETE FROM c_BANCO where id ='$id'"; 
		mysqli_query($conn,$eliminar) or die(mysqli_error($conn));
	break;

}

echo "true";
?>