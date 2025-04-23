<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Detalles]].
 *
 * @see Detalles
 */
class DetallesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Detalles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Detalles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
