<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notadebet;

/**
 * NotadebetSearch represents the model behind the search form of `app\models\Notadebet`.
 */
class NotadebetSearch extends Notadebet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nota_debet', 'kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['kode_satuan_kerja','pengesah', 'kode_satker_pusat', 'perihal', 'waktu_input', 'file_dokumen'], 'safe'],
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

        switch (Yii::$app->user->identity->role->ket_role) {
      case 'Administrator':
          $query = Notadebet::find();
          break;
      case 'Operator':
          $query = Notadebet::findBySql('SELECT * FROM notadebet WHERE (persetujuan = "Disetujui" OR persetujuan = "Ditolak")');
          break;
      case 'Approval':
          $query = Notadebet::find()->where(['persetujuan'=>'Belum Disetujui']);
          break;

  }

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
            'id_nota_debet' => $this->id_nota_debet,
            'kode_tahun' => $this->kode_tahun,
            'no_dokumen' => $this->no_dokumen,
            'id_user' => $this->id_user,
            'pengesah'=>$this->pengesah,
        ]);

        $query->andFilterWhere(['like', 'kode_satuan_kerja', $this->kode_satuan_kerja])
            ->andFilterWhere(['like', 'kode_satker_pusat', $this->kode_satker_pusat])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'pengesah', $this->pengesah])
            ->andFilterWhere(['like', 'waktu_input', $this->waktu_input])
            ->andFilterWhere(['like', 'file_dokumen', $this->file_dokumen]);

        return $dataProvider;
    }
}
