<?php
use yii\helpers\Html;
?>

<div class="image-index">
    <h1>Imágenes</h1>

    <p>
        <?= Html::a('Subir Nueva Imagen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <?php foreach ($images as $image): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="data:image/jpeg;base64,<?= $image->base64_image ?>" class="card-img-top" alt="<?= $image->name ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $image->name ?></h5>
                        <p class="card-text">Subido: <?= $image->created_at ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>