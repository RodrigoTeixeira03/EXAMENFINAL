<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedidos".
 *
 * @property int $idpedidos
 * @property int $clientes_idclientes
 * @property string|null $fecha
 * @property float|null $total
 * @property string|null $estado
 *
 * @property Clientes $clientesIdclientes
 * @property Detallepedido[] $detallepedidos
 */
class Pedidos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'total', 'estado'], 'default', 'value' => null],
            [['clientes_idclientes'], 'required'],
            [['clientes_idclientes'], 'integer'],
            [['fecha'], 'safe'],
            [['total'], 'number'],
            [['estado'], 'string', 'max' => 250],
            [['clientes_idclientes'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::class, 'targetAttribute' => ['clientes_idclientes' => 'idclientes']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpedidos' => Yii::t('app', 'Idpedidos'),
            'clientes_idclientes' => Yii::t('app', 'Clientes '),
            'fecha' => Yii::t('app', 'Fecha'),
            'total' => Yii::t('app', 'Total'),
            'estado' => Yii::t('app', 'Estado'),
        ];
    }

    /**
     * Gets query for [[ClientesIdclientes]].
     *
     * @return \yii\db\ActiveQuery|ClientesQuery
     */
    public function getClientesIdclientes()
    {
        return $this->hasOne(Clientes::class, ['idclientes' => 'clientes_idclientes']);
    }

    /**
     * Gets query for [[Detallepedidos]].
     *
     * @return \yii\db\ActiveQuery|DetallepedidoQuery
     */
    public function getDetallepedidos()
    {
        return $this->hasMany(Detallepedido::class, ['pedidos_idpedidos' => 'idpedidos']);
    }

    /**
     * {@inheritdoc}
     * @return PedidosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PedidosQuery(get_called_class());
    }

}
