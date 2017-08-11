<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hariliburtahunan;

/**
 * HariliburtahunanSearch represents the model behind the search form of `app\models\Hariliburtahunan`.
 */
class HariliburtahunanSearch extends Hariliburtahunan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_hari_libur'], 'integer'],
            [['waktu_hari_libur', 'ket_hari_libur'], 'safe'],
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
        $query = Hariliburtahunan::find();

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
            'id_hari_libur' => $this->id_hari_libur,
        ]);

        $query->andFilterWhere(['like', 'waktu_hari_libur', $this->waktu_hari_libur])
            ->andFilterWhere(['like', 'ket_hari_libur', $this->ket_hari_libur]);

        return $dataProvider;
    }
}
