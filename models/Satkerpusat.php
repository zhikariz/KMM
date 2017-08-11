<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "satkerpusat".
 *
 * @property string $kode_satker_pusat
 * @property string $ket_satker_pusat
 */
class Satkerpusat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'satkerpusat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_satker_pusat', 'ket_satker_pusat'], 'required'],
            [['kode_satker_pusat', 'ket_satker_pusat'], 'string', 'max' => 50],
            [['kode_satker_pusat'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_satker_pusat' => 'Kode Satker Pusat',
            'ket_satker_pusat' => 'Ket Satker Pusat',
        ];
    }
}
