<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notadebet".
 *
 * @property int $id_nota_debet
 * @property int $kode_tahun
 * @property int $no_dokumen
 * @property string $kode_satuan_kerja
 * @property string $kode_satker_pusat
 * @property string $perihal
 * @property int $id_user
 * @property string $waktu_input
 * @property string $file_dokumen
 *
 * @property Satuankerja $kodeSatuanKerja
 * @property Satkerpusat $kodeSatkerPusat
 * @property Tahun $kodeTahun
 * @property User $user
 */
class Notadebet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notadebet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_tahun', 'no_dokumen', 'kode_satuan_kerja', 'kode_satker_pusat', 'pengesah', 'perihal', 'id_user', 'waktu_input'], 'required'],
            [['kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['kode_satuan_kerja'], 'exist', 'skipOnError' => true, 'targetClass' => Satuankerja::className(), 'targetAttribute' => ['kode_satuan_kerja' => 'kode_satuan_kerja']],
            [['kode_satker_pusat'], 'exist', 'skipOnError' => true, 'targetClass' => Satkerpusat::className(), 'targetAttribute' => ['kode_satker_pusat' => 'kode_satker_pusat']],
            [['kode_tahun'], 'exist', 'skipOnError' => true, 'targetClass' => Tahun::className(), 'targetAttribute' => ['kode_tahun' => 'kode_tahun']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id_user']],
            [['file_dokumen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_nota_debet' => 'Id Nota Debet',
            'kode_tahun' => 'Kode Tahun',
            'no_dokumen' => 'No Dokumen',
            'kode_satuan_kerja' => 'Kode Satuan Kerja',
            'kode_satker_pusat' => 'Kode Satker Pusat',
            'pengesah' => 'Pengesah',
            'perihal' => 'Perihal',
            'id_user' => 'Id User',
            'waktu_input' => 'Waktu Input',
            'file_dokumen' => 'File Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeSatuanKerja()
    {
        return $this->hasOne(Satuankerja::className(), ['kode_satuan_kerja' => 'kode_satuan_kerja']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeSatkerPusat()
    {
        return $this->hasOne(Satkerpusat::className(), ['kode_satker_pusat' => 'kode_satker_pusat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeTahun()
    {
        return $this->hasOne(Tahun::className(), ['kode_tahun' => 'kode_tahun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id_user' => 'id_user']);
    }
}
