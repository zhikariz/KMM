<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sk_kepwakil_gub_sjalan".
 *
 * @property int $id_sk_kepwakil_gub_sjalan
 * @property int $kode_tahun
 * @property int $no_dokumen
 * @property string $kode_jenis_dokumen
 * @property string $perihal
 * @property string $pengesah
 * @property int $id_user
 * @property string $waktu_input
 * @property string $file_dokumen
 *
 * @property Jenisdokumen $kodeJenisDokumen
 * @property Tahun $kodeTahun
 * @property User $user
 */
class SkKepwakilGubSjalan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sk_kepwakil_gub_sjalan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perihal', 'pengesah'], 'required'],
            [['kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['kode_jenis_dokumen'], 'exist', 'skipOnError' => true, 'targetClass' => Jenisdokumen::className(), 'targetAttribute' => ['kode_jenis_dokumen' => 'kode_jenis_dokumen']],
            [['kode_tahun'], 'exist', 'skipOnError' => true, 'targetClass' => Tahun::className(), 'targetAttribute' => ['kode_tahun' => 'kode_tahun']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id_user']],
            [['file_dokumen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sk_kepwakil_gub_sjalan' => 'Id Sk Kepwakil Gub Sjalan',
            'kode_tahun' => 'Kode Tahun',
            'no_dokumen' => 'No Dokumen',
            'kode_jenis_dokumen' => 'Kode Jenis Dokumen',
            'perihal' => 'Perihal',
            'pengesah' => 'Pengesah',
            'id_user' => 'Id User',
            'waktu_input' => 'Waktu Input',
            'file_dokumen' => 'File Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeJenisDokumen()
    {
        return $this->hasOne(Jenisdokumen::className(), ['kode_jenis_dokumen' => 'kode_jenis_dokumen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeTahun()
    {
        return $this->hasOne(Tahun::className(), ['kode_tahun' => 'kode_tahun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id_user' => 'id_user']);
    }
}
