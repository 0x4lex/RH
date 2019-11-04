<?php 
header('Content-Type: text/html; charset=utf8');
// $bd='sp417_auwi_01';
$bd= base64_decode($_GET["bd"]);

// $bd = base64_decode($_SESSION['DB']);

 $condb = mysqli_connect("localhost", "sp417", "mgrasAS7102", $bd);
 mysqli_set_charset($condb,"utf8");
$query="SELECT contrato FROM system";
$ejec =mysqli_query($condb,$query);
$arreg=mysqli_fetch_array($ejec);
$dato=$arreg['contrato'];
// if($dato){
// 	echo'si entro';
// }
// 	else{
// 		echo'nelprro';
// 	}

$ruta = file_get_contents("../../uploads/".$bd."/docs/rh/".$dato);
echo nl2br(utf8_encode($ruta));
$texto = fopen($ruta,"r");

echo utf8_decode($texto);






 ?>