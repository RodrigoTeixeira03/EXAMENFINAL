<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Detallepedido $model */

$this->title = $model->iddetallepedido;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detallepedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="detallepedido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'iddetallepedido' => $model->iddetallepedido, 'pedidos_idpedidos' => $model->pedidos_idpedidos, 'productos_idproductos' => $model->productos_idproductos], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'iddetallepedido' => $model->iddetallepedido, 'pedidos_idpedidos' => $model->pedidos_idpedidos, 'productos_idproductos' => $model->productos_idproductos], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'productos_idproductos',
            'cantidad',
            'subtotal',
        ],
    ]) ?>

</div>
