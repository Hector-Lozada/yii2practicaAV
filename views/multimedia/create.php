<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Multimedia $model */

$this->title = Yii::t('app', 'Create Multimedia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Multimedia'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multimedia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
