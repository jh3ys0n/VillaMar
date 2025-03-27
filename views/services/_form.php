<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="services-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')
    ->textInput(['maxlength' => true])
    ->label('<h4>Name</h4>', ['encode' => false]) ?>

    <?= $form->field($model, 'slogan')
    ->textInput(['maxlength' => true])
    ->label('<h4>slogan</h4>', ['encode' => false])  ?>
    
    <?php if (!empty($model->header_image)): ?>
    <div class="form-group">
        <h4>Imagen de portada</h4>
        <div>
            <img src="data:image/jpeg;base64,<?= $model->header_image ?>" style="max-width: 300px;">
        </div>
    </div>
    <?php endif; ?>
    <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('<h4>Description</h4>', ['encode' => false])  ?>
    

    <div class="form-group">
        <h4>Gallery Images</h4>
        <div id="gallery-images-container" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
            <?php if (!empty($model->galleryImages)): ?>
                <?php foreach ($model->galleryImages as $index => $galleryImage): ?>
                    <div class="gallery-image-item" data-index="<?= $index ?>" style="text-align: center; max-width: 200px">
                        <img src="data:image/jpeg;base64,<?= $galleryImage->base64_image ?>" style="max-width:100px; height: 100px; border-radius: 5px;">
                        <?= Html::hiddenInput("ExistingImages[{$index}][id]", $galleryImage->id) ?>
                        <br>
                        <?= Html::button('Remove', ['class' => 'btn btn-danger remove-gallery-image', 'style' => 'margin-top: 5px;']) ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>    
        <div class="mt-3">
            <input type="file" id="new-gallery-image" accept="image/*" multiple>
            <!-- Remove the button since it's no longer needed -->
            <!-- <button type="button" id="add-gallery-images" class="btn btn-primary mt-2">Agregar imágenes</button> -->
        </div>
    </div>
    <div class="form-group">
        <h4>Planes</h4>

        <?= Html::a('Añadir Servicio/Producto', 
        ['/plans/create', 'id' => $model->id], 
        ['class' => 'btn btn-primary']) 
    ?>

        <!-- Display Plans as Cards -->
        <div class="row mt-4">
            <?php if (!empty($model->plans)): ?>
                <?php foreach ($model->plans as $plan): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div id="carousel-<?= $plan->id ?>" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach ($plan->galleryImages as $index => $galleryImage): ?>
                                        <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                                            <img src="data:image/jpeg;base64,<?= $galleryImage->base64_image ?>" class="d-block w-100" alt="Plan Image">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <a class="carousel-control-prev" href="#carousel-<?= $plan->id ?>" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-<?= $plan->id ?>" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?= Html::encode($plan->name) ?></h4>
                                <h6 class="card-title">BOB.<?= Html::encode($plan->price) ?></h6>
                                <p class="card-text">Ver mas</p>
                                <?= Html::a('Actualizar', 
                                    ['/plans/update', 'id' => $plan->id], 
                                    ['class' => 'btn btn-primary']) 
                                ?>
                                
                                <?= Html::a('Eliminar', 
                                    ['/plans/delete', 'id' => $plan->id], 
                                    [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => '¿Estás seguro de que deseas eliminar este plan?',
                                            'method' => 'post',
                                        ],
                                    ]) 
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay planes disponibles.</p>
            <?php endif; ?>
        </div>
    </div>

    <h4>Informacion de contacto</h4>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const galleryContainer = document.getElementById('gallery-images-container');
    const newGalleryImageInput = document.getElementById('new-gallery-image');
    let imageIndex = <?= !empty($model->galleryImages) ? count($model->galleryImages) : 0 ?>;

    galleryContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-gallery-image')) {
            const imageItem = e.target.closest('.gallery-image-item');
            imageItem.remove();
        }
    });

    newGalleryImageInput.addEventListener('change', function() {
        const files = newGalleryImageInput.files;
        
        for (let file of files) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageDiv = document.createElement('div');
                imageDiv.classList.add('gallery-image-item');
                imageDiv.setAttribute('data-index', imageIndex);
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `NewImages[${imageIndex}][base64_image]`;
                hiddenInput.value = e.target.result.split(',')[1];
                
                const removeBtn = document.createElement('button');
                removeBtn.textContent = 'Remove';
                removeBtn.type = 'button';
                removeBtn.classList.add('btn', 'btn-danger', 'remove-gallery-image');
                
                imageDiv.appendChild(img);
                imageDiv.appendChild(hiddenInput);
                imageDiv.appendChild(removeBtn);
                
                galleryContainer.appendChild(imageDiv);
                imageIndex++;
            };
            reader.readAsDataURL(file);
        }
        
        newGalleryImageInput.value = '';
    });
});
</script>
