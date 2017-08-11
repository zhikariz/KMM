<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hariliburtahunan".
 *
 * @property int $id_hari_libur
 * @property string $waktu_hari_libur
 * @property string $ket_hari_libur
 */
class Hariliburtahunan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hariliburtahunan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['waktu_hari_libur', 'ket_hari_libur'], 'required'],
            [['waktu_hari_libur', 'ket_hari_libur'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_hari_libur' => 'Id Hari Libur',
            'waktu_hari_libur' => 'Waktu Hari Libur',
            'ket_hari_libur' => 'Ket Hari Libur',
        ];
    }
}
