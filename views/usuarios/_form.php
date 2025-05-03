<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_usuario')->dropDownList([ 'admin' => 'Admin', 'organizador' => 'Organizador', 'participante' => 'Participante', ], ['prompt' => '']) ?>

    <?php // $form->field($model, 'avatar_path')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <small class="text-muted">Formatos permitidos: png, jpg, jpeg, gif (max 5MB)</small>

    <?php if (!$model->isNewRecord && $model->avatar_path): ?>
        <div class="form-group">
            <label>Imagen Actual</label>
            <div>
                <img src="<?= $model->avatar_path ?>" alt="Imagen del trade" style="max-width: 200px; max-height: 200px;">
            </div>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
