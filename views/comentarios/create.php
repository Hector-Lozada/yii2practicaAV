<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Comentarios $model */

$this->title = Yii::t('app', 'Create Comentarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comentarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
