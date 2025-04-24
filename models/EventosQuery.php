<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Eventos]].
 *
 * @see Eventos
 */
class EventosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Eventos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Eventos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
