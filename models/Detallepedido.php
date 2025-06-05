<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detallepedido".
 *
 * @property int $iddetallepedido
 * @property int $pedidos_idpedidos
 * @property int $productos_idproductos
 * @property int|null $cantidad
 * @property float|null $subtotal
 *
 * @property Pedidos $pedidosIdpedidos
 * @property Productos $productosIdproductos
 */
class Detallepedido extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detallepedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidad', 'subtotal'], 'default', 'value' => null],
            [['pedidos_idpedidos', 'productos_idproductos'], 'required'],
            [['pedidos_idpedidos', 'productos_idproductos', 'cantidad'], 'integer'],
            [['subtotal'], 'number'],
            [['pedidos_idpedidos'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::class, 'targetAttribute' => ['pedidos_idpedidos' => 'idpedidos']],
            [['productos_idproductos'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['productos_idproductos' => 'idproductos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetallepedido' => Yii::t('app', 'Iddetallepedido'),
            'pedidos_idpedidos' => Yii::t('app', 'Pedidos '),
            'productos_idproductos' => Yii::t('app', 'Productos'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'subtotal' => Yii::t('app', 'Subtotal'),
        ];
    }

    /**
     * Gets query for [[PedidosIdpedidos]].
     *
     * @return \yii\db\ActiveQuery|PedidosQuery
     */
    public function getPedidosIdpedidos()
    {
        return $this->hasOne(Pedidos::class, ['idpedidos' => 'pedidos_idpedidos']);
    }

    /**
     * Gets query for [[ProductosIdproductos]].
     *
     * @return \yii\db\ActiveQuery|ProductosQuery
     */
    public function getProductosIdproductos()
    {
        return $this->hasOne(Productos::class, ['idproductos' => 'productos_idproductos']);
    }

    /**
     * {@inheritdoc}
     * @return DetallepedidoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetallepedidoQuery(get_called_class());
    }

}
