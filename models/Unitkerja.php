<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unitkerja".
 *
 * @property string $kode_unit_kerja
 * @property string $keterangan_unit_kerja
 *
 * @property Administratif[] $administratifs
 * @property Dokumenmasuk[] $dokumenmasuks
 * @property Kendaraan[] $kendaraans
 * @property PinjRuangrapat[] $pinjRuangrapats
 * @property Projectmanagement[] $projectmanagements
 */
class Unitkerja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unitkerja';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_unit_kerja', 'ket_unit_kerja'], 'required'],
            [['kode_unit_kerja', 'ket_unit_kerja'], 'string', 'max' => 50],
            [['kode_unit_kerja'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_unit_kerja' => 'Kode Unit Kerja',
            'ket_unit_kerja' => 'Keterangan Unit Kerja',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministratifs()
    {
        return $this->hasMany(Administratif::className(), ['kode_unit_kerja' => 'kode_unit_kerja']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenmasuks()
    {
        return $this->hasMany(Dokumenmasuk::className(), ['kode_unit_kerja' => 'kode_unit_kerja']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKendaraans()
    {
        return $this->hasMany(Kendaraan::className(), ['kode_unit_kerja' => 'kode_unit_kerja']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPinjRuangrapats()
    {
        return $this->hasMany(PinjRuangrapat::className(), ['kode_unit_kerja' => 'kode_unit_kerja']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectmanagements()
    {
        return $this->hasMany(Projectmanagement::className(), ['kode_unit_kerja' => 'kode_unit_kerja']);
    }
}
