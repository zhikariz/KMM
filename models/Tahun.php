<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tahun".
 *
 * @property int $kode_tahun
 * @property string $tahun
 *
 * @property Administratif[] $administratifs
 * @property Notadebet[] $notadebets
 * @property SkKepwakilGubSjalan[] $skKepwakilGubSjalans
 */
class Tahun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tahun';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_tahun', 'tahun'], 'required'],
            [['kode_tahun'], 'integer'],
            [['tahun'], 'safe'],
            [['kode_tahun'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_tahun' => 'Kode Tahun',
            'tahun' => 'Tahun',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministratifs()
    {
        return $this->hasMany(Administratif::className(), ['kode_tahun' => 'kode_tahun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotadebets()
    {
        return $this->hasMany(Notadebet::className(), ['kode_tahun' => 'kode_tahun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkKepwakilGubSjalans()
    {
        return $this->hasMany(SkKepwakilGubSjalan::className(), ['kode_tahun' => 'kode_tahun']);
    }
}
