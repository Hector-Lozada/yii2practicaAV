<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Multimedia;

/**
 * MultimediaSearch represents the model behind the search form of `app\models\Multimedia`.
 */
class MultimediaSearch extends Multimedia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmultimedia', 'idevento', 'es_principal', 'orden'], 'integer'],
            [['tipo', 'ruta_archivo', 'titulo', 'descripcion', 'created_at'], 'safe'],
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
        $query = Multimedia::find();

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
            'idmultimedia' => $this->idmultimedia,
            'idevento' => $this->idevento,
            'es_principal' => $this->es_principal,
            'orden' => $this->orden,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'ruta_archivo', $this->ruta_archivo])
            ->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
