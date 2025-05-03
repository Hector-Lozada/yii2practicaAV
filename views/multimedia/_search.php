<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MultimediaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="multimedia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idmultimedia') ?>

    <?= $form->field($model, 'idevento') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'ruta_archivo') ?>

    <?= $form->field($model, 'titulo') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'es_principal') ?>

    <?php // echo $form->field($model, 'orden') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
