<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */

$this->title = $model->idusuarios;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'idusuarios' => $model->idusuarios], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'idusuarios' => $model->idusuarios], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idusuarios',
            'nombre',
            'email:email',
            'password',
            'telefono',
            'tipo_usuario',
            [
                'attribute' => 'avatar_path',
                'format' => 'html',
                'value' => function($model) {
                    if ($model->avatar_path) {
                        return Html::img($model->avatar_path, [
                            'style' => 'max-width: 300px; max-height: 300px;',
                            'class' => 'img-thumbnail',
                            'alt' => 'Avatar',
                        ]);
                    }
                    return 'No hay imagen';
                },
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
