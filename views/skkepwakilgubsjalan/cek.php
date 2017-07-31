
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
<?="ID = ".$model->id_sk_kepwakil_gub_sjalan."<br>"?>
<?="No Dokumen = ".$model->no_dokumen."<Br>"?>
<?="Kode Tahun = ".$model->kode_tahun."<br>"?>
<?="Kode Jenis Dokumen = ".$model->kode_jenis_dokumen."<br>"?>


<?="Perihal = ".$model->perihal."<br>"?>
<?="ID User = ".$model->id_user."<br>"?>
<?="Waktu input = ".$model->waktu_input."<br>"?>
<?="File Dokumen = ".$model->file_dokumen."<br>"?>
