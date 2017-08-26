<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TempSkKepwakilGub;

/**
 * TempSkKepwakilGubSearch represents the model behind the search form of `app\models\TempSkKepwakilGub`.
 */
class TempSkKepwakilGubSearch extends TempSkKepwakilGub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_temp_sk_kep_wakil_gub', 'id_sk_kepwakil_gub', 'kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['format_dokumen', 'perihal', 'pengesah', 'waktu_input', 'file_dokumen', 'editor'], 'safe'],
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
    public function search($params,$kode)
    {
        $query = TempSkKepwakilGub::find()->where(['format_dokumen'=>$kode]);

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
            'id_temp_sk_kep_wakil_gub' => $this->id_temp_sk_kep_wakil_gub,
            'id_sk_kepwakil_gub' => $this->id_sk_kepwakil_gub,
            'kode_tahun' => $this->kode_tahun,
            'no_dokumen' => $this->no_dokumen,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'format_dokumen', $this->format_dokumen])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'pengesah', $this->pengesah])
            ->andFilterWhere(['like', 'waktu_input', $this->waktu_input])
            ->andFilterWhere(['like', 'file_dokumen', $this->file_dokumen])
            ->andFilterWhere(['like', 'editor', $this->editor]);

        return $dataProvider;
    }
}
