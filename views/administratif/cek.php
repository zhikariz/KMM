
<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Administratif */

$this->title = 'Create Administratif';
$this->params['breadcrumbs'][] = ['label' => 'Administratif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<?="No Dokumen = ".$model->no_dokumen."<Br>"?>
<?="Kode Tahun = ".$model->kode_tahun."<br>"?>
<?="Format Dokumen = ".$model->format_dokumen."<br>"?>
<?="Pengesah = ".$model->pengesah."<br>"?>
<?="Kode Jenis Dokumen = ".$model->kode_jenis_dokumen."<br>"?>
<?="Kode Sifat Dokumen = ".$model->kode_sifat_dokumen."<br>"?>
<?="Perihal = ".$model->perihal."<br>"?>
<?="ID User = ".$model->id_user."<br>"?>
<?="Waktu input = ".$model->waktu_input."<br>"?>
<?="File Dokumen = ".$model->file_dokumen."<br>"?>
