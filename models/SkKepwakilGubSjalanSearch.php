<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SkKepwakilGubSjalan;

/**
 * SkKepwakilGubSjalanSearch represents the model behind the search form of `app\models\SkKepwakilGubSjalan`.
 */
class SkKepwakilGubSjalanSearch extends SkKepwakilGubSjalan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sk_kepwakil_gub_sjalan', 'kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['no_dokumen', 'perihal', 'pengesah', 'waktu_input', 'file_dokumen'], 'safe'],
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
        $query = SkKepwakilGubSjalan::find();

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
            'kode_tahun' => $this->kode_tahun,
            'no_dokumen' => $this->no_dokumen,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'kode_jenis_dokumen', $this->kode_jenis_dokumen])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'pengesah', $this->pengesah])
            ->andFilterWhere(['like', 'waktu_input', $this->waktu_input])
            ->andFilterWhere(['like', 'file_dokumen', $this->file_dokumen]);

        return $dataProvider;
    }
}
