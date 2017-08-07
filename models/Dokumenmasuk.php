<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dokumenmasuk".
 *
 * @property int $id_dokumen_masuk
 * @property int $no_dokumen
 * @property string $tgl_dokumen
 * @property string $perihal
 * @property string $asal_dokumen
 * @property string $format_dokumen
 * @property string $tgl_terima
 * @property string $kode_sifat_dokumen
 * @property string $tujuan_disposisi
 * @property string $petunjuk_disposisi
 * @property string $ket_disposisi_kepala
 * @property string $ket_disposisi_tim
 * @property string $ket_disposisi_unit
 * @property string $file_dokumen
 * @property int $id_user
 * @property string $waktu_input
 *
 * @property Sifatdokumen $kodeSifatDokumen
 * @property User $user
 */
class Dokumenmasuk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dokumenmasuk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_dokumen', 'tgl_dokumen', 'perihal', 'asal_dokumen', 'tgl_terima', 'kode_sifat_dokumen', 'tujuan_disposisi', 'petunjuk_disposisi', 'ket_disposisi_kepala', 'ket_disposisi_tim', 'ket_disposisi_unit', 'file_dokumen', 'id_user', 'waktu_input'], 'required'],
            [['no_dokumen', 'id_user'], 'integer'],
            [['tgl_dokumen', 'asal_dokumen', 'tgl_terima', 'kode_sifat_dokumen', 'waktu_input'], 'string', 'max' => 50],
            [['perihal', 'format_dokumen', 'ket_disposisi_kepala', 'ket_disposisi_tim', 'ket_disposisi_unit', 'file_dokumen'], 'string', 'max' => 100],
            [['tujuan_disposisi', 'petunjuk_disposisi'], 'string', 'max' => 300],
            [['kode_sifat_dokumen'], 'exist', 'skipOnError' => true, 'targetClass' => Sifatdokumen::className(), 'targetAttribute' => ['kode_sifat_dokumen' => 'kode_sifat_dokumen']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id_user']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dokumen_masuk' => 'Id Dokumen Masuk',
            'no_dokumen' => 'No Dokumen',
            'tgl_dokumen' => 'Tgl Dokumen',
            'perihal' => 'Perihal',
            'asal_dokumen' => 'Asal Dokumen',
            'tgl_terima' => 'Tgl Terima',
            'kode_sifat_dokumen' => 'Kode Sifat Dokumen',
            'tujuan_disposisi' => 'Tujuan Disposisi',
            'petunjuk_disposisi' => 'Petunjuk Disposisi',
            'ket_disposisi_kepala' => 'Ket Disposisi Kepala',
            'ket_disposisi_tim' => 'Ket Disposisi Tim',
            'ket_disposisi_unit' => 'Ket Disposisi Unit',
            'file_dokumen' => 'File Dokumen',
            'id_user' => 'Id User',
            'waktu_input' => 'Waktu Input',
        ];
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id_user' => 'id_user']);
    }
}
