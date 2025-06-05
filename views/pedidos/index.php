<?php

use app\models\Pedidos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Pedidos');
$this->params['breadcrumbs'][] = $this->title;

// Verificar si el usuario es admin
$isAdmin = !Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin';
?>
<div class="pedidos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($isAdmin): ?>
        <p>
            <?= Html::a(Yii::t('app', 'Crear Pedidos'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'clientes_idclientes',
            'fecha',
            'total',
            'estado',
            [
                'class' => ActionColumn::className(),
                'template' => $isAdmin ? '{view} {update} {delete}' : '{view}',
                'urlCreator' => function ($action, Pedidos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idpedidos' => $model->idpedidos, 'clientes_idclientes' => $model->clientes_idclientes]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
