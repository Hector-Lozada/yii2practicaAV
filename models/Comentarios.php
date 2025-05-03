<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $idcomentarios
 * @property int $usuario_id
 * @property int $evento_id
 * @property string $contenido
 * @property string|null $multimedia_path
 * @property string|null $created_at
 *
 * @property Eventos $evento
 * @property Usuarios $usuario
 */
class Comentarios extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['multimedia_path'], 'default', 'value' => null],
            [['usuario_id', 'evento_id', 'contenido'], 'required'],
            [['usuario_id', 'evento_id'], 'integer'],
            [['contenido'], 'string'],
            [['created_at'], 'safe'],
            [['multimedia_path'], 'string', 'max' => 255],
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
            'idcomentarios' => Yii::t('app', 'Idcomentarios'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'evento_id' => Yii::t('app', 'Evento ID'),
            'contenido' => Yii::t('app', 'Contenido'),
            'multimedia_path' => Yii::t('app', 'Multimedia Path'),
            'created_at' => Yii::t('app', 'Created At'),
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
     * @return ComentariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ComentariosQuery(get_called_class());
    }

}
