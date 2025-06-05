<?php

namespace app\controllers;

use app\models\Productos;
use app\models\ProductosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
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
     * Lists all Productos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productos model.
     * @param int $idproductos Idproductos
     * @param int $categoria_idcategoria Categoria Idcategoria
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idproductos, $categoria_idcategoria)
    {
        return $this->render('view', [
            'model' => $this->findModel($idproductos, $categoria_idcategoria),
        ]);
    }

    /**
     * Creates a new Productos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Productos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idproductos' => $model->idproductos, 'categoria_idcategoria' => $model->categoria_idcategoria]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Productos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idproductos Idproductos
     * @param int $categoria_idcategoria Categoria Idcategoria
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idproductos, $categoria_idcategoria)
    {
        $model = $this->findModel($idproductos, $categoria_idcategoria);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idproductos' => $model->idproductos, 'categoria_idcategoria' => $model->categoria_idcategoria]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Productos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idproductos Idproductos
     * @param int $categoria_idcategoria Categoria Idcategoria
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idproductos, $categoria_idcategoria)
    {
        $this->findModel($idproductos, $categoria_idcategoria)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idproductos Idproductos
     * @param int $categoria_idcategoria Categoria Idcategoria
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idproductos, $categoria_idcategoria)
    {
        if (($model = Productos::findOne(['idproductos' => $idproductos, 'categoria_idcategoria' => $categoria_idcategoria])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
