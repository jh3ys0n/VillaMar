<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Services $model */

$this->title = Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

preg_match('/\((-?\d+\.\d+), (-?\d+\.\d+)\)/', $model->address, $matches);
$lat = $matches[1] ?? -21.755026371088526;
$lng = $matches[2] ?? -67.48056875985749;
$popupText = $model->address ? Html::encode($model->address) : 'Dirección no disponible';
?>

<div class="services-view">
    <div style="position: relative; height: 700px; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); width: 100vw; margin-left: calc(50% - 50vw);">

        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('<?= \yii\helpers\Url::to('@web/assets/img/background_img2.jpeg') ?>'); background-size: cover; background-position: center; opacity: 0.90;"></div>
        
        <div style="position: relative; z-index: 1; text-align: center;">
            <h1 class='responsive'>
                <?= Html::encode($model->name) ?>
            </h1>
            <p style="font-size: 24px; margin-bottom: 20px;">Un abrazo en la inmensidad</p>
            <?= Html::a('Ver Servicios', ['index'], ['class' => 'custom-button']) ?>
        </div>
    </div>

    <div style="margin-top: 20px; text-align: center;">
    <h2>Contact Information</h2>
    <ul style="list-style: none; padding-left: 0; display: flex; justify-content: center; align-items: center; gap: 20px;">
        <li>
            <a href="https://wa.me/<?= Html::encode($model->phone) ?>" target="_blank">
                <img src="<?= \yii\helpers\Url::to('@web/assets/img/icons/whatsapp.png') ?>" alt="WhatsApp" style="width: 60px; height: 60px;">
            </a>
        </li>
        <li>
            <a href="mailto:<?= Html::encode($model->email) ?>">
                <img src="<?= \yii\helpers\Url::to('@web/assets/img/icons/gmail.png') ?>" alt="Email" style="width: 55px; height: 55px;">
            </a>
        </li>
        <li>
            <a href="<?= Html::encode($model->facebook) ?>" target="_blank">
                <img src="<?= \yii\helpers\Url::to('@web/assets/img/icons/fb.png') ?>" alt="Facebook" style="width: 60px; height: 60px;">
            </a>
        </li>
    </ul>
</div>

    <h2>Ubicación</h2>
    <div id="map" style="height: 400px; width: 100%;"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([<?= $lat ?>, <?= $lng ?>], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([<?= $lat ?>, <?= $lng ?>]).addTo(map)
            .bindPopup('<?= $popupText ?>')
            .openPopup();
    });
</script>
