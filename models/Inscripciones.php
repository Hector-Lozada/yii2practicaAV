<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inscripciones".
 *
 * @property int $idinscripciones
 * @property int $usuario_id
 * @property int $evento_id
 * @property string|null $fecha_inscripcion
 * @property int|null $asistencia
 * @property int|null $certificado_generado
 * @property string|null $feedback
 * @property int|null $calificacion
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
            [['feedback', 'calificacion'], 'default', 'value' => null],
            [['certificado_generado'], 'default', 'value' => 0],
            [['usuario_id', 'evento_id'], 'required'],
            [['usuario_id', 'evento_id', 'asistencia', 'certificado_generado', 'calificacion'], 'integer'],
            [['fecha_inscripcion'], 'safe'],
            [['feedback'], 'string'],
            [['usuario_id', 'evento_id'], 'unique', 'targetAttribute' => ['usuario_id', 'evento_id']],
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
            'asistencia' => Yii::t('app', 'Asistencia'),
            'certificado_generado' => Yii::t('app', 'Certificado Generado'),
            'feedback' => Yii::t('app', 'Feedback'),
            'calificacion' => Yii::t('app', 'Calificacion'),
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
