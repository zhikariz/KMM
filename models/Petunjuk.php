<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "petunjuk".
 *
 * @property int $id_petunjuk
 * @property string $keterangan_petunjuk
 *
 * @property Dokumenmasuk[] $dokumenmasuks
 */
class Petunjuk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'petunjuk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keterangan_petunjuk'], 'required'],
            [['keterangan_petunjuk'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_petunjuk' => 'Id Petunjuk',
            'keterangan_petunjuk' => 'Keterangan Petunjuk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenmasuks()
    {
        return $this->hasMany(Dokumenmasuk::className(), ['id_petunjuk' => 'id_petunjuk']);
    }
}
