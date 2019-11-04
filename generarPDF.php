<?php
header('Content-Type: text/html; charset=utf8');
require('fpdf/fpdf.php');
$bd=base64_decode($_GET["bd"]);
 $idpersonall=(int)$_GET["id"];
 $condb = mysqli_connect("localhost", "sp417", "mgrasAS7102", $bd);
 mysqli_set_charset($condb,"utf8");
$query="SELECT contrato FROM system";
$ejec =mysqli_query($condb,$query);
$arreg=mysqli_fetch_array($ejec);
$dato=$arreg['contrato'];
$estadoEMP=$arreg['Estado'];
$genero="SELECT * from Genero";
$querygen =mysqli_query( $condb,$genero);
$gen=mysqli_fetch_array($querygen);
$generoemp=$gen['Descripcion'];



$EC="SELECT * FROM estado_civil";
$ecquery= mysqli_query($condb,$EC);
$esci=mysqli_fetch_array($ecquery);
$estadocivil=$exci['Descripcion'];


$sqlogo="SELECT * from system";
$execdos =mysqli_query( $condb,$sqlogo);
$rows=mysqli_fetch_array($execdos);
$empresa=$rows['Empresa'];

			$archivo=file_get_contents("../../uploads/".$bd."/docs/rh/".$dato); 
				$pdf = new FPDF();
		$pdf->AddPage();


	$sql="SELECT t1.sueldo_b, t1.nombre, t1.calle, t1.colonia, t1.numeroExterior, t1.municipio, t1.estado, t1.apellido_paterno, t1.apellido_materno, t1.area, t2.puesto, t1.h1, t1.h2,t1.FechaInicial,t1.Dias_duracion,t1.Fecha_Final, t1.cps FROM personal t1 left join puestos t2 on t1.puesto=t2.id where t1.idPersonal='".$idpersonall."'";

$exec =mysqli_query( $condb,$sql);
$row=mysqli_fetch_array($exec);
// $FechaInicial=$row['FechaInicial'];
// $Dias_duracion=$row['Dias_duracion'];
// $Fecha_Final=$row['Fecha_Final'];
// $cps=$row['cps'];
$FechaInicial=$_GET['FechaInicial'];
$Dias_duracion=$_GET['Dias_duracion'];
$ck=$_GET['ck'];
list($diai,$mesi,$añoi)=explode('/',$FechaInicial);
 $FechaInicial=$añoi.'-'.$mesi.'-'.$diai;
if ($_GET["ck"]=='True') {
   $Fecha_Final="indefinido";
} else {
   $Fecha_Final= date('Y-m-d', strtotime($FechaInicial. ' + ' .$Dias_duracion .'days'));
}

$salario=$row['sueldo_b'];
$nomemp=$row['nombre'];
$domempleado=$row['calle'];
$colonia=$row['colonia'];
$numeroExterior=$row['numeroExterior'];
$municipio=$row['municipio'];
$estado=$row['estado'];
$apellido_materno=$row['apellido_materno'];
$apellido_paterno=$row['apellido_paterno'];
$puesto=$row['puesto'];
$empresa=$rows['Empresa'];
$calle_empresa=$rows['Calle'];
$num_empresa=$rows['Numero_exterior'];
$colonia_empresa=$rows['Colonia'];
$estado_empresa=$rows['Estado'];
$cp_empresa=$rows['Codigo_postal'];
$patron=$rows['Representante'];
$nacionalidad=$row['nacionalidad'];
$fechaNacimiento=$row['fechaNacimiento'];
$NSS=$row['noimss'];
$rfc=$row['rfc'];
$curp=$row['curp'];
$hEntrada=$row['h1'];
$hSalida=$row['h2'];

		$fecha=date("d") . " DEL " . date("m") . " DE " . date("Y");

		$buscar=array("*FECHA*", "*NOMEMP*","*APPAT*","*APMAT*",  "*DOMEMPLEADO*","*COLONIA*","*NUMEROEXTERIOR*","*MUNICIPIO*","*ESTADO*", 
			"*SALARIO*","*PUESTO*","*EMPRESA*","*PATRON*","*CALLEPAT*","*NUMPAT*","*COLPAT*","*CIUDPAT*","*CPPAT*","*NACIONALIDAD*","*FECHANACIMIENTO*","*NSS*","*RFCEMP*","*CURPEMP*","*GENEMP","*ESTCIVIL*","*ESTADOEMP*","*HENTRADA*","*HSALIDA*","*FECHAINICIAL*",
			"*DIASDURACION*","*FECHAFINAL*","*CPS*");


		$reemplazar=array($fecha, $nomemp, $apellido_paterno,$apellido_materno ,  $domempleado,$colonia,$numeroExterior,$municipio,$estado,  $salario, $puesto, $empresa, $patron, $calle_empresa, $num_empresa, $colonia_empresa, $ciudad_empresa, $cp_empresa, $nacionalidad,
			$fechaNacimiento,$NSS,$rfc,$curp,$generoemp,$estadocivil,$estadoEMP,$hEntrada,$hSalida,$FechaInicial,$Dias_duracion,$Fecha_Final,$cps);
		$reemp=str_replace($buscar, $reemplazar, $archivo);

					list($acuerdos,$firmas) = explode("*AF*", $reemp);
					$convert = explode("\n", $acuerdos);
					for($i=0;$i<count($convert);$i++)  
					{
					  
					    $saltodelinea = nl2br($convert[$i]);
					    $pdf->SetX(5);
					    $pdf->SetFont('Arial','',5.5);
					    $pdf->MultiCell(200,6,iconv('UTF-8', 'windows-1252', " ". $saltodelinea." " ), 0,"FJ",0);
					  
					}		
					$pdf->SetX(5);
					    $pdf->SetFont('Arial','',5.5);
					    $pdf->MultiCell(200,6,iconv('UTF-8', 'windows-1252', " ". $firmas." " ), 0,"C",0);
					  
				
					$pdf->Output();
	
?>
