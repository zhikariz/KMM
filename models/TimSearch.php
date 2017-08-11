<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tim;

/**
 * TimSearch represents the model behind the search form of `app\models\Tim`.
 */
class TimSearch extends Tim
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_tim', 'nama_tim'], 'safe'],
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
        $query = Tim::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'kode_tim', $this->kode_tim])
            ->andFilterWhere(['like', 'nama_tim', $this->nama_tim]);

        return $dataProvider;
    }
}
