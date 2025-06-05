<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Pedidos;
use app\models\Productos;

/** @var yii\web\View $this */
/** @var app\models\Detallepedido $model */
/** @var yii\widgets\ActiveForm $form */

// Obtener lista de pedidos para dropdown
$pedidos = ArrayHelper::map(Pedidos::find()->all(), 'idpedidos', 'idpedidos'); // Puedes cambiar 'idpedidos' por otro campo descriptivo si lo tienes

// Obtener lista de productos para dropdown
$productos = ArrayHelper::map(Productos::find()->all(), 'idproductos', 'nombre'); // Cambia 'nombre' por el campo que describa mejor el producto

?>

<div class="detallepedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pedidos_idpedidos')->dropDownList(
        $pedidos,
        [
            'prompt' => 'Seleccione un pedido',
            'required' => true,
            'class' => 'form-control',
        ]
    ) ?>

    <?= $form->field($model, 'productos_idproductos')->dropDownList(
        $productos,
        [
            'prompt' => 'Seleccione un producto',
            'required' => true,
            'class' => 'form-control',
        ]
    ) ?>

    <?= $form->field($model, 'cantidad')->textInput([
        'type' => 'number',
        'min' => 1,
        'required' => true,
        'placeholder' => 'Ingrese la cantidad',
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'subtotal')->textInput([
        'maxlength' => true,
        'required' => true,
        'placeholder' => 'Ingrese el subtotal',
        'class' => 'form-control',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
