<?php

namespace app\controllers;

use app\models\Pedidos;
use app\models\PedidosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * PedidosController implements the CRUD actions for Pedidos model.
 */
class PedidosController extends Controller
{
    /**
     * @inheritDoc
     */
      public function behaviors()
{
    return array_merge(
        parent::behaviors(),
        [
            // Filtro de acceso
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'create', 'update', 'delete'], // acciones protegidas
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Solo usuarios logeados
                    ],
                ],
            ],

            // Filtro para métodos HTTP (ej: delete solo con POST)
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]
    );
}

    /**
     * Lists all Pedidos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PedidosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedidos model.
     * @param int $idpedidos Idpedidos
     * @param int $clientes_idclientes Clientes Idclientes
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idpedidos, $clientes_idclientes)
    {
        return $this->render('view', [
            'model' => $this->findModel($idpedidos, $clientes_idclientes),
        ]);
    }

    /**
     * Creates a new Pedidos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pedidos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idpedidos' => $model->idpedidos, 'clientes_idclientes' => $model->clientes_idclientes]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pedidos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idpedidos Idpedidos
     * @param int $clientes_idclientes Clientes Idclientes
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idpedidos, $clientes_idclientes)
    {
        $model = $this->findModel($idpedidos, $clientes_idclientes);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idpedidos' => $model->idpedidos, 'clientes_idclientes' => $model->clientes_idclientes]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pedidos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idpedidos Idpedidos
     * @param int $clientes_idclientes Clientes Idclientes
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idpedidos, $clientes_idclientes)
    {
        $this->findModel($idpedidos, $clientes_idclientes)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedidos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idpedidos Idpedidos
     * @param int $clientes_idclientes Clientes Idclientes
     * @return Pedidos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idpedidos, $clientes_idclientes)
    {
        if (($model = Pedidos::findOne(['idpedidos' => $idpedidos, 'clientes_idclientes' => $clientes_idclientes])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
