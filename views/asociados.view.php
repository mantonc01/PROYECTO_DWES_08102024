<?php include_once 'views/partials/inicio-doc.part.php' ?>

<!-- Navigation Bar -->
<?php include_once 'views/partials/nav-doc.part.php' ?>

<!-- End of Navigation Bar -->



<!-- Principal Content Start -->
<div id="asociados">
	<div class="container">
		<div class="col-xs-12 col-sm-8 col-sm-push-2">
			<h1>ASOCIADOS</h1>
			<hr>
			<!--Compruebo a ver si estoy recibiendo los datos del formulario: -->
			<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
				<!--Si el array de errores está vacio muestro una alerta de tipo info, y en caso-->
				<!--contrario muestro una alerta de tipo danger (son clases css de bootstrap)-->
				<div class="alert alert-<?= empty($errores) ? 'info' : 'danger'; ?> alert-dismissibre" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
					<?php if (empty($errores)): ?>
						<p> <?= $mensaje ?></p>
					<?php else: ?>
						<ul>
							<?php foreach ($errores as $error): ?>
								<li><?= $error ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<!-- 23/11/2024 agregado para mostrar mensajes de alerta -->
			<?php if (!empty($datos)) : ?>
				<div class="<?php echo $nombreDiv ?>">
					<ul>
						<?php foreach ($datos as $dat) : ?>
							<li><?php echo $dat; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
			<!--23/11/2024  -->
			<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>">
				<div class="form-group">
					<div class="col-xs-12">
						<label class="label-control">Nombre</label>
						<input class="form-control" type="text" name="nombre">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<label class="label-control">Logo</label>
						<input class="form-control-file" type="file" name="logo">
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12">
						<label class="label-control">Descripcion</label>
						<textarea class="form-control" name="descripcion"> <?= $descripcion ?></textarea>
						<button class="pull-right btn btn-lg sr-button">ENVIAR</button>
					</div>
				</div>
			</form>
			<hr class="divider">

			<div class="imagenes_galeria">
				<!-- /////////////////////////////// -->
				<!-- Nos traemos las imágenes que están definidas en la BD -->
				<!-- <--Pegamos aquí el código de la tabla bootstrap->  -->
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Nombre</th>
							<th scope="col">Logo</th>
						</tr>
					</thead>
					<?php foreach ($asociados as $imagen): ?>
						<tr>
							<th scope="row"><?= $imagen->getId() ?></th>
							<td><?= $imagen->getNombre() ?></td>
							<td>
								<img src="<?= $imagen->getUrlLogo() ?>"
									alt="<?= $imagen->getDescripcion() ?>"
									title="<?= $imagen->getDescripcion() ?>"
									width="100px">
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<!-- ///////////////////////////////// -->

			</div>
		</div>
	</div>
</div>
<!-- Principal Content Start -->
<?php include_once 'views/partials/fin-doc.part.php' ?>