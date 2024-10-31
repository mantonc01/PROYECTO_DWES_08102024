<?php include __DIR__ . '/partials/inicio-doc.part.php' ?>

<!-- Navigation Bar -->
<?php include __DIR__ . '/partials/nav-doc.part.php' ?>

<!-- End of Navigation Bar -->



<!-- Principal Content Start -->
<div id="galeria">
	<div class="container">
		<div class="col-xs-12 col-sm-8 col-sm-push-2">
			<h1>GALERIA</h1>
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
								<li><?= $error?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>">
				<div class="form-group">
					<div class="col-xs-12">
						<label class="label-control">Imagen</label>
						<input class="form-control-file" type="file" name="imagen">
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

			</div>
		</div>
	</div>
</div>
<!-- Principal Content Start -->
<?php include __DIR__ . '/partials/fin-doc.part.php' ?>