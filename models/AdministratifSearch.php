<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Administratif;

/**
 * AdministratifSearch represents the model behind the search form of `app\models\Administratif`.
 */
class AdministratifSearch extends Administratif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_surat_adm', 'kode_tahun', 'id_user'], 'integer'],
            [['no_dokumen','format_dokumen', 'pengesah', 'kode_jenis_dokumen', 'kode_sifat_dokumen', 'perihal', 'waktu_input', 'file_dokumen'], 'safe'],
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
    public function search($params,$kode,$sifat)
    {
      switch (Yii::$app->user->identity->role->ket_role) {
    case 'Administrator':
        $query = Administratif::find()->where(['kode_jenis_dokumen'=>$kode,'kode_sifat_dokumen'=>$sifat]);
        break;
    case 'Operator':
        $query =Administratif::find()->where(['kode_jenis_dokumen'=>$kode,'kode_sifat_dokumen'=>$sifat]);
        break;
    case 'Approval':
        $query =Administratif::find()->where(['kode_jenis_dokumen'=>$kode,'kode_sifat_dokumen'=>$sifat])
        ;
        break;
        }



        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 5 ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'no_dokumen' => $this->no_dokumen,
            'id_surat_adm' => $this->id_surat_adm,
            'kode_tahun' => $this->kode_tahun,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'format_dokumen', $this->format_dokumen])
        ->andFilterWhere(['like', 'no_dokumen', $this->no_dokumen])
            ->andFilterWhere(['like', 'pengesah', $this->pengesah])
            ->andFilterWhere(['like', 'kode_jenis_dokumen', $this->kode_jenis_dokumen])
            ->andFilterWhere(['like', 'kode_sifat_dokumen', $this->kode_sifat_dokumen])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'waktu_input', $this->waktu_input])
            ->andFilterWhere(['like', 'file_dokumen', $this->file_dokumen]);

        return $dataProvider;
    }
}
