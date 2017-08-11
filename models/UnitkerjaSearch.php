<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Unitkerja;

/**
 * UnitkerjaSearch represents the model behind the search form of `app\models\Unitkerja`.
 */
class UnitkerjaSearch extends Unitkerja
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_unit_kerja', 'ket_unit_kerja'], 'safe'],
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
        $query = Unitkerja::find();

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
        $query->andFilterWhere(['like', 'kode_unit_kerja', $this->kode_unit_kerja])
            ->andFilterWhere(['like', 'ket_unit_kerja', $this->ket_unit_kerja]);

        return $dataProvider;
    }
}
