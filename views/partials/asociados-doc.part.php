<?php
include_once __DIR__ . '../../../entityes/asociado.class.php';
?>
<div class="last-box row">
    <div class="col-xs-12 col-sm-4 col-sm-push-4 last-block">
        <div class="partner-box text-center">
            <p>
                <i class="fa fa-map-marker fa-2x sr-icons"></i>
                <span class="text-muted">35 North Drive, Adroukpape, PY 88105, Agoe Telessou</span>
            </p>
            <h4>Our Main Partners</h4>
            <hr>
            <div class="text-muted text-left">
                <?php foreach ($asociadosAMostrar as $asociado): ?>
                    <ul class="list-inline">
                        <li>
                            <img src="images/index/<?php echo $asociado->getLogo(); ?>" alt="<?php echo $asociado->getDescripcion(); ?>"
                                title="<?php echo $asociado->getDescripcion(); ?>">
                        </li>
                        <li><?php echo $asociado->getNombre(); ?></li>
                    </ul>
                <?php endforeach; ?>
            <!-- <ul class="list-inline">
              <li><img src="images/index/log1.jpg" alt="logo"></li>
              <li>Second Partner Name</li>
            </ul>
            <ul class="list-inline">
              <li><img src="images/index/log3.jpg" alt="logo"></li>
              <li>Third Partner Name</li>
            </ul> -->
            </div>
        </div>
    </div>
</div>