<?php

use app\models\Inscripciones;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\InscripcionesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Inscripciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscripciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Inscripciones'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idinscripciones',
            'usuario_id',
            'evento_id',
            'fecha_inscripcion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Inscripciones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idinscripciones' => $model->idinscripciones]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
