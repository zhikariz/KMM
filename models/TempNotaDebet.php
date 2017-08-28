<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temp_nota_debet".
 *
 * @property int $id_temp_nota_debet
 * @property int $id_nota_debet
 * @property int $kode_tahun
 * @property int $no_dokumen
 * @property string $kode_satuan_kerja
 * @property string $kode_satker_pusat
 * @property string $pengesah
 * @property string $perihal
 * @property int $id_user
 * @property string $waktu_input
 * @property string $file_dokumen
 * @property string $editor
 *
 * @property Notadebet $notaDebet
 */
class TempNotaDebet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temp_nota_debet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nota_debet', 'kode_tahun', 'no_dokumen', 'kode_satuan_kerja', 'kode_satker_pusat', 'pengesah', 'perihal', 'id_user', 'waktu_input', 'editor'], 'required'],
            [['id_nota_debet', 'kode_tahun', 'no_dokumen', 'id_user'], 'integer'],
            [['pengesah', 'perihal', 'file_dokumen', 'editor'], 'string'],
            [['id_nota_debet'], 'exist', 'skipOnError' => true, 'targetClass' => Notadebet::className(), 'targetAttribute' => ['id_nota_debet' => 'id_nota_debet']],
            [['file_dokumen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_temp_nota_debet' => 'Id Temp Nota Debet',
            'id_nota_debet' => 'Id Nota Debet',
            'kode_tahun' => 'Kode Tahun',
            'no_dokumen' => 'No Dokumen',
            'kode_satuan_kerja' => 'Kode Satuan Kerja',
            'kode_satker_pusat' => 'Kode Satker Pusat',
            'pengesah' => 'Pengesah',
            'perihal' => 'Perihal',
            'id_user' => 'Id User',
            'waktu_input' => 'Waktu Input',
            'file_dokumen' => 'File Dokumen',
            'editor' => 'Editor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotaDebet()
    {
        return $this->hasOne(Notadebet::className(), ['id_nota_debet' => 'id_nota_debet']);
    }
}
