<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Administratif */

$json = json_decode($model->format_dokumen);
$jml = count((array)$json);
if($jml == 1){
  $format =$json->satker;
}else if($jml == 2){
  if($json->tim != ''){
    $format = $json->satker . "-" . $json->tim;
}else{
    $format =$json->satker;
}
}else if($jml == 3){
  if($json->unit != ''){
  $format = $json->satker . "-" . $json->tim . "-" . $json->unit;
}else if($json->tim != ''){
  $format = $json->satker . "-" . $json->tim;
}
else{
  $format =$json->satker;
}
}
$this->title = "Detail Dokumen ".$model->kode_tahun."/".$model->no_dokumen."/".$format."/".$model->kode_jenis_dokumen."/".$model->kode_sifat_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Administratif', 'url' => ['index','kode'=> $model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
$no_dokumen = $model->kode_tahun."/".$model->no_dokumen."/".$format."/".$model->kode_jenis_dokumen."/".$model->kode_sifat_dokumen;
?>
<div class="administratif-view">



    <p>
        <?= Html::a('Update', ['update', 'kode'=>$model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen,'id' => $model->id_surat_adm], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'kode'=>$model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen,'id' => $model->id_surat_adm], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'No Dokumen',
            'value'=>function($data,$row) use ($no_dokumen){
return $no_dokumen;
                },
            ],
            'pengesah',
            'kodeJenisDokumen.ket_jenis_dokumen',
            'kodeSifatDokumen.ket_sifat_dokumen',
            'perihal',
            'user.username',
            'waktu_input',
            [
            'attribute'=>'file_dokumen',
            'format'=>'raw',
            'value'=>Html::a($model->file_dokumen, "uploads/$model->file_dokumen", ['target'=>'_blank']),
        ],
        ],
    ]) ?>



</div>
