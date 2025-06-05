<?php

use app\models\Categoria;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Categorias');
$this->params['breadcrumbs'][] = $this->title;

$isAdmin = !Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin';

?>
<div class="categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($isAdmin): ?>
        <p>
            <?= Html::a(Yii::t('app', 'Crear Categoria'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre',
            [
                'class' => ActionColumn::className(),
                'template' => $isAdmin ? '{view} {update} {delete}' : '{view}',
                'urlCreator' => function ($action, Categoria $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idcategoria' => $model->idcategoria]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
