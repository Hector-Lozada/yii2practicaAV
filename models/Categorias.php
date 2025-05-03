<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categorias".
 *
 * @property int $idcategorias
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $icono_path
 *
 * @property Eventos[] $eventos
 */
class Categorias extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'icono_path'], 'default', 'value' => null],
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 50],
            [['descripcion', 'icono_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcategorias' => Yii::t('app', 'Idcategorias'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'icono_path' => Yii::t('app', 'Icono Path'),
        ];
    }

    /**
     * Gets query for [[Eventos]].
     *
     * @return \yii\db\ActiveQuery|EventosQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Eventos::class, ['idcategoria' => 'idcategorias']);
    }

    /**
     * {@inheritdoc}
     * @return CategoriasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoriasQuery(get_called_class());
    }

}
