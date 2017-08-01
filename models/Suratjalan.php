<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suratjalan".
 *
 * @property int $id_surat_jalan
 * @property int $kode_tahun
 * @property string $kode_satuan_kerja
 * @property string $kode_satker_pusat
 * @property int $no_dokumen
 * @property string $pengesah
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
class Suratjalan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suratjalan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_tahun', 'kode_satuan_kerja', 'kode_satker_pusat', 'no_dokumen', 'pengesah', 'perihal', 'id_user', 'waktu_input', 'file_dokumen'], 'required'],
            [['kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['kode_satuan_kerja', 'kode_satker_pusat', 'waktu_input'], 'string', 'max' => 50],
            [['pengesah', 'perihal', 'file_dokumen'], 'string', 'max' => 100],
            [['kode_satuan_kerja'], 'exist', 'skipOnError' => true, 'targetClass' => Satuankerja::className(), 'targetAttribute' => ['kode_satuan_kerja' => 'kode_satuan_kerja']],
            [['kode_satker_pusat'], 'exist', 'skipOnError' => true, 'targetClass' => Satkerpusat::className(), 'targetAttribute' => ['kode_satker_pusat' => 'kode_satker_pusat']],
            [['kode_tahun'], 'exist', 'skipOnError' => true, 'targetClass' => Tahun::className(), 'targetAttribute' => ['kode_tahun' => 'kode_tahun']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id_user']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_surat_jalan' => 'Id Surat Jalan',
            'kode_tahun' => 'Kode Tahun',
            'kode_satuan_kerja' => 'Kode Satuan Kerja',
            'kode_satker_pusat' => 'Kode Satker Pusat',
            'no_dokumen' => 'No Dokumen',
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
