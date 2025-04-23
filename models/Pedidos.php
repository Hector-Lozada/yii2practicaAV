<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedidos".
 *
 * @property int $id
 * @property int|null $usuario_id
 * @property int|null $direccion_id
 * @property string|null $fecha_pedido
 * @property string|null $estado
 * @property float|null $total
 * @property string|null $metodo_pago
 *
 * @property Direcciones $direccion
 * @property PedidoDetalles[] $pedidoDetalles
 * @property Usuarios $usuario
 */
class Pedidos extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTADO_PENDIENTE = 'pendiente';
    const ESTADO_ENVIADO = 'enviado';
    const ESTADO_ENTREGADO = 'entregado';
    const ESTADO_CANCELADO = 'cancelado';

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
            [['usuario_id', 'direccion_id', 'fecha_pedido', 'estado', 'total', 'metodo_pago'], 'default', 'value' => null],
            [['usuario_id', 'direccion_id'], 'integer'],
            [['fecha_pedido'], 'safe'],
            [['estado'], 'string'],
            [['total'], 'number'],
            [['metodo_pago'], 'string', 'max' => 50],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'id']],
            [['direccion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direcciones::class, 'targetAttribute' => ['direccion_id' => 'id']],
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
            'direccion_id' => Yii::t('app', 'Direccion ID'),
            'fecha_pedido' => Yii::t('app', 'Fecha Pedido'),
            'estado' => Yii::t('app', 'Estado'),
            'total' => Yii::t('app', 'Total'),
            'metodo_pago' => Yii::t('app', 'Metodo Pago'),
        ];
    }

    /**
     * Gets query for [[Direccion]].
     *
     * @return \yii\db\ActiveQuery|DireccionesQuery
     */
    public function getDireccion()
    {
        return $this->hasOne(Direcciones::class, ['id' => 'direccion_id']);
    }

    /**
     * Gets query for [[PedidoDetalles]].
     *
     * @return \yii\db\ActiveQuery|PedidoDetallesQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalles::class, ['pedido_id' => 'id']);
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
     * @return PedidosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PedidosQuery(get_called_class());
    }


    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_PENDIENTE => Yii::t('app', 'pendiente'),
            self::ESTADO_ENVIADO => Yii::t('app', 'enviado'),
            self::ESTADO_ENTREGADO => Yii::t('app', 'entregado'),
            self::ESTADO_CANCELADO => Yii::t('app', 'cancelado'),
        ];
    }

    /**
     * @return string
     */
    public function displayEstado()
    {
        return self::optsEstado()[$this->estado];
    }

    /**
     * @return bool
     */
    public function isEstadoPendiente()
    {
        return $this->estado === self::ESTADO_PENDIENTE;
    }

    public function setEstadoToPendiente()
    {
        $this->estado = self::ESTADO_PENDIENTE;
    }

    /**
     * @return bool
     */
    public function isEstadoEnviado()
    {
        return $this->estado === self::ESTADO_ENVIADO;
    }

    public function setEstadoToEnviado()
    {
        $this->estado = self::ESTADO_ENVIADO;
    }

    /**
     * @return bool
     */
    public function isEstadoEntregado()
    {
        return $this->estado === self::ESTADO_ENTREGADO;
    }

    public function setEstadoToEntregado()
    {
        $this->estado = self::ESTADO_ENTREGADO;
    }

    /**
     * @return bool
     */
    public function isEstadoCancelado()
    {
        return $this->estado === self::ESTADO_CANCELADO;
    }

    public function setEstadoToCancelado()
    {
        $this->estado = self::ESTADO_CANCELADO;
    }
}
