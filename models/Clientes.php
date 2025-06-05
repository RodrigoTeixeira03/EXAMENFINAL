<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $idclientes
 * @property string|null $nombre
 * @property string|null $correo
 * @property string|null $direccion
 * @property string|null $telefono
 *
 * @property Pedidos[] $pedidos
 */
class Clientes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'correo', 'direccion', 'telefono'], 'default', 'value' => null],
            [['nombre', 'correo', 'direccion'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 10],
            [['correo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idclientes' => Yii::t('app', 'Idclientes'),
            'nombre' => Yii::t('app', 'Nombre'),
            'correo' => Yii::t('app', 'Correo'),
            'direccion' => Yii::t('app', 'Direccion'),
            'telefono' => Yii::t('app', 'Telefono'),
        ];
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery|PedidosQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::class, ['clientes_idclientes' => 'idclientes']);
    }

    /**
     * {@inheritdoc}
     * @return ClientesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientesQuery(get_called_class());
    }

}
