<?php 

$modulo = $_GET['modulo'];
$accion = $_GET['accion'];
$id = $_GET['id'];


if(empty($_FILES['file_upload']['name'])){}else{  //Carta retencion
$bd = $_POST['rdb'];
$conexion = mysqli_connect("localhost", "sp417","mgrasAS7102", $bd);

$ruta_log= "../../uploads/".$bd."/docs/rh/";  
opendir($ruta_log);
$destino_log = $ruta_log.$_FILES['file_upload']['name'];
copy($_FILES['file_upload']['tmp_name'],$destino_log);
$file_upload=$_FILES['file_upload']['name'];  

$update_archivos="update system set contrato='$file_upload'";
mysqli_query($conexion,$update_archivos);

// if($conexion){ 
//  echo'si se conecto a '.$bd.': ' .$update_archivos;
// }
// else{
//  echo' no se conecto';
// }
exit();
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
              <!--<li><a href="?modulo=viajes">Viajes</a></li>//regresa an anterior-->
              <li><a>Recursos humanos</a></li>
              <li class="active">Datos Maestros</li>
              <li class="active">
                <?php if( $accion == "editar" ){ ?>
                Editar Contrato
                <?php }else if( $accion == "ver" ){ ?>
                Ver Contrato
                <?php }else  if( $accion == "agregar" ){ ?>
                Añadir Contrato
                <?php }else  if( $accion == "borrar" ){ ?>
                Borrar Contrato
                <?php } ?>
              </li>
            </ol>
          </div>
          <div class="section-body contain-lg">
            <div class="row">

              <!-- BEGIN ADD CONTACTS FORM -->                        
              <div class="col-md-12">
                <div class="card">
                  <div class="card-head style-primary"></div>               
                  <form method='POST'  enctype="multipart/form-data"  id='rh' class='form' runat="server">

                    <!-- BEGIN DEFAULT FORM ITEMS -->

                    <div class="card-body style-primary form-inverse">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="row">

                            <div class="col-md-4">
                              
                              <label for="teqdes">Archivo del Contrato</label>
                              <div class="form-group floating-label">
                                <input type="file" id="file_upload" name="file_upload" class="form-control" />
                                <input type="hidden" id="rdb" name="rdb" value="<?php echo $_SESSION['DB'];?>"><br>
<table class="table table-dark" style='color:white;' >
  <thead>
    <tr>
      <th scope="col" >Comando</th>
      <th scope="col">igual</th>
      <th scope="col">Significado</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>*FECHA*</td>
      <td>=</td>
      <td>La fecha de hoy</td>
    </tr> 

    <tr>

      <td>*NOMEMP*</td>
      <td>=</td>
      <td>Nombre del empleado</td>
    </tr>
    <tr>
      <td>*APPAT*</td>
      <td>=</td>
      <td>Apellido paterno del empleado</td>
    </tr>
        <tr>
      <td>*APMAT*</td>
      <td>=</td>
      <td>Apellido materno del empleado</td>
    </tr>
        <tr>
      <td>*DOMEMPLEADO*</td>
      <td>=</td>
      <td>Calle del empleado</td>
    </tr>
        <tr>
      <td>*COLONIA*</td>
      <td>=</td>
      <td>Colonia del empleado</td>
    </tr>
        <tr>
      <td>*NUMEROEXTERIOR*</td>
      <td>=</td>
      <td>Número exterior de casa del empleado</td>
    </tr>
        <tr>
      <td>*MUNICIPIO*</td>
      <td>=</td>
      <td>Municipio del empleado</td>
    </tr>
        <tr>
      <td>*ESTADO*</td>
      <td>=</td>
      <td>Estado del empleado</td>
    </tr>
        <tr>
      <td>*SALARIO*</td>
      <td>=</td>
      <td>Salario del empleado</td>
    </tr>
        <tr>
      <td>*PUESTO*</td>
      <td>=</td>
      <td>Puesto del empleado</td>
    </tr>
        <tr>
      <td>*CALLEPAT*</td>
      <td>=</td>
      <td>Calle de la empresa</td>
    </tr>
  <tr>
      <td>*NUMPAT*</td>
      <td>=</td>
      <td>Número de la direccion de la empresa</td>
    </tr> 
      <tr>
      <td>*HENTRADA*</td>
      <td>=</td>
      <td>Hora de entrada</td>
    </tr> 
     <tr>
      <td>*FECHAINICIAL*</td>
      <td>=</td>
      <td>Fecha inicial del contrato</td>
    </tr> 
    <tr>
      <td>*CPS*</td>
      <td>=</td>
      <td>Código postal del empleado</td>
    </tr> 
  </tbody>
</table>

<table class="table table-dark" style="position:absolute;top:80px;left:400px;color:white;" >
  <thead>
    <tr>
      <th scope="col" >Comando</th>
      <th scope="col">igual</th>
      <th scope="col">Significado</th>
    </tr>
  </thead>
  <tbody>
       <tr>
      <td>*DIASDURACION*</td>
      <td>=</td>
      <td>Dias de duración del contrato</td>
    </tr> 
   <td>*FECHAFINAL*</td>
      <td>=</td>
      <td>Fecha en que vence el contrato</td>
    </tr> 
      <tr>
      <td>*AF*</td>
      <td>=</td>
      <td>Área de firmas</td>
    </tr> 
    <tr>

      <td>*COLPAT*</td>
      <td>=</td>
      <td>Colonia de la empresa</td>
    </tr>
      <tr>

      <td>*HSALIDA*</td>
      <td>=</td>
      <td>Hora de salida</td>
    </tr>
    <tr>
      <td>*CIUDPAT*</td>
      <td>=</td>
      <td>Ciudad de la empresa</td>
    </tr>
        <tr>
      <td>*CPPAT*</td>
      <td>=</td>
      <td>Código postal de la empresa</td>
    </tr>
        <tr>
      <td>*PATRON*</td>
      <td>=</td>
      <td>Nombre del representante legal</td>
    </tr>
        <tr>
      <td>*EMPRESA*</td>
      <td>=</td>
      <td>Nombre de la empresa</td>
    </tr>
        <tr>
      <td>*NACIONALIDAD*</td>
      <td>=</td>
      <td>Nacionalidad del empleado</td>
    </tr>
        <tr>
      <td>*FECHANACIMIENTO*</td>
      <td>=</td>
      <td>Fecha de nacimiento del empleado</td>
    </tr>
        <tr>
      <td>*NSS*</td>
      <td>=</td>
      <td>Número del seguro social del empleado</td>
    </tr>
        <tr>
      <td>*RFCEMP*</td>
      <td>=</td>
      <td>RFC del empleado</td>
    </tr>
        <tr>
      <td>*CURPEMP*</td>
      <td>=</td>
      <td>CURP del empleado</td>
    </tr>
        <tr>
      <td>*GENEMP*</td>
      <td>=</td>
      <td>Sexo del empleado</td>
    </tr>
    </tr>
        <tr>
      <td>*ESTCIVIL*</td>
      <td>=</td>
      <td>Estado civil del empleado</td>
    </tr>
  </tbody>
</table>



                                
                              </div>

                            </div><!--end .col -->
                            
                            

                          </div><!--end .row -->

                        </div><!--end .col -->

                      </div><!--end .row -->
                    </div><!--end .card-body -->
                    <!-- END DEFAULT FORM ITEMS -->

                  


                    <!-- BEGIN FORM FOOTER -->
                    <div class="card-actionbar">
                      <div class="card-actionbar-row">
                          
                        <a class="btn btn-danger" href="<?php echo "?modulo=$modulo&filtro=$filtro"; ?>">CANCELAR</a>
                        <?php if( $accion == "agregar" || $accion == "editar" ){ ?>

                        <button type="button" class="btn btn-success" id='btnGuardar'>GUARDAR</button>
                        <?php } else if( $accion == "borrar" ){ ?>




                        <button type="button" class="btn btn-flat btn-accent">ELIMINAR</button>
                        <?php } else if( $accion == "ver" ){ ?>
                        <?php } ?>

                        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="ver" data-toggle="modal" data-target="#exampleModalLong">
  Ver mi prototipo de contrato
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Contrato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 

        <iframe src="http://auwi.mx/auwi_pruebas/v5/modulos/visualizar_con.php?bd=<?php echo base64_encode($_SESSION['DB']);?>" width="800" height="1000" id="val"></iframe>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
  
      </div>
    </div>
  </div>
</div>






                      </div><!--end .card-actionbar-row -->
                    </div><!--end .card-actionbar -->
                    <!-- END FORM FOOTER -->
                  </form>
                </div><!--end .card -->
              </div><!--end .col -->
              <!-- END ADD CONTACTS FORM -->

            </div><!--end .row -->
          </div><!--end .section-body -->
        </section>
      </div><!--end #content-->
      <!-- END CONTENT -->

<script src = "styles/js/libs/jquery/jquery-3.0.0.js"></script>
<script>

  var x = $(document).ready(main);
  function main(){
    $("#btnGenerar").click(function(){
      $.ajax({
        url:"/auwi_pruebas/v3/modulos/generarPDF.php",
        type:"GET",
        dataType: "script",
        async:false
      });
    });

    $("#ver").click(function(){
    var bd ="<?php echo base64_encode($_SESSION['DB']);?>";

  
  });

    $("#btnGuardar").click(function(){
      var nombre_file = $("#file_upload").val();
      var sep =  nombre_file.split(".");
      var nombre = sep[0];
      var ext = sep[1];
      
      if(ext != "txt"){
        alert("El archivo debe de ser  .txt");
      }
      else{

        var fg = new FormData(document.getElementById("rh"));
          $.ajax({
            url:"modulos/contrato.php?accion=",
            type:"POST",
            data:fg,
            contentType: false,
            processData: false,
            success:function(data){
              alert('El archivo se subio con éxito');
              window.location=('http://auwi.mx/auwi_pruebas/v3/index.php?modulo=contrato');
            
            },error:function(data){
            
          }
        });


      }
    });

}
</script>
