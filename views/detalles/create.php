<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Detalles $model */

$this->title = Yii::t('app', 'Create Detalles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
