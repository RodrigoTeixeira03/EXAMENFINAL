<?php
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body {
            background-color: #f8f9fa;
        }
        header .navbar {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        #main .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-top: 80px;
            margin-bottom: 30px;
        }
        footer {
            border-top: 1px solid #dee2e6;
        }
        .custom-navbar {
    background-color: #4b0082;
}

    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Html::encode(Yii::$app->name),
        'brandUrl' => Yii::$app->homeUrl,
       'options' => ['class' => 'navbar navbar-expand-md navbar-dark custom-navbar fixed-top']
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => array_filter([
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Acerca de Nosotros', 'url' => ['/site/about']],
            ['label' => 'Contáctanos', 'url' => ['/site/contact']],
            !Yii::$app->user->isGuest ? [
                'label' => 'Gestionar Tienda',
                'items' => array_filter([
                    ['label' => 'Clientes', 'url' => ['/clientes/index']],
                    ['label' => 'Categoría', 'url' => ['/categoria/index']],
                    ['label' => 'Productos', 'url' => ['/productos/index']],
                    ['label' => 'Pedidos', 'url' => ['/pedidos/index']],
                    ['label' => 'Detalle de Pedidos', 'url' => ['/detallepedido/index']],
                    Yii::$app->user->identity->role === 'admin'
                        ? ['label' => 'Usuarios', 'url' => ['/user/index']]
                        : null,
                ]),
            ] : null,
            Yii::$app->user->isGuest
                ? ['label' => 'Iniciar Sesión', 'url' => ['/site/login']]
                : ['label' => 'Cambiar contraseña', 'url' => ['/user/change-password']],
            Yii::$app->user->isGuest
                ? null
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Cerrar Sesión (' 
                        . Html::encode(Yii::$app->user->identity->apellido . ' ' . Yii::$app->user->identity->nombre) 
                        . ') ' . Html::encode(Yii::$app->user->identity->role),
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>',
        ]),
    ]);

    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">
                &copy; My Company <?= date('Y') ?>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <?= Yii::powered() ?>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
