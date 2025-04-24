<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inscripciones".
 *
 * @property int $idinscripciones
 * @property int|null $usuario_id
 * @property int|null $evento_id
 * @property string|null $fecha_inscripcion
 *
 * @property Eventos $evento
 * @property Usuarios $usuario
 */
class Inscripciones extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inscripciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'evento_id', 'fecha_inscripcion'], 'default', 'value' => null],
            [['usuario_id', 'evento_id'], 'integer'],
            [['fecha_inscripcion'], 'safe'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'idusuarios']],
            [['evento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::class, 'targetAttribute' => ['evento_id' => 'ideventos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idinscripciones' => Yii::t('app', 'Idinscripciones'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'evento_id' => Yii::t('app', 'Evento ID'),
            'fecha_inscripcion' => Yii::t('app', 'Fecha Inscripcion'),
        ];
    }

    /**
     * Gets query for [[Evento]].
     *
     * @return \yii\db\ActiveQuery|EventosQuery
     */
    public function getEvento()
    {
        return $this->hasOne(Eventos::class, ['ideventos' => 'evento_id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['idusuarios' => 'usuario_id']);
    }

    /**
     * {@inheritdoc}
     * @return InscripcionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InscripcionesQuery(get_called_class());
    }

}
