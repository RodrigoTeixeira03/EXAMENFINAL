<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Clientes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="clientes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput([
        'maxlength' => true,
        'required' => true,
        'placeholder' => 'Ingrese el nombre completo',
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'correo')->input('email', [
        'maxlength' => true,
        'required' => true,
        'placeholder' => 'Ingrese un correo válido',
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'direccion')->textInput([
        'maxlength' => true,
        'required' => true,
        'placeholder' => 'Ingrese la dirección',
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'telefono')->input('tel', [
        'maxlength' => true,
        'required' => true,
        'placeholder' => 'Ingrese el teléfono',
        'class' => 'form-control',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
