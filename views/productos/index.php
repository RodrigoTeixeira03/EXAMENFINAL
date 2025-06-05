<?php

use app\models\Productos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;

$isAdmin = !Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin';
?>
<div class="productos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($isAdmin): ?>
        <p>
            <?= Html::a(Yii::t('app', 'Crear Productos'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'categoria_idcategoria',
            'nombre',
            'descripcion:ntext',
            'precio',
            'stock',
            [
                'class' => ActionColumn::className(),
                'template' => $isAdmin ? '{view} {update} {delete}' : '{view}',
                'urlCreator' => function ($action, Productos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idproductos' => $model->idproductos, 'categoria_idcategoria' => $model->categoria_idcategoria]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
