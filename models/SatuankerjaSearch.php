<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Satuankerja;

/**
 * SatuankerjaSearch represents the model behind the search form of `app\models\Satuankerja`.
 */
class SatuankerjaSearch extends Satuankerja
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_satuan_kerja', 'ket_satuan_kerja'], 'safe'],
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
        $query = Satuankerja::find();

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
        $query->andFilterWhere(['like', 'kode_satuan_kerja', $this->kode_satuan_kerja])
            ->andFilterWhere(['like', 'ket_satuan_kerja', $this->ket_satuan_kerja]);

        return $dataProvider;
    }
}
