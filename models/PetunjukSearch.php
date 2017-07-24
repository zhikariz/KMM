<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Petunjuk;

/**
 * PetunjukSearch represents the model behind the search form of `app\models\Petunjuk`.
 */
class PetunjukSearch extends Petunjuk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_petunjuk'], 'integer'],
            [['keterangan_petunjuk'], 'safe'],
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
        $query = Petunjuk::find();

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
            'id_petunjuk' => $this->id_petunjuk,
        ]);

        $query->andFilterWhere(['like', 'keterangan_petunjuk', $this->keterangan_petunjuk]);

        return $dataProvider;
    }
}
