<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/** @var yii\web\View $this */
/** @var app\models\Plans $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plans-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::class, [
        'editorOptions' => [
            'preset' => 'standard', // standard, basic, full
            'inline' => false,
        ],
    ]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duration')->textInput() ?>

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

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const galleryContainer = document.getElementById('gallery-images-container');
    const newGalleryImageInput = document.getElementById('new-gallery-image');
    let imageIndex = <?= !empty($model->galleryImages) ? count($model->galleryImages) : 0 ?>;

    // Existing code for removing images
    galleryContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-gallery-image')) {
            const imageItem = e.target.closest('.gallery-image-item');
            imageItem.remove();
        }
    });

    // Modify the image addition logic to trigger automatically on file selection
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