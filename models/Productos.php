<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property float|null $precio
 * @property int|null $stock
 * @property int|null $categoria_id
 * @property string|null $talla
 * @property string|null $color
 * @property string|null $imagen_url
 * @property string|null $fecha_agregado
 *
 * @property Carrito[] $carritos
 * @property Categorias $categoria
 * @property PedidoDetalles[] $pedidoDetalles
 * @property Resenas[] $resenas
 */
class Productos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'precio', 'stock', 'categoria_id', 'talla', 'color', 'imagen_url', 'fecha_agregado'], 'default', 'value' => null],
            [['descripcion'], 'string'],
            [['precio'], 'number'],
            [['stock', 'categoria_id'], 'integer'],
            [['fecha_agregado'], 'safe'],
            [['nombre', 'imagen_url'], 'string', 'max' => 255],
            [['talla'], 'string', 'max' => 10],
            [['color'], 'string', 'max' => 50],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['categoria_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'precio' => Yii::t('app', 'Precio'),
            'stock' => Yii::t('app', 'Stock'),
            'categoria_id' => Yii::t('app', 'Categoria ID'),
            'talla' => Yii::t('app', 'Talla'),
            'color' => Yii::t('app', 'Color'),
            'imagen_url' => Yii::t('app', 'Imagen Url'),
            'fecha_agregado' => Yii::t('app', 'Fecha Agregado'),
        ];
    }

    /**
     * Gets query for [[Carritos]].
     *
     * @return \yii\db\ActiveQuery|CarritoQuery
     */
    public function getCarritos()
    {
        return $this->hasMany(Carrito::class, ['producto_id' => 'id']);
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery|CategoriasQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['id' => 'categoria_id']);
    }

    /**
     * Gets query for [[PedidoDetalles]].
     *
     * @return \yii\db\ActiveQuery|PedidoDetallesQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalles::class, ['producto_id' => 'id']);
    }

    /**
     * Gets query for [[Resenas]].
     *
     * @return \yii\db\ActiveQuery|ResenasQuery
     */
    public function getResenas()
    {
        return $this->hasMany(Resenas::class, ['producto_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductosQuery(get_called_class());
    }

}
