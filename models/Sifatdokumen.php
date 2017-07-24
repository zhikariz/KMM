<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sifatdokumen".
 *
 * @property string $kode_sifat_dokumen
 * @property string $ket_sifat_dokumen
 *
 * @property Administratif[] $administratifs
 * @property Dokumenmasuk[] $dokumenmasuks
 */
class Sifatdokumen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sifatdokumen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_sifat_dokumen', 'ket_sifat_dokumen'], 'required'],
            [['kode_sifat_dokumen', 'ket_sifat_dokumen'], 'string', 'max' => 50],
            [['kode_sifat_dokumen'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_sifat_dokumen' => 'Kode Sifat Dokumen',
            'ket_sifat_dokumen' => 'Ket Sifat Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministratifs()
    {
        return $this->hasMany(Administratif::className(), ['kode_sifat_dokumen' => 'kode_sifat_dokumen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenmasuks()
    {
        return $this->hasMany(Dokumenmasuk::className(), ['kode_sifat_dokumen' => 'kode_sifat_dokumen']);
    }
}
