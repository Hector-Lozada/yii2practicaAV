<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Inscripciones]].
 *
 * @see Inscripciones
 */
class InscripcionesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Inscripciones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Inscripciones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
