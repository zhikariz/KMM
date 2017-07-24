<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pejabat;

/**
 * PejabatSearch represents the model behind the search form of `app\models\Pejabat`.
 */
class PejabatSearch extends Pejabat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pejabat'], 'integer'],
            [['nama_pejabat', 'unit_pejabat'], 'safe'],
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
        $query = Pejabat::find();

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
        $query->andFilterWhere([
            'id_pejabat' => $this->id_pejabat,
        ]);

        $query->andFilterWhere(['like', 'nama_pejabat', $this->nama_pejabat])
            ->andFilterWhere(['like', 'unit_pejabat', $this->unit_pejabat]);

        return $dataProvider;
    }
}
