<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eventos".
 *
 * @property int $ideventos
 * @property int|null $idcategoria
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $fecha_inicio
 * @property string|null $fecha_fin
 * @property string $ubicacion
 * @property string|null $imagen_portada
 * @property int|null $max_participantes
 * @property string|null $estado
 * @property string|null $created_at
 *
 * @property Comentarios[] $comentarios
 * @property Categorias $idcategoria0
 * @property Inscripciones[] $inscripciones
 * @property Multimedia[] $multimedia
 * @property Usuarios[] $usuarios
 */
class Eventos extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTADO_PLANIFICADO = 'planificado';
    const ESTADO_EN_CURSO = 'en_curso';
    const ESTADO_COMPLETADO = 'completado';
    const ESTADO_CANCELADO = 'cancelado';

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
            [['idcategoria', 'descripcion', 'fecha_fin', 'imagen_portada', 'max_participantes'], 'default', 'value' => null],
            [['estado'], 'default', 'value' => 'planificado'],
            [['idcategoria', 'max_participantes'], 'integer'],
            [['nombre', 'fecha_inicio', 'ubicacion'], 'required'],
            [['descripcion', 'estado'], 'string'],
            [['fecha_inicio', 'fecha_fin', 'created_at'], 'safe'],
            [['nombre', 'ubicacion'], 'string', 'max' => 100],
            [['imagen_portada'], 'string', 'max' => 255],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['idcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['idcategoria' => 'idcategorias']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ideventos' => Yii::t('app', 'Ideventos'),
            'idcategoria' => Yii::t('app', 'Idcategoria'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
            'fecha_fin' => Yii::t('app', 'Fecha Fin'),
            'ubicacion' => Yii::t('app', 'Ubicacion'),
            'imagen_portada' => Yii::t('app', 'Imagen Portada'),
            'max_participantes' => Yii::t('app', 'Max Participantes'),
            'estado' => Yii::t('app', 'Estado'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery|ComentariosQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::class, ['evento_id' => 'ideventos']);
    }

    /**
     * Gets query for [[Idcategoria0]].
     *
     * @return \yii\db\ActiveQuery|CategoriasQuery
     */
    public function getIdcategoria0()
    {
        return $this->hasOne(Categorias::class, ['idcategorias' => 'idcategoria']);
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
     * Gets query for [[Multimedia]].
     *
     * @return \yii\db\ActiveQuery|MultimediaQuery
     */
    public function getMultimedia()
    {
        return $this->hasMany(Multimedia::class, ['idevento' => 'ideventos']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::class, ['idusuarios' => 'usuario_id'])->viaTable('inscripciones', ['evento_id' => 'ideventos']);
    }

    /**
     * {@inheritdoc}
     * @return EventosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventosQuery(get_called_class());
    }


    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_PLANIFICADO => Yii::t('app', 'planificado'),
            self::ESTADO_EN_CURSO => Yii::t('app', 'en_curso'),
            self::ESTADO_COMPLETADO => Yii::t('app', 'completado'),
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
    public function isEstadoPlanificado()
    {
        return $this->estado === self::ESTADO_PLANIFICADO;
    }

    public function setEstadoToPlanificado()
    {
        $this->estado = self::ESTADO_PLANIFICADO;
    }

    /**
     * @return bool
     */
    public function isEstadoEncurso()
    {
        return $this->estado === self::ESTADO_EN_CURSO;
    }

    public function setEstadoToEncurso()
    {
        $this->estado = self::ESTADO_EN_CURSO;
    }

    /**
     * @return bool
     */
    public function isEstadoCompletado()
    {
        return $this->estado === self::ESTADO_COMPLETADO;
    }

    public function setEstadoToCompletado()
    {
        $this->estado = self::ESTADO_COMPLETADO;
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
