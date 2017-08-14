<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sk_kepwakil_gub".
 *
 * @property int $id_sk_kepwakil_gub_sjalan
 * @property int $kode_tahun
 * @property int $no_dokumen
 * @property string $format_dokumen
 * @property string $perihal
 * @property string $pengesah
 * @property int $id_user
 * @property string $waktu_input
 * @property string $file_dokumen
 *
 * @property Tahun $kodeTahun
 * @property User $user
 */
class SkKepwakilGub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sk_kepwakil_gub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persetujuan','kode_tahun', 'no_dokumen', 'format_dokumen', 'perihal', 'pengesah', 'id_user', 'waktu_input'], 'required'],
            [['kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['ket_persetujuan'],'string'],
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
            'format_dokumen' => 'Format Dokumen',
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
