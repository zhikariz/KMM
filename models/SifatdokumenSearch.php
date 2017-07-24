<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sifatdokumen;

/**
 * SifatdokumenSearch represents the model behind the search form of `app\models\Sifatdokumen`.
 */
class SifatdokumenSearch extends Sifatdokumen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_sifat_dokumen', 'ket_sifat_dokumen'], 'safe'],
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
        $query = Sifatdokumen::find();

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
        $query->andFilterWhere(['like', 'kode_sifat_dokumen', $this->kode_sifat_dokumen])
            ->andFilterWhere(['like', 'ket_sifat_dokumen', $this->ket_sifat_dokumen]);

        return $dataProvider;
    }
}
