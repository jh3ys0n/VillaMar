<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Inicia Sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" style="background-image: url('<?= \yii\helpers\Url::to('@web/assets/img/background_img2.jpeg') ?>'); background-size: cover; background-position: center; height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div class="login-container" style="background-color: rgba(255, 255, 255, 0.8); padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 500px; width: 100%;">
        <h1><?= Html::encode($this->title) ?></h1>


        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'invalid-feedback'],
            ],
        ]); ?>

        <div class="form-group text-left">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username']) ?>
        </div>

        <div class="form-group text-left">
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>
        </div>

        <div class="form-group text-left">
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"form-check\">{input} {label}</div>\n<div>{error}</div>",
                'labelOptions' => ['class' => 'form-check-label'],
                'inputOptions' => ['class' => 'form-check-input'],
            ]) ?>
        </div>

        <div class="form-group text-left">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div style="color:#999; font-size: 0.9em;">
            You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
            To modify the username/password, please check out the code <code>app\models\User::$users</code>.
        </div>
    </div>
</div>