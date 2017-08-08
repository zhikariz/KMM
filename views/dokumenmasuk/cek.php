
<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Administratif */

$this->title = 'Create Administratif';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Masuk', 'url' => ['index','sifat'=>$_GET['sifat']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<?="No Dokumen = ".$model->no_dokumen."<Br>"?>
<?="Kode Tahun = ".$model->kode_tahun."<br>"?>
<?="Tanggal Dokumen =".$model->tgl_dokumen."<br>"?>
<?="Kode Sifat Dokumen = ".$model->kode_sifat_dokumen."<br>"?>
<?="Perihal = ".$model->perihal."<br>"?>
<?="Kesegeraan = ".$model->kesegeraan."<br>"?>
<?="Tujuan Disposisi = ".$model->tujuan_disposisi."<br>"?>
<?="petunjuk_disposisi = ".$model->petunjuk_disposisi."<br>"?>
<?="	ket_disposisi_kepala = ".$model->ket_disposisi_kepala."<br>"?>
<?="	ket_disposisi_tim = ".$model->ket_disposisi_tim."<br>"?>
<?="	ket_disposisi_unit = ".$model->ket_disposisi_unit."<br>"?>
<?="ID User = ".$model->id_user."<br>"?>
<?="Waktu input = ".$model->waktu_input."<br>"?>
<?="File Dokumen = ".$model->file_dokumen."<br>"?>
