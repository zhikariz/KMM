<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temp_adm".
 *
 * @property int $id_temp_adm
 * @property int $id_surat_adm
 * @property int $no_dokumen
 * @property int $kode_tahun
 * @property string $format_dokumen
 * @property string $pengesah
 * @property string $kode_jenis_dokumen
 * @property string $kode_sifat_dokumen
 * @property string $perihal
 * @property int $id_user
 * @property string $waktu_input
 * @property string $file_dokumen
 * @property string $editor
 *
 * @property Administratif $suratAdm
 */
class TempAdm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temp_adm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_surat_adm', 'no_dokumen', 'kode_tahun', 'format_dokumen', 'pengesah', 'kode_jenis_dokumen', 'kode_sifat_dokumen', 'perihal', 'id_user', 'waktu_input', 'editor'], 'required'],
            [['id_surat_adm', 'no_dokumen', 'kode_tahun', 'id_user'], 'integer'],
            [['file_dokumen','pengesah', 'perihal', 'editor'], 'string'],
            [['id_surat_adm'], 'exist', 'skipOnError' => true, 'targetClass' => Administratif::className(), 'targetAttribute' => ['id_surat_adm' => 'id_surat_adm']],
            [['file_dokumen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_temp_adm' => 'Id Temp Adm',
            'id_surat_adm' => 'Id Surat Adm',
            'no_dokumen' => 'No Dokumen',
            'kode_tahun' => 'Kode Tahun',
            'format_dokumen' => 'Format Dokumen',
            'pengesah' => 'Pengesah',
            'kode_jenis_dokumen' => 'Kode Jenis Dokumen',
            'kode_sifat_dokumen' => 'Kode Sifat Dokumen',
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
    public function getSuratAdm()
    {
        return $this->hasOne(Administratif::className(), ['id_surat_adm' => 'id_surat_adm']);
    }
}
