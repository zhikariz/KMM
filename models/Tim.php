<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tim".
 *
 * @property string $kode_tim
 * @property string $nama_tim
 *
 * @property Administratif[] $administratifs
 * @property Kendaraan[] $kendaraans
 * @property PinjRuangrapat[] $pinjRuangrapats
 * @property Projectmanagement[] $projectmanagements
 */
class Tim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_tim', 'nama_tim'], 'required'],
            [['kode_tim', 'nama_tim'], 'string', 'max' => 50],
            [['kode_tim'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_tim' => 'Kode Tim',
            'nama_tim' => 'Nama Tim',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministratifs()
    {
        return $this->hasMany(Administratif::className(), ['kode_tim' => 'kode_tim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKendaraans()
    {
        return $this->hasMany(Kendaraan::className(), ['kode_tim' => 'kode_tim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPinjRuangrapats()
    {
        return $this->hasMany(PinjRuangrapat::className(), ['kode_tim' => 'kode_tim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectmanagements()
    {
        return $this->hasMany(Projectmanagement::className(), ['kode_tim' => 'kode_tim']);
    }
}
