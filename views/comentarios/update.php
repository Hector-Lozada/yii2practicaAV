<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Comentarios $model */

$this->title = Yii::t('app', 'Update Comentarios: {name}', [
    'name' => $model->idcomentarios,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comentarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcomentarios, 'url' => ['view', 'idcomentarios' => $model->idcomentarios]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="comentarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
