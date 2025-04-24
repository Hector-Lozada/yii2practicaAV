<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $idusuarios
 * @property string|null $nombre
 * @property string|null $email
 * @property string|null $telefono
 * @property string|null $tipo_usuario
 *
 * @property Inscripciones[] $inscripciones
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
            [['nombre', 'email', 'telefono', 'tipo_usuario'], 'default', 'value' => null],
            [['nombre', 'email'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 15],
            [['tipo_usuario'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idusuarios' => Yii::t('app', 'Idusuarios'),
            'nombre' => Yii::t('app', 'Nombre'),
            'email' => Yii::t('app', 'Email'),
            'telefono' => Yii::t('app', 'Telefono'),
            'tipo_usuario' => Yii::t('app', 'Tipo Usuario'),
        ];
    }

    /**
     * Gets query for [[Inscripciones]].
     *
     * @return \yii\db\ActiveQuery|InscripcionesQuery
     */
    public function getInscripciones()
    {
        return $this->hasMany(Inscripciones::class, ['usuario_id' => 'idusuarios']);
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
