<?php

use app\models\Comentarios;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ComentariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Comentarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Comentarios'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idcomentarios',
            'usuario_id',
            'evento_id',
            'contenido:ntext',
            'multimedia_path',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Comentarios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idcomentarios' => $model->idcomentarios]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
