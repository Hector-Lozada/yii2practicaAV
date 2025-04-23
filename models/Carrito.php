<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carrito".
 *
 * @property int $id
 * @property int|null $usuario_id
 * @property int|null $producto_id
 * @property int|null $cantidad
 * @property string|null $fecha_agregado
 *
 * @property Productos $producto
 * @property Usuarios $usuario
 */
class Carrito extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'producto_id', 'cantidad', 'fecha_agregado'], 'default', 'value' => null],
            [['usuario_id', 'producto_id', 'cantidad'], 'integer'],
            [['fecha_agregado'], 'safe'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'id']],
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
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'producto_id' => Yii::t('app', 'Producto ID'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'fecha_agregado' => Yii::t('app', 'Fecha Agregado'),
        ];
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
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_id']);
    }

    /**
     * {@inheritdoc}
     * @return CarritoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CarritoQuery(get_called_class());
    }

}
