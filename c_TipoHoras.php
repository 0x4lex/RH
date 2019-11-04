<!-- BEGIN BASE-->
		<?php
		$accion=$_GET['accion'];
		if($accion=='editar' || $accion=='ver' || $accion=='borrar'){

		$ide=$_GET['id'];
		$query="SELECT*FROM c_TipoHoras where id='$ide'";
		$res=mysqli_query($conn,$query)or die(mysqli_error($conn));
		$r=mysqli_fetch_array($res);
		$nome=$r['Descripcion'];
		$regimen=$r['c_TipoHoras'];

		}
		?>
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
							<li><a href="?modulo=c_TipoHoras"><h4>Recursos humanos / Datos maestros / Tipo horas</h4></a></li>
							<?php 
						if($accion=='agregar'){
							echo"<li class='active'>Añadir Tipo horas</li>";
						}
						if($accion=='editar'){
							echo"<li class='active'>Editar Tipo horas</li>";
						}
						if($accion=='ver'){
							echo"<li class='active'>Ver Tipo horas</li>";
						}
						if($accion=='borrar'){
							echo"<li class='active'>Borrar horas</li>";
						}
						?>
						</ol>
					</div>
					<div class="section-body contain-lg">
						<div class="row">
							<!-- BEGIN ADD CONTACTS FORM -->												
							<div class="col-md-12">
							<form class="form-inline">
							<div class="card">
							<div class="card-head style-primary">
											<header></header>
										</div>
									
								<div class="card-body">
										<div class="form-group floating-label">
												<input type="text" class="form-control" name="regimen" id="regimen" value="<?php echo $regimen;?>">
											<label for="regular4">Tipo horas</label>
										</div>

										<div class="form-group floating-label">
											<input type="text" class="form-control" name="nom" id="nom" value="<?php echo $nome;?>">
											<label for="regular2">Descripcion</label>

										</div>

									
										<!--tr><th>Nombre</th><td><input type="text" name="nom" id="nom"></td></tr-->
										<tr>
										<?php									
										if($accion=='agregar'){
											echo"<td><input type='button' style='color: #FFFFFF; background-color: #4caf50' class='btn ink-reaction btn-raised btn btnAction' id='agregar' value='Guardar'></td>";
										}
										if($accion=='editar'){
											echo"<td><input type='button' id='editar' class='btn ink-reaction btn-raised btn-primary btnAction' value='Guardar'></td>";
										}
										if($accion=='borrar'){
											echo"<td><input type='button' id='eliminar' class='btn ink-reaction btn-raised btn-primary btnAction' value='Eliminar'></td>";
										}
										?>
										<td><input type="button" id="b3" class='btn ink-reaction btn-raised btn' style="color: #FFFFFF; background-color: #7A2C9B" value="Volver a Lista"></td>
										</tr>
								</div><!--end .row -->
							</div>
						</form>
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->
		
<script src="styles/js/libs/jquery/jquery-3.0.0.js"></script>
<script src="styles/js/c_TipoHoras/c_TipoHoras_Agregar.js"></script>
<!-- Clases -->
<script>
	// $( "#agregar" ).addClass( "btn ink-reaction btn-raised btn btnAction" );
	// $( "#editar" ).addClass( "btn ink-reaction btn-raised btn-primary btnAction" );
	// $( "#b3" ).addClass( "btn ink-reaction btn-raised btn" );
	// $( "#eliminar" ).addClass( "btn ink-reaction btn-raised btn-primary btnAction" );
</script>
<!-- Clases -->
