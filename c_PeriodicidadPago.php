<?php 

$modulo = $_GET['modulo'];
$accion = $_GET['accion'];
$id = $_GET['id'];



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
							<li><a>Almacenes</a></li>
							<li class="active">Datos Maestros</li>
							<li class="active">
								<?php if( $accion == "editar" ){ ?>
								Editar Serie
								<?php }else if( $accion == "ver" ){ ?>
								Ver Serie
								<?php }else  if( $accion == "agregar" ){ ?>
								Añadir Serie
								<?php }else  if( $accion == "borrar" ){ ?>
								Borrar Serie
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






											</div><!--end .card-actionbar-row -->
										</div><!--end .card-actionbar -->
										<!-- END FORM FOOTER -->
									</form>
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END ADD CONTACTS FORM -->
							<style>
								  #agregar {
							        position:absolute;
							        left: 45%;
        							top: 80%;
   									 }

							</style>
							<h1>Agregar datos a Periodicidad de pago</h1>
		<h4>Descripcion:</h4> <input type="text" id="Descripcion" name="Descripcion" required size="45">
		<br><br>
		<h4>Razon social:</h4> <input type="text" id="razon_social" name="razon_social" required size="45">
		<button type="button" class="btn btn-primary" id="agregar"style="float:right;">Agregar</button>
						</div><!--end .row -->
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

<script src = "styles/js/libs/jquery/jquery-3.0.0.js"></script>
<script>

	

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
							window.location=('http://auwi.mx/auwi_pruebas/v5/index.php?modulo=contrato');
						
						},error:function(data){
						
					}
				});


			}
		});

}
</script>
