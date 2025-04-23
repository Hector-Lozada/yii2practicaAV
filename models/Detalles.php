<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_detalles".
 *
 * @property int $id
 * @property int|null $pedido_id
 * @property int|null $producto_id
 * @property int|null $cantidad
 * @property float|null $precio_unitario
 *
 * @property Pedidos $pedido
 * @property Productos $producto
 */
class Detalles extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido_detalles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pedido_id', 'producto_id', 'cantidad', 'precio_unitario'], 'default', 'value' => null],
            [['pedido_id', 'producto_id', 'cantidad'], 'integer'],
            [['precio_unitario'], 'number'],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::class, 'targetAttribute' => ['pedido_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['producto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pedido_id' => Yii::t('app', 'Pedido ID'),
            'producto_id' => Yii::t('app', 'Producto ID'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'precio_unitario' => Yii::t('app', 'Precio Unitario'),
        ];
    }

    /**
     * Gets query for [[Pedido]].
     *
     * @return \yii\db\ActiveQuery|PedidosQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedidos::class, ['id' => 'pedido_id']);
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery|ProductosQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Productos::class, ['id' => 'producto_id']);
    }

    /**
     * {@inheritdoc}
     * @return DetallesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetallesQuery(get_called_class());
    }

}
