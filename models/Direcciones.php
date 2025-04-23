<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "direcciones".
 *
 * @property int $id
 * @property int|null $usuario_id
 * @property string|null $pais
 * @property string|null $ciudad
 * @property string|null $direccion_detallada
 * @property string|null $codigo_postal
 * @property string|null $telefono
 *
 * @property Pedidos[] $pedidos
 * @property Usuarios $usuario
 */
class Direcciones extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direcciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'pais', 'ciudad', 'direccion_detallada', 'codigo_postal', 'telefono'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['direccion_detallada'], 'string'],
            [['pais', 'ciudad'], 'string', 'max' => 100],
            [['codigo_postal', 'telefono'], 'string', 'max' => 20],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'id']],
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
            'pais' => Yii::t('app', 'Pais'),
            'ciudad' => Yii::t('app', 'Ciudad'),
            'direccion_detallada' => Yii::t('app', 'Direccion Detallada'),
            'codigo_postal' => Yii::t('app', 'Codigo Postal'),
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
        return $this->hasMany(Pedidos::class, ['direccion_id' => 'id']);
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
     * @return DireccionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DireccionesQuery(get_called_class());
    }

}
