<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Suratjalan;

/**
 * SuratjalanSearch represents the model behind the search form of `app\models\Suratjalan`.
 */
class SuratjalanSearch extends Suratjalan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_surat_jalan', 'kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['kode_satuan_kerja','perihal', 'kode_satker_pusat', 'pengesah', 'waktu_input', 'file_dokumen'], 'safe'],
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
        $query = Suratjalan::find();

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
            'id_surat_jalan' => $this->id_surat_jalan,
            'kode_tahun' => $this->kode_tahun,
            'no_dokumen' => $this->no_dokumen,
            'id_user' => $this->id_user,
            'perihal'=>$this->perihal,
        ]);

        $query->andFilterWhere(['like', 'kode_satuan_kerja', $this->kode_satuan_kerja])
            ->andFilterWhere(['like', 'kode_satker_pusat', $this->kode_satker_pusat])
            ->andFilterWhere(['like', 'pengesah', $this->pengesah])
            ->andFilterWhere(['like', 'waktu_input', $this->waktu_input])
            ->andFilterWhere(['like', 'file_dokumen', $this->file_dokumen])
            ->andFilterWhere(['like', 'perihal', $this->perihal]);

        return $dataProvider;
    }
}
