<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Clientes;

/** @var yii\web\View $this */
/** @var app\models\Pedidos $model */
/** @var yii\widgets\ActiveForm $form */

// Obtener lista de clientes
$clientes = ArrayHelper::map(Clientes::find()->all(), 'idclientes', 'nombre');

?>

<div class="pedidos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clientes_idclientes')->dropDownList(
        $clientes,
        [
            'prompt' => 'Seleccione un cliente',
            'required' => true,
            'class' => 'form-control',
        ]
    ) ?>

    <?= $form->field($model, 'fecha')->textInput([
        'type' => 'date',
        'required' => true
    ]) ?>

    <?= $form->field($model, 'total')->textInput([
        'maxlength' => true,
        'placeholder' => 'Ingrese el total del pedido',
        'required' => true
    ]) ?>

   <?= $form->field($model, 'estado')->dropDownList([
    'pendiente' => 'Pendiente',
    'procesando' => 'Procesando',
    'enviado' => 'Enviado',
    'entregado' => 'Entregado',
], [
    'prompt' => 'Seleccione el estado del pedido',
    'required' => true
]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
