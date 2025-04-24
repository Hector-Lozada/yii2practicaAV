<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eventos".
 *
 * @property int $ideventos
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property string|null $fecha_evento
 * @property string|null $ubicacion
 *
 * @property Inscripciones[] $inscripciones
 */
class Eventos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'fecha_evento', 'ubicacion'], 'default', 'value' => null],
            [['fecha_evento'], 'safe'],
            [['nombre', 'ubicacion'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ideventos' => Yii::t('app', 'Ideventos'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'fecha_evento' => Yii::t('app', 'Fecha Evento'),
            'ubicacion' => Yii::t('app', 'Ubicacion'),
        ];
    }

    /**
     * Gets query for [[Inscripciones]].
     *
     * @return \yii\db\ActiveQuery|InscripcionesQuery
     */
    public function getInscripciones()
    {
        return $this->hasMany(Inscripciones::class, ['evento_id' => 'ideventos']);
    }

    /**
     * {@inheritdoc}
     * @return EventosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventosQuery(get_called_class());
    }

}
