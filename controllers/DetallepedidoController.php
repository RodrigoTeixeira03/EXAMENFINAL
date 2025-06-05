<?php

namespace app\controllers;

use app\models\Detallepedido;
use app\models\DetallepedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * DetallepedidoController implements the CRUD actions for Detallepedido model.
 */
class DetallepedidoController extends Controller
{
    /**
     * @inheritDoc
     */
      public function behaviors()
{
    return [
        'access' => [
            'class' => \yii\filters\AccessControl::class,
            'rules' => [
                [
                    'actions' => ['index', 'view'],
                    'allow' => true,
                    'roles' => ['@'], // Todos los usuarios autenticados pueden ver
                ],
                [
                    'actions' => ['create', 'update', 'delete'],
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->role === 'admin';
                    }
                ],
            ],
        ],
        // otros behaviors
    ];
}

    /**
     * Lists all Detallepedido models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DetallepedidoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Detallepedido model.
     * @param int $iddetallepedido Iddetallepedido
     * @param int $pedidos_idpedidos Pedidos Idpedidos
     * @param int $productos_idproductos Productos Idproductos
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($iddetallepedido, $pedidos_idpedidos, $productos_idproductos)
    {
        return $this->render('view', [
            'model' => $this->findModel($iddetallepedido, $pedidos_idpedidos, $productos_idproductos),
        ]);
    }

    /**
     * Creates a new Detallepedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Detallepedido();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'iddetallepedido' => $model->iddetallepedido, 'pedidos_idpedidos' => $model->pedidos_idpedidos, 'productos_idproductos' => $model->productos_idproductos]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Detallepedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $iddetallepedido Iddetallepedido
     * @param int $pedidos_idpedidos Pedidos Idpedidos
     * @param int $productos_idproductos Productos Idproductos
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($iddetallepedido, $pedidos_idpedidos, $productos_idproductos)
    {
        $model = $this->findModel($iddetallepedido, $pedidos_idpedidos, $productos_idproductos);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'iddetallepedido' => $model->iddetallepedido, 'pedidos_idpedidos' => $model->pedidos_idpedidos, 'productos_idproductos' => $model->productos_idproductos]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Detallepedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $iddetallepedido Iddetallepedido
     * @param int $pedidos_idpedidos Pedidos Idpedidos
     * @param int $productos_idproductos Productos Idproductos
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($iddetallepedido, $pedidos_idpedidos, $productos_idproductos)
    {
        $this->findModel($iddetallepedido, $pedidos_idpedidos, $productos_idproductos)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Detallepedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $iddetallepedido Iddetallepedido
     * @param int $pedidos_idpedidos Pedidos Idpedidos
     * @param int $productos_idproductos Productos Idproductos
     * @return Detallepedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($iddetallepedido, $pedidos_idpedidos, $productos_idproductos)
    {
        if (($model = Detallepedido::findOne(['iddetallepedido' => $iddetallepedido, 'pedidos_idpedidos' => $pedidos_idpedidos, 'productos_idproductos' => $productos_idproductos])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
