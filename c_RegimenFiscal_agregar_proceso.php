<?php

 $nom=json_decode($_POST['chain']);
 $regimen=json_decode($_POST['chain2']);
$fechai=json_decode($_POST['chain3']);
$fechaf=json_decode($_POST['chain4']);
$fisica=json_decode($_POST['chain5']);
$motal=json_decode($_POST['chain6']);
// // echo "Nombre:".$nom;
// print_r($nom);
// echo $_GET['accion'];
switch($_GET['accion']){
	case 'agregar'://Insertar
		$insert="insert into c_RegimenFiscal (c_RegimenFiscal,Descripcion,fisica,Motal,fecha_InVigencia,fecha_FinVigencia) values('$regimen','$nom','$fisica','$motal','$fechai','fechaf')";
		mysqli_query($conn,$insert) or die(mysqli_error($conn));
	break;
	case 'editar'://editar
			$id=$_GET['id'];
		$update="UPDATE c_RegimenFiscal 
		SET c_RegimenFiscal='$regimen',Descripcion='$nom', fisica='$fisica', Motal='$motal',fecha_InVigencia='$fechai',fecha_FinVigencia='$fechaf' where id = '$id'";
		mysqli_query($conn,$update) or die(mysqli_error($conn));
	break;
	case 'eliminar'://eliminar
	$id=$_GET['id'];
		$eliminar="DELETE FROM c_RegimenFiscal where id ='$id'"; 
		mysqli_query($conn,$eliminar) or die(mysqli_error($conn));
	break;

}

echo "true";
?>