<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Services $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="services-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Name Field -->
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- Description Field -->
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group row">
        <div class="col-md-4">
            <label for="phone">Phone</label>
            <?= $form->field($model, 'phone')->input('text', [
                'id' => 'phone', 
                'class' => 'form-control',
            ])->label(false) ?>
        </div>

        <div class="col-md-4">
            <label for="email">Email</label>
            <?= $form->field($model, 'email')->input('email', [
                'id' => 'email', 
                'class' => 'form-control',
            ])->label(false) ?>
        </div>

        <div class="col-md-4">
            <label for="facebook">Facebook</label>
            <?= $form->field($model, 'facebook')->textInput(['maxlength' => true])->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <?= $form->field($model, 'address')->textInput(['id' => 'address', 'class' => 'form-control', 'readonly' => true])->label(false) ?>
    </div>

    <div id="map" style="height: 400px; width: 80%;"></div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      
        const phoneInput = document.querySelector("#phone");
        const iti = window.intlTelInput(phoneInput, {
            initialCountry: "bo", 
            separateDialCode: true, 
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js", 
        });

        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            if (!iti.isValidNumber()) {
                e.preventDefault();
                
            } else {
                const phoneNumber = iti.getNumber();  
                document.querySelector('[name="Services[phone]"]').value = phoneNumber; 
            }
        });

        let map;
        let marker;
        let selectedLatLng;
        const addressValue = document.getElementById('address').value.trim(); 
        let initialLocation;

        if (addressValue.startsWith('(') && addressValue.endsWith(')')) {
            const coords = addressValue.slice(1, -1).split(',').map(coord => parseFloat(coord.trim()));
            if (coords.length === 2 && !isNaN(coords[0]) && !isNaN(coords[1])) {
                initialLocation = coords; 
            } else {
                initialLocation = [-21.7541055631944, -67.4814705752597]; 
            }
        } else {
            initialLocation = [-21.7541055631944, -67.4814705752597]; 
        }

       
        map = L.map('map').setView(initialLocation, 17); 

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        marker = L.marker(initialLocation, { draggable: true }).addTo(map);

        function updateAddressAndCoordinates(lat, lng) {
            const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&addressdetails=1`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const address = data.display_name;
                    document.getElementById('address').value = ` (${lat}, ${lng})`; 
                    selectedLatLng = { lat, lng }; 
                    console.log('Selected Coordinates:', selectedLatLng);
                });
        }

        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            marker.setLatLng(e.latlng); 
            updateAddressAndCoordinates(lat, lng); 
        });

        marker.on('dragend', function (e) {
            const lat = e.target.getLatLng().lat;
            const lng = e.target.getLatLng().lng;
            updateAddressAndCoordinates(lat, lng); 
        });

        updateAddressAndCoordinates(initialLocation[0], initialLocation[1]);
    });
</script>
