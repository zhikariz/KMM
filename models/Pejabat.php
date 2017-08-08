<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pejabat".
 *
 * @property int $id_pejabat
 * @property string $nama_deputi
 */
class Pejabat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pejabat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_deputi'], 'required'],
            [['nama_deputi'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pejabat' => 'Id Pejabat',
            'nama_deputi' => 'Nama Deputi',
        ];
    }
}
