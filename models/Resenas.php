<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resenas".
 *
 * @property int $id
 * @property int|null $usuario_id
 * @property int|null $producto_id
 * @property int|null $puntuacion
 * @property string|null $comentario
 * @property string|null $fecha_resena
 *
 * @property Productos $producto
 * @property Usuarios $usuario
 */
class Resenas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resenas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'producto_id', 'puntuacion', 'comentario', 'fecha_resena'], 'default', 'value' => null],
            [['usuario_id', 'producto_id', 'puntuacion'], 'integer'],
            [['comentario'], 'string'],
            [['fecha_resena'], 'safe'],
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
            'puntuacion' => Yii::t('app', 'Puntuacion'),
            'comentario' => Yii::t('app', 'Comentario'),
            'fecha_resena' => Yii::t('app', 'Fecha Resena'),
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
     * @return ResenasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResenasQuery(get_called_class());
    }

}
