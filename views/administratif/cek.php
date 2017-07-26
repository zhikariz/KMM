
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
<?php
$a = json_decode($model->format_dokumen);
echo  $jml = count(json_decode($model->format_dokumen));
if($jml == 1){
  $format=$a->satker;
}else if($jml == 2){
  $format = $a->satker . "-" . $a->tim;
}else{
  $format = $a->satker . "-" . $a->tim . "-" . $a->unit;
}
$c =json_encode($model->format_dokumen);
echo "<br>";
echo $model->kode_tahun."/".$model->no_dokumen."/".$format."/".$model->kode_jenis_dokumen."/".$model->kode_sifat_dokumen;
echo "<Br>";?>



<?="Kode Jenis Dokumen = ".$model->kode_jenis_dokumen."<br>"?>
<?="Kode Sifat Dokumen = ".$model->kode_sifat_dokumen."<br>"?>
<?="Perihal = ".$model->perihal."<br>"?>
<?="ID User = ".$model->id_user."<br>"?>
<?="Waktu input = ".$model->waktu_input."<br>"?>
<?="File Dokumen = ".$model->file_dokumen."<br>"?>
