<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temp_dokumen_masuk".
 *
 * @property int $id_temp_dokumen_masuk
 * @property int $id_dokumen_masuk
 * @property string $no_dokumen
 * @property string $tgl_dokumen
 * @property string $perihal
 * @property string $asal_dokumen
 * @property string $tgl_terima
 * @property string $kode_sifat_dokumen
 * @property string $kesegeraan
 * @property string $dari
 * @property string $tujuan_disposisi
 * @property string $petunjuk_disposisi
 * @property string $ket_disposisi_kepala
 * @property string $ket_disposisi_tim
 * @property string $ket_disposisi_unit
 * @property string $file_dokumen
 * @property int $id_user
 * @property string $waktu_input
 * @property string $editor
 *
 * @property Dokumenmasuk $dokumenMasuk
 */
class TempDokumenMasuk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temp_dokumen_masuk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_dokumen_masuk', 'no_dokumen', 'tgl_dokumen', 'perihal', 'asal_dokumen', 'tgl_terima', 'kode_sifat_dokumen', 'kesegeraan', 'dari', 'tujuan_disposisi', 'petunjuk_disposisi', 'ket_disposisi_kepala', 'ket_disposisi_tim', 'ket_disposisi_unit', 'file_dokumen', 'id_user', 'waktu_input', 'editor'], 'required'],
            [['id_dokumen_masuk', 'id_user'], 'integer'],
            [['no_dokumen', 'perihal', 'asal_dokumen', 'tujuan_disposisi', 'petunjuk_disposisi', 'ket_disposisi_kepala', 'ket_disposisi_tim', 'ket_disposisi_unit', 'file_dokumen', 'editor'], 'string'],
            [['id_dokumen_masuk'], 'exist', 'skipOnError' => true, 'targetClass' => Dokumenmasuk::className(), 'targetAttribute' => ['id_dokumen_masuk' => 'id_dokumen_masuk']],
                        [['file_dokumen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_temp_dokumen_masuk' => 'Id Temp Dokumen Masuk',
            'id_dokumen_masuk' => 'Id Dokumen Masuk',
            'no_dokumen' => 'No Dokumen',
            'tgl_dokumen' => 'Tgl Dokumen',
            'perihal' => 'Perihal',
            'asal_dokumen' => 'Asal Dokumen',
            'tgl_terima' => 'Tgl Terima',
            'kode_sifat_dokumen' => 'Kode Sifat Dokumen',
            'kesegeraan' => 'Kesegeraan',
            'dari' => 'Dari',
            'tujuan_disposisi' => 'Tujuan Disposisi',
            'petunjuk_disposisi' => 'Petunjuk Disposisi',
            'ket_disposisi_kepala' => 'Ket Disposisi Kepala',
            'ket_disposisi_tim' => 'Ket Disposisi Tim',
            'ket_disposisi_unit' => 'Ket Disposisi Unit',
            'file_dokumen' => 'File Dokumen',
            'id_user' => 'Id User',
            'waktu_input' => 'Waktu Input',
            'editor' => 'Editor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenMasuk()
    {
        return $this->hasOne(Dokumenmasuk::className(), ['id_dokumen_masuk' => 'id_dokumen_masuk']);
    }
}
