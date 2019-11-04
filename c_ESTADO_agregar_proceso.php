<?php

 $nom=json_decode($_POST['chain']);
 $regimen=json_decode($_POST['chain2']);
$estado=json_decode($_POST['chain3']);

// // echo "Nombre:".$nom;
// print_r($nom);
// echo $_GET['accion'];
switch($_GET['accion']){
	case 'agregar'://Insertar
		$insert="insert into c_ESTADO (c_Estado,c_Pais,Nombre_Estado) values('$regimen','$nom','$estado')";
		mysqli_query($conn,$insert) or die(mysqli_error($conn));
	break;
	case 'editar'://editar
			$id=$_GET['id'];
		$update="UPDATE c_ESTADO SET c_Estado='$regimen',c_Pais='$nom',Nombre_Estado='$estado'where id = '$id'";
		mysqli_query($conn,$update) or die(mysqli_error($conn));
	break;
	case 'eliminar'://eliminar
	$id=$_GET['id'];
		$eliminar="DELETE FROM c_ESTADO where id ='$id'"; 
		mysqli_query($conn,$eliminar) or die(mysqli_error($conn));
	break;

}

echo "true";
?>