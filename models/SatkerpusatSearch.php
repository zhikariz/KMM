<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Satkerpusat;

/**
 * SatkerpusatSearch represents the model behind the search form of `app\models\Satkerpusat`.
 */
class SatkerpusatSearch extends Satkerpusat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_satker_pusat', 'ket_satker_pusat'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Satkerpusat::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'kode_satker_pusat', $this->kode_satker_pusat])
            ->andFilterWhere(['like', 'ket_satker_pusat', $this->ket_satker_pusat]);

        return $dataProvider;
    }
}
