<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Multimedia $model */

$this->title = Yii::t('app', 'Update Multimedia: {name}', [
    'name' => $model->idmultimedia,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Multimedia'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmultimedia, 'url' => ['view', 'idmultimedia' => $model->idmultimedia]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="multimedia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
