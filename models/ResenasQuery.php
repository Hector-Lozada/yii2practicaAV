<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Resenas]].
 *
 * @see Resenas
 */
class ResenasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Resenas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Resenas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
