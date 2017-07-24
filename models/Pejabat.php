<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pejabat".
 *
 * @property int $id_pejabat
 * @property string $nama_pejabat
 * @property string $unit_pejabat
 *
 * @property Dokumenmasuk[] $dokumenmasuks
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
            [['nama_pejabat', 'unit_pejabat'], 'required'],
            [['nama_pejabat', 'unit_pejabat'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pejabat' => 'Id Pejabat',
            'nama_pejabat' => 'Nama Pejabat',
            'unit_pejabat' => 'Unit Pejabat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenmasuks()
    {
        return $this->hasMany(Dokumenmasuk::className(), ['id_pejabat' => 'id_pejabat']);
    }
}
