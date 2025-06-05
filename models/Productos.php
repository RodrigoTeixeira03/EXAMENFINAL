<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $idproductos
 * @property int $categoria_idcategoria
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property float|null $precio
 * @property int|null $stock
 *
 * @property Categoria $categoriaIdcategoria
 * @property Detallepedido[] $detallepedidos
 */
class Productos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'precio', 'stock'], 'default', 'value' => null],
            [['categoria_idcategoria'], 'required'],
            [['categoria_idcategoria', 'stock'], 'integer'],
            [['descripcion'], 'string'],
            [['precio'], 'number'],
            [['nombre'], 'string', 'max' => 100],
            [['categoria_idcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['categoria_idcategoria' => 'idcategoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproductos' => Yii::t('app', 'Idproductos'),
            'categoria_idcategoria' => Yii::t('app', 'Categoria '),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'precio' => Yii::t('app', 'Precio'),
            'stock' => Yii::t('app', 'Stock'),
        ];
    }

    /**
     * Gets query for [[CategoriaIdcategoria]].
     *
     * @return \yii\db\ActiveQuery|CategoriaQuery
     */
    public function getCategoriaIdcategoria()
    {
        return $this->hasOne(Categoria::class, ['idcategoria' => 'categoria_idcategoria']);
    }

    /**
     * Gets query for [[Detallepedidos]].
     *
     * @return \yii\db\ActiveQuery|DetallepedidoQuery
     */
    public function getDetallepedidos()
    {
        return $this->hasMany(Detallepedido::class, ['productos_idproductos' => 'idproductos']);
    }

    /**
     * {@inheritdoc}
     * @return ProductosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductosQuery(get_called_class());
    }

}
