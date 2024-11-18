<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Services $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

preg_match('/\((-?\d+\.\d+), (-?\d+\.\d+)\)/', $model->address, $matches);
$lat = isset($matches[1]) ? $matches[1] : -21.755026371088526;  
$lng = isset($matches[2]) ? $matches[2] : -67.48056875985749;  
?>
<div class="services-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'phone',
            'email:email',
            'facebook',
        ],
    ]) ?>

    <h2>Ubicación</h2>

    <div id="map" style="height: 400px; width: 100%;"></div>

</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([<?= $lat ?>, <?= $lng ?>], 90);  

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([<?= $lat ?>, <?= $lng ?>]).addTo(map)
            .bindPopup('<?= isset($model->address) ? $model->address : "Dirección no disponible" ?>')  
            .openPopup();
    });
</script>
