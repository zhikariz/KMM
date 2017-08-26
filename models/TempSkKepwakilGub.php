<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temp_sk_kepwakil_gub".
 *
 * @property int $id_temp_sk_kep_wakil_gub
 * @property int $id_sk_kepwakil_gub
 * @property int $kode_tahun
 * @property int $no_dokumen
 * @property string $format_dokumen
 * @property string $perihal
 * @property string $pengesah
 * @property int $id_user
 * @property string $waktu_input
 * @property string $file_dokumen
 * @property string $editor
 *
 * @property SkKepwakilGub $skKepwakilGub
 */
class TempSkKepwakilGub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temp_sk_kepwakil_gub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sk_kepwakil_gub', 'kode_tahun', 'no_dokumen', 'format_dokumen', 'perihal', 'pengesah', 'id_user', 'waktu_input', 'editor'], 'required'],
            [['id_sk_kepwakil_gub', 'kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['perihal', 'pengesah', 'editor'], 'string'],
            [['id_sk_kepwakil_gub'], 'exist', 'skipOnError' => true, 'targetClass' => SkKepwakilGub::className(), 'targetAttribute' => ['id_sk_kepwakil_gub' => 'id_sk_kepwakil_gub']],
            [['file_dokumen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_temp_sk_kep_wakil_gub' => 'Id Temp Sk Kep Wakil Gub',
            'id_sk_kepwakil_gub' => 'Id Sk Kepwakil Gub',
            'kode_tahun' => 'Kode Tahun',
            'no_dokumen' => 'No Dokumen',
            'format_dokumen' => 'Format Dokumen',
            'perihal' => 'Perihal',
            'pengesah' => 'Pengesah',
            'id_user' => 'Id User',
            'waktu_input' => 'Waktu Input',
            'file_dokumen' => 'File Dokumen',
            'editor' => 'Editor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkKepwakilGub()
    {
        return $this->hasOne(SkKepwakilGub::className(), ['id_sk_kepwakil_gub' => 'id_sk_kepwakil_gub']);
    }
    public function getKodeTahun()
    {
        return $this->hasOne(Tahun::className(), ['kode_tahun' => 'kode_tahun']);
    }
}
