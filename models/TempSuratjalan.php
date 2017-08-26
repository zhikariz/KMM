<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temp_suratjalan".
 *
 * @property int $id_temp_suratjalan
 * @property int $id_surat_jalan
 * @property int $kode_tahun
 * @property string $kode_satuan_kerja
 * @property int $no_dokumen
 * @property string $format_dokumen
 * @property string $pengesah
 * @property string $perihal
 * @property int $id_user
 * @property string $waktu_input
 * @property string $file_dokumen
 * @property string $editor
 *
 * @property Suratjalan $suratJalan
 */
class TempSuratjalan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temp_suratjalan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_surat_jalan', 'kode_tahun', 'kode_satuan_kerja', 'no_dokumen', 'format_dokumen', 'pengesah', 'perihal', 'id_user', 'waktu_input', 'editor'], 'required'],
            [['id_surat_jalan', 'kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['pengesah', 'perihal', 'file_dokumen', 'editor'], 'string'],
            [['kode_satuan_kerja', 'waktu_input'], 'string', 'max' => 50],
            [['format_dokumen'], 'string', 'max' => 100],
            [['id_surat_jalan'], 'exist', 'skipOnError' => true, 'targetClass' => Suratjalan::className(), 'targetAttribute' => ['id_surat_jalan' => 'id_surat_jalan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_temp_suratjalan' => 'Id Temp Suratjalan',
            'id_surat_jalan' => 'Id Surat Jalan',
            'kode_tahun' => 'Kode Tahun',
            'kode_satuan_kerja' => 'Kode Satuan Kerja',
            'no_dokumen' => 'No Dokumen',
            'format_dokumen' => 'Format Dokumen',
            'pengesah' => 'Pengesah',
            'perihal' => 'Perihal',
            'id_user' => 'Id User',
            'waktu_input' => 'Waktu Input',
            'file_dokumen' => 'File Dokumen',
            'editor' => 'Editor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratJalan()
    {
        return $this->hasOne(Suratjalan::className(), ['id_surat_jalan' => 'id_surat_jalan']);
    }
}
