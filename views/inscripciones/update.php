<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Inscripciones $model */

$this->title = Yii::t('app', 'Update Inscripciones: {name}', [
    'name' => $model->idinscripciones,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inscripciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idinscripciones, 'url' => ['view', 'idinscripciones' => $model->idinscripciones]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="inscripciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
