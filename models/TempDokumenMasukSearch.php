<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TempDokumenMasuk;

/**
 * TempDokumenMasukSearch represents the model behind the search form of `app\models\TempDokumenMasuk`.
 */
class TempDokumenMasukSearch extends TempDokumenMasuk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_temp_dokumen_masuk', 'id_dokumen_masuk', 'id_user'], 'integer'],
            [['no_dokumen', 'tgl_dokumen', 'perihal', 'asal_dokumen', 'tgl_terima', 'kode_sifat_dokumen', 'kesegeraan', 'dari', 'tujuan_disposisi', 'petunjuk_disposisi', 'ket_disposisi_kepala', 'ket_disposisi_tim', 'ket_disposisi_unit', 'file_dokumen', 'waktu_input', 'editor'], 'safe'],
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
    public function search($params,$sifat)
    {
        $query = TempDokumenMasuk::find()->where(['kode_sifat_dokumen'=>$sifat])->andWhere(['<>','editor',Yii::$app->user->identity->nama_user]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>5],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_temp_dokumen_masuk' => $this->id_temp_dokumen_masuk,
            'id_dokumen_masuk' => $this->id_dokumen_masuk,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'no_dokumen', $this->no_dokumen])
            ->andFilterWhere(['like', 'tgl_dokumen', $this->tgl_dokumen])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'asal_dokumen', $this->asal_dokumen])
            ->andFilterWhere(['like', 'tgl_terima', $this->tgl_terima])
            ->andFilterWhere(['like', 'kode_sifat_dokumen', $this->kode_sifat_dokumen])
            ->andFilterWhere(['like', 'kesegeraan', $this->kesegeraan])
            ->andFilterWhere(['like', 'dari', $this->dari])
            ->andFilterWhere(['like', 'tujuan_disposisi', $this->tujuan_disposisi])
            ->andFilterWhere(['like', 'petunjuk_disposisi', $this->petunjuk_disposisi])
            ->andFilterWhere(['like', 'ket_disposisi_kepala', $this->ket_disposisi_kepala])
            ->andFilterWhere(['like', 'ket_disposisi_tim', $this->ket_disposisi_tim])
            ->andFilterWhere(['like', 'ket_disposisi_unit', $this->ket_disposisi_unit])
            ->andFilterWhere(['like', 'file_dokumen', $this->file_dokumen])
            ->andFilterWhere(['like', 'waktu_input', $this->waktu_input])
            ->andFilterWhere(['like', 'editor', $this->editor]);

        return $dataProvider;
    }
}
