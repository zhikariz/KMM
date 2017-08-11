<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenisdokumen".
 *
 * @property string $kode_jenis_dokumen
 * @property string $ket_jenis_dokumen
 * @property string $format_jenis_dokumen
 *
 * @property Administratif[] $administratifs
 * @property SkKepwakilGubSjalan[] $skKepwakilGubSjalans
 */
class Jenisdokumen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenisdokumen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_jenis_dokumen', 'ket_jenis_dokumen'], 'required'],
            [['kode_jenis_dokumen', 'ket_jenis_dokumen', 'format_jenis_dokumen'], 'string', 'max' => 50],
            [['kode_jenis_dokumen'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_jenis_dokumen' => 'Kode Jenis Dokumen',
            'ket_jenis_dokumen' => 'Ket Jenis Dokumen',
            'format_jenis_dokumen' => 'Format Jenis Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministratifs()
    {
        return $this->hasMany(Administratif::className(), ['kode_jenis_dokumen' => 'kode_jenis_dokumen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkKepwakilGubSjalans()
    {
        return $this->hasMany(SkKepwakilGubSjalan::className(), ['kode_jenis_dokumen' => 'kode_jenis_dokumen']);
    }
}
