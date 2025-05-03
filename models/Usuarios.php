<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $idusuarios
 * @property string $nombre
 * @property string $email
 * @property string $password
 * @property string|null $telefono
 * @property string $tipo_usuario
 * @property string|null $avatar_path
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Comentarios[] $comentarios
 * @property Eventos[] $eventos
 * @property Inscripciones[] $inscripciones
 */
class Usuarios extends \yii\db\ActiveRecord
{
    public $imageFile; // Atributo para el archivo de imagen

    /**
     * ENUM field values
     */
    const TIPO_USUARIO_ADMIN = 'admin';
    const TIPO_USUARIO_ORGANIZADOR = 'organizador';
    const TIPO_USUARIO_PARTICIPANTE = 'participante';

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
            [['telefono'], 'default', 'value' => null],
            [['tipo_usuario'], 'default', 'value' => 'participante'],
            [['nombre', 'email', 'password'], 'required'],
            [['tipo_usuario'], 'string'],
            [['avatar_path'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 5 * 1024 * 1024], // 5MB
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'email'], 'string', 'max' => 100],
            [['password', 'avatar_path'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 15],
            ['tipo_usuario', 'in', 'range' => array_keys(self::optsTipoUsuario())],
            [['email'], 'unique'],
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
            'password' => Yii::t('app', 'Password'),
            'telefono' => Yii::t('app', 'Telefono'),
            'tipo_usuario' => Yii::t('app', 'Tipo Usuario'),
            'avatar_path' => 'Imagen',
            'imageFile' => 'Subir Imagen',
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery|ComentariosQuery
     */
    public function upload()
    {
        if ($this->imageFile) {
            $uploadDir = Yii::getAlias('@webroot/uploads/avatars/');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $fileName = uniqid() . '.' . $this->imageFile->extension;
            $filePath = $uploadDir . $fileName;

            if ($this->imageFile->saveAs($filePath)) {
                $this->avatar_path = '/uploads/avatars/' . $fileName;
                return true;
            }
        }
        return false;
    }

    /**
     * Elimina la imagen asociada
     */
    public function deleteImage()
    {
        if ($this->avatar_path && file_exists(Yii::getAlias('@webroot' . $this->avatar_path))) {
            unlink(Yii::getAlias('@webroot' . $this->avatar_path));
            return true;
        }
        return false;
    }

    /**
     * Before delete hook
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $this->deleteImage();
        return true;
    }

    public function getComentarios()
    {
        return $this->hasMany(Comentarios::class, ['usuario_id' => 'idusuarios']);
    }

    /**
     * Gets query for [[Eventos]].
     *
     * @return \yii\db\ActiveQuery|EventosQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Eventos::class, ['ideventos' => 'evento_id'])->viaTable('inscripciones', ['usuario_id' => 'idusuarios']);
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


    /**
     * column tipo_usuario ENUM value labels
     * @return string[]
     */
    public static function optsTipoUsuario()
    {
        return [
            self::TIPO_USUARIO_ADMIN => Yii::t('app', 'admin'),
            self::TIPO_USUARIO_ORGANIZADOR => Yii::t('app', 'organizador'),
            self::TIPO_USUARIO_PARTICIPANTE => Yii::t('app', 'participante'),
        ];
    }

    /**
     * @return string
     */
    public function displayTipoUsuario()
    {
        return self::optsTipoUsuario()[$this->tipo_usuario];
    }

    /**
     * @return bool
     */
    public function isTipoUsuarioAdmin()
    {
        return $this->tipo_usuario === self::TIPO_USUARIO_ADMIN;
    }

    public function setTipoUsuarioToAdmin()
    {
        $this->tipo_usuario = self::TIPO_USUARIO_ADMIN;
    }

    /**
     * @return bool
     */
    public function isTipoUsuarioOrganizador()
    {
        return $this->tipo_usuario === self::TIPO_USUARIO_ORGANIZADOR;
    }

    public function setTipoUsuarioToOrganizador()
    {
        $this->tipo_usuario = self::TIPO_USUARIO_ORGANIZADOR;
    }

    /**
     * @return bool
     */
    public function isTipoUsuarioParticipante()
    {
        return $this->tipo_usuario === self::TIPO_USUARIO_PARTICIPANTE;
    }

    public function setTipoUsuarioToParticipante()
    {
        $this->tipo_usuario = self::TIPO_USUARIO_PARTICIPANTE;
    }
}
