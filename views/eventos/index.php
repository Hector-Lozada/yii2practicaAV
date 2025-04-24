<?php

use app\models\Eventos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\EventosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Eventos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Eventos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ideventos',
            'nombre',
            'descripcion',
            'fecha_evento',
            'ubicacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Eventos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ideventos' => $model->ideventos]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
