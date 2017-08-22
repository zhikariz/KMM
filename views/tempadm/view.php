<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TempAdm */
$a = json_decode($model->format_dokumen);
$jml = count((array)$a);

if($jml == 1){
  $format =$a->satker;
}else if($jml == 2){
  if($a->tim != ''){
    $format = $a->satker . "-" . $a->tim;
}else{
    $format =$a->satker;
}
}else if($jml == 3){
  if($a->unit != ''){
  $format = $a->satker . "-" . $a->tim . "-" . $a->unit;
}else if($a->tim != ''){
  $format = $a->satker . "-" . $a->tim;
}
else{
  $format =$a->satker;
}
}
$this->title = "Detail Dokumen ".$model->kode_tahun."/".$model->no_dokumen."/".$format."/".$model->kode_jenis_dokumen."/".$model->kode_sifat_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Temp Adms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
$no_dokumen = $model->kode_tahun."/".$model->no_dokumen."/".$format."/".$model->kode_jenis_dokumen."/".$model->kode_sifat_dokumen;
?>
<div class="temp-adm-view">
    <p>
      <?= Html::a('Setujui', ['approve', 'kode'=>$model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen,'id' => $model->id_temp_adm], [
          'class' => 'btn btn-success',
          'data' => [
              'confirm' => 'Apakah kamu ingin menyetujui surat ini?',
              'method' => 'post',
          ],
      ]) ?>
      <?= Html::a('Tolak', ['reject', 'kode'=>$model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen,'id' => $model->id_temp_adm], [
          'class' => 'btn btn-danger',
          'data' => [
              'confirm' => 'Apakah kamu ingin menolak surat ini?',
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
            [
              'attribute'=>'pengesah',
              'format'=>'raw',

            ],
            'perihal:ntext',
            'waktu_input',
            'file_dokumen',
            'editor:ntext',
        ],
    ]) ?>

</div>
