<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Administratif */
$a= $model->format_dokumen;
$jml = count($a);

if($jml == 1){
  $format =$a['satker'];
}else if($jml == 2){
  if($a['tim'] != ''){
    $format = $a['satker'] . "-" . $a['tim'];
}else{
    $format =$a['satker'];
}
}else if($jml == 3){
  if($a['unit'] != ''){
  $format = $a['satker'] . "-" . $a['tim'] . "-" . $a['unit'];
}else if($a->tim != ''){
  $format = $a['satker'] . "-" . $a['tim'];
}
else{
  $format =$a['satker'];
}
}

$no_dokumen = $model->kode_tahun."/".$model->no_dokumen."/".$format."/".$model->kode_jenis_dokumen."/".$model->kode_sifat_dokumen;
$this->title = 'Update Administratif : ' . $no_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Administratif', 'url' => ['index','kode'=> $model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen,]];
$this->params['breadcrumbs'][] = ['label' => $no_dokumen, 'url' => ['view', 'kode'=> $model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen, 'id' => $model->id_surat_adm]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="administratif-update">

    <?= $this->render('_form', [
      'model' => $model,
      'format' => $dataFormatJenis,
      'dataSatker' => $dataSatker,
      'dataUnit'=>$dataUnit,
      'dataTim' => $dataTim,
      'dataPengesah' => $dataPengesah,
    ]) ?>

</div>
