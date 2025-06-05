<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Categoria;

/** @var yii\web\View $this */
/** @var app\models\Productos $model */
/** @var yii\widgets\ActiveForm $form */

// Obtener lista de categorías para dropdown
$categorias = ArrayHelper::map(Categoria::find()->all(), 'idcategoria', 'nombre');

?>

<div class="productos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categoria_idcategoria')->dropDownList(
        $categorias,
        [
            'prompt' => 'Seleccione una categoría',
            'required' => true,
            'class' => 'form-control',
        ]
    ) ?>

    <?= $form->field($model, 'nombre')->textInput([
        'maxlength' => true,
        'required' => true,
        'placeholder' => 'Ingrese el nombre del producto',
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'descripcion')->textarea([
        'rows' => 6,
        'placeholder' => 'Ingrese una descripción',
        'required' => true,
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'precio')->input('number', [
        'step' => '0.01',
        'min' => '0',
        'required' => true,
        'placeholder' => 'Ingrese el precio',
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'stock')->input('number', [
        'min' => '0',
        'required' => true,
        'placeholder' => 'Ingrese el stock disponible',
        'class' => 'form-control',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
