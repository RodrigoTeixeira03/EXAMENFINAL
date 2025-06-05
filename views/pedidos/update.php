<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pedidos $model */

$this->title = Yii::t('app', 'Update Pedidos: {name}', [
    'name' => $model->idpedidos,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idpedidos, 'url' => ['view', 'idpedidos' => $model->idpedidos, 'clientes_idclientes' => $model->clientes_idclientes]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pedidos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
