<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jenisdokumen;

/**
 * JenisdokumenSearch represents the model behind the search form of `app\models\Jenisdokumen`.
 */
class JenisdokumenSearch extends Jenisdokumen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_jenis_dokumen', 'ket_jenis_dokumen', 'format_jenis_dokumen'], 'safe'],
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
        $query = Jenisdokumen::find();

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
        $query->andFilterWhere(['like', 'kode_jenis_dokumen', $this->kode_jenis_dokumen])
            ->andFilterWhere(['like', 'ket_jenis_dokumen', $this->ket_jenis_dokumen])
            ->andFilterWhere(['like', 'format_jenis_dokumen', $this->format_jenis_dokumen]);

        return $dataProvider;
    }
}
