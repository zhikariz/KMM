<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property string $sandi_bank
 * @property string $nama_bank
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sandi_bank', 'nama_bank'], 'required'],
            [['sandi_bank', 'nama_bank'], 'string', 'max' => 50],
            [['sandi_bank'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sandi_bank' => 'Sandi Bank',
            'nama_bank' => 'Nama Bank',
        ];
    }
}
