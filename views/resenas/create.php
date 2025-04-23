<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Resenas $model */

$this->title = Yii::t('app', 'Create Resenas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Resenas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resenas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
