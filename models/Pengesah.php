<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengesah".
 *
 * @property int $id_pengesah
 * @property string $nama_pengesah
 * @property string $unit_pengesah
 */
class Pengesah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengesah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_pengesah', 'unit_pengesah'], 'required'],
            [['nama_pengesah', 'unit_pengesah'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pengesah' => 'Id Pengesah',
            'nama_pengesah' => 'Nama Pengesah',
            'unit_pengesah' => 'Unit Pengesah',
        ];
    }
}
