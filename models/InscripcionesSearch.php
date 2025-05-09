<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inscripciones;

/**
 * InscripcionesSearch represents the model behind the search form of `app\models\Inscripciones`.
 */
class InscripcionesSearch extends Inscripciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idinscripciones', 'usuario_id', 'evento_id', 'asistencia', 'certificado_generado', 'calificacion'], 'integer'],
            [['fecha_inscripcion', 'feedback'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Inscripciones::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idinscripciones' => $this->idinscripciones,
            'usuario_id' => $this->usuario_id,
            'evento_id' => $this->evento_id,
            'fecha_inscripcion' => $this->fecha_inscripcion,
            'asistencia' => $this->asistencia,
            'certificado_generado' => $this->certificado_generado,
            'calificacion' => $this->calificacion,
        ]);

        $query->andFilterWhere(['like', 'feedback', $this->feedback]);

        return $dataProvider;
    }
}
