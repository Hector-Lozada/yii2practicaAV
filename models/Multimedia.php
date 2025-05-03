<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "multimedia".
 *
 * @property int $idmultimedia
 * @property int $idevento
 * @property string $tipo
 * @property string $ruta_archivo
 * @property string|null $titulo
 * @property string|null $descripcion
 * @property int|null $es_principal
 * @property int|null $orden
 * @property string|null $created_at
 *
 * @property Eventos $idevento0
 */
class Multimedia extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TIPO_IMAGEN = 'imagen';
    const TIPO_VIDEO = 'video';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'multimedia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion'], 'default', 'value' => null],
            [['orden'], 'default', 'value' => 0],
            [['idevento', 'tipo', 'ruta_archivo'], 'required'],
            [['idevento', 'es_principal', 'orden'], 'integer'],
            [['tipo', 'descripcion'], 'string'],
            [['created_at'], 'safe'],
            [['ruta_archivo'], 'string', 'max' => 255],
            [['titulo'], 'string', 'max' => 100],
            ['tipo', 'in', 'range' => array_keys(self::optsTipo())],
            [['idevento'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::class, 'targetAttribute' => ['idevento' => 'ideventos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmultimedia' => Yii::t('app', 'Idmultimedia'),
            'idevento' => Yii::t('app', 'Idevento'),
            'tipo' => Yii::t('app', 'Tipo'),
            'ruta_archivo' => Yii::t('app', 'Ruta Archivo'),
            'titulo' => Yii::t('app', 'Titulo'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'es_principal' => Yii::t('app', 'Es Principal'),
            'orden' => Yii::t('app', 'Orden'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Idevento0]].
     *
     * @return \yii\db\ActiveQuery|EventosQuery
     */
    public function getIdevento0()
    {
        return $this->hasOne(Eventos::class, ['ideventos' => 'idevento']);
    }

    /**
     * {@inheritdoc}
     * @return MultimediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MultimediaQuery(get_called_class());
    }


    /**
     * column tipo ENUM value labels
     * @return string[]
     */
    public static function optsTipo()
    {
        return [
            self::TIPO_IMAGEN => Yii::t('app', 'imagen'),
            self::TIPO_VIDEO => Yii::t('app', 'video'),
        ];
    }

    /**
     * @return string
     */
    public function displayTipo()
    {
        return self::optsTipo()[$this->tipo];
    }

    /**
     * @return bool
     */
    public function isTipoImagen()
    {
        return $this->tipo === self::TIPO_IMAGEN;
    }

    public function setTipoToImagen()
    {
        $this->tipo = self::TIPO_IMAGEN;
    }

    /**
     * @return bool
     */
    public function isTipoVideo()
    {
        return $this->tipo === self::TIPO_VIDEO;
    }

    public function setTipoToVideo()
    {
        $this->tipo = self::TIPO_VIDEO;
    }
}
