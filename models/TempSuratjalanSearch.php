<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TempSuratjalan;

/**
 * TempSuratjalanSearch represents the model behind the search form of `app\models\TempSuratjalan`.
 */
class TempSuratjalanSearch extends TempSuratjalan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_temp_suratjalan', 'id_surat_jalan', 'kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['kode_satuan_kerja', 'format_dokumen', 'pengesah', 'perihal', 'waktu_input', 'file_dokumen', 'editor'], 'safe'],
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
        $query = TempSuratjalan::find();

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
            'id_temp_suratjalan' => $this->id_temp_suratjalan,
            'id_surat_jalan' => $this->id_surat_jalan,
            'kode_tahun' => $this->kode_tahun,
            'no_dokumen' => $this->no_dokumen,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'kode_satuan_kerja', $this->kode_satuan_kerja])
            ->andFilterWhere(['like', 'format_dokumen', $this->format_dokumen])
            ->andFilterWhere(['like', 'pengesah', $this->pengesah])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'waktu_input', $this->waktu_input])
            ->andFilterWhere(['like', 'file_dokumen', $this->file_dokumen])
            ->andFilterWhere(['like', 'editor', $this->editor]);

        return $dataProvider;
    }
}
