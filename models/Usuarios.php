<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $email
 * @property string|null $contraseña
 * @property string|null $fecha_registro
 *
 * @property Carrito[] $carritos
 * @property Direcciones[] $direcciones
 * @property Pedidos[] $pedidos
 * @property Resenas[] $resenas
 */
class Usuarios extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'email', 'contraseña', 'fecha_registro'], 'default', 'value' => null],
            [['fecha_registro'], 'safe'],
            [['nombre', 'email'], 'string', 'max' => 100],
            [['contraseña'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'email' => Yii::t('app', 'Email'),
            'contraseña' => Yii::t('app', 'Contraseña'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
        ];
    }

    /**
     * Gets query for [[Carritos]].
     *
     * @return \yii\db\ActiveQuery|CarritoQuery
     */
    public function getCarritos()
    {
        return $this->hasMany(Carrito::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Direcciones]].
     *
     * @return \yii\db\ActiveQuery|DireccionesQuery
     */
    public function getDirecciones()
    {
        return $this->hasMany(Direcciones::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery|PedidosQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Resenas]].
     *
     * @return \yii\db\ActiveQuery|ResenasQuery
     */
    public function getResenas()
    {
        return $this->hasMany(Resenas::class, ['usuario_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UsuariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosQuery(get_called_class());
    }

}
