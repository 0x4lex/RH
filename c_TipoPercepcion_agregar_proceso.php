<?php

 $nom=json_decode($_POST['chain']);
 $regimen=json_decode($_POST['chain2']);
$fechai=json_decode($_POST['chain3']);
$fechaf=json_decode($_POST['chain4']);
// // echo "Nombre:".$nom;
// print_r($nom);
// echo $_GET['accion'];
switch($_GET['accion']){
	case 'agregar'://Insertar
		$insert="insert into c_TipoPercepcion (c_TipoPercepcion,Descripcion,Fecha_InVig,Fecha_FinVig) values('$regimen','$nom','$fechai','$fechaf')";
		mysqli_query($conn,$insert) or die(mysqli_error($conn));
	break;
	case 'editar'://editar
			$id=$_GET['id'];
		$update="UPDATE c_TipoPercepcion SET c_TipoPercepcion='$regimen',Descripcion='$nom',Fecha_InVig='$fechai',Fecha_FinVig='$fechaf' where id = '$id'";
		mysqli_query($conn,$update) or die(mysqli_error($conn));
	break;
	case 'eliminar'://eliminar
	$id=$_GET['id'];
		$eliminar="DELETE FROM c_TipoPercepcion where id ='$id'"; 
		mysqli_query($conn,$eliminar) or die(mysqli_error($conn));
	break;

}

echo "true";
?>