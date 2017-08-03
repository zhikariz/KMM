<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Administratif */
$json = json_decode($model->format_dokumen);
$jml = count((array)$json);
if($jml == 1){
  $format = $json->satker;
}else if($jml == 2){
  $format = $json->satker . "-" . $json->tim;
}else{
  $format = $json->satker . "-" . $json->tim . "-" . $json->unit;
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
      'dataPengesah' => $dataPengesah
    ]) ?>

</div>
