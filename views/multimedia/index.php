<?php

use app\models\Multimedia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\MultimediaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Multimedia');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multimedia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Multimedia'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idmultimedia:datetime',
            'idevento',
            'tipo',
            'ruta_archivo',
            'titulo',
            //'descripcion:ntext',
            //'es_principal',
            //'orden',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Multimedia $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idmultimedia' => $model->idmultimedia]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
