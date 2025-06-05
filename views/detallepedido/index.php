<?php

use app\models\Detallepedido;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Detalle de Pedidos');
$this->params['breadcrumbs'][] = $this->title;

$isAdmin = !Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin';

?>
<div class="detallepedido-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($isAdmin): ?>
        <p>
            <?= Html::a(Yii::t('app', 'Crear Detalle pedido'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'pedidos_idpedidos',
            'productos_idproductos',
            'cantidad',
            'subtotal',

            [
                'class' => ActionColumn::className(),
                'template' => $isAdmin ? '{view} {update} {delete}' : '{view}',
                'urlCreator' => function ($action, Detallepedido $model, $key, $index, $column) {
                    return Url::toRoute([
                        $action,
                        'iddetallepedido' => $model->iddetallepedido,
                        'pedidos_idpedidos' => $model->pedidos_idpedidos,
                        'productos_idproductos' => $model->productos_idproductos,
                    ]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
