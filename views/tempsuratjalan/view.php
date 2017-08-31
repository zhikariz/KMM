<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TempSuratjalan */

$this->title = "Detail Dokumen ".$model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kode_satuan_kerja;
$this->params['breadcrumbs'][] = ['label' => 'Surat Jalan', 'url' => ['index','kode'=>$_GET['kode']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
$no_dokumen=$model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kode_satuan_kerja;
?>
<div class="temp-suratjalan-view">
    <p>
      <?= Html::a('Setujui', ['approve', 'kode'=>$_GET['kode'],'id' => $model->id_temp_suratjalan], [
          'class' => 'btn btn-success',
          'data' => [
              'confirm' => 'Apakah kamu ingin menyetujui surat ini?',
              'method' => 'post',
          ],
      ]) ?>

      <?= Html::a('Tolak', ['reject', 'kode'=>$_GET['kode'],'id' => $model->id_temp_suratjalan], [
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
              }],
            [
              'attribute'=>'pengesah',
              'format'=>'raw'
            ],
            'perihal',
            'waktu_input',
            [
            'attribute'=>'file_dokumen',
            'format'=>'raw',
            'value'=>Html::a($model->file_dokumen, "uploads/$model->file_dokumen", ['target'=>'_blank']),
            ],
            'editor'
        ],
    ]) ?>

</div>
