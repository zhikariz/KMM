<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "satuankerja".
 *
 * @property string $kode_satuan_kerja
 * @property string $ket_satuan_kerja
 *
 * @property Administratif[] $administratifs
 * @property Notadebet[] $notadebets
 */
class Satuankerja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'satuankerja';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_satuan_kerja', 'ket_satuan_kerja'], 'required'],
            [['kode_satuan_kerja', 'ket_satuan_kerja'], 'string', 'max' => 50],
            [['kode_satuan_kerja'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_satuan_kerja' => 'Kode Satuan Kerja',
            'ket_satuan_kerja' => 'Ket Satuan Kerja',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministratifs()
    {
        return $this->hasMany(Administratif::className(), ['kode_satuan_kerja' => 'kode_satuan_kerja']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotadebets()
    {
        return $this->hasMany(Notadebet::className(), ['kode_satuan_kerja' => 'kode_satuan_kerja']);
    }
}
