<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administratif".
 *
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
 *
 * @property Jenisdokumen $kodeJenisDokumen
 * @property Sifatdokumen $kodeSifatDokumen
 * @property Tahun $kodeTahun
 * @property User $user
 */
class Administratif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administratif';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_dokumen','kode_tahun','kode_jenis_dokumen','kode_sifat_dokumen','id_user', 'pengesah', 'perihal','waktu_input'], 'required'],
            [['no_dokumen', 'kode_tahun', 'id_user'], 'integer'],
            [['persetujuan','ket_persetujuan','format_dokumen', 'kode_jenis_dokumen', 'kode_sifat_dokumen', 'waktu_input'], 'string' ],
            [['kode_jenis_dokumen'], 'exist', 'skipOnError' => true, 'targetClass' => Jenisdokumen::className(), 'targetAttribute' => ['kode_jenis_dokumen' => 'kode_jenis_dokumen']],
            [['kode_sifat_dokumen'], 'exist', 'skipOnError' => true, 'targetClass' => Sifatdokumen::className(), 'targetAttribute' => ['kode_sifat_dokumen' => 'kode_sifat_dokumen']],
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
            'id_surat_adm' => 'Id Surat Adm',
            'no_dokumen' => 'No Dokumen',
            'kode_tahun' => 'Kode Tahun',
            'format_dokumen' => 'Format Dokumen',
            'pengesah' => 'Pengesah',
            'kode_jenis_dokumen' => 'Kode Jenis Dokumen',
            'kode_sifat_dokumen' => 'Kode Sifat Dokumen',
            'perihal' => 'Perihal',
            'id_user' => 'Pembuat',
            'waktu_input' => 'Waktu Input',
            'file_dokumen' => 'File Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeJenisDokumen()
    {
        return $this->hasOne(Jenisdokumen::className(), ['kode_jenis_dokumen' => 'kode_jenis_dokumen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeSifatDokumen()
    {
        return $this->hasOne(Sifatdokumen::className(), ['kode_sifat_dokumen' => 'kode_sifat_dokumen']);
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
