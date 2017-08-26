<?php

use yii\helpers\Html;
use yii\widgets\DetailView;



/* @var $this yii\web\View */
/* @var $model app\models\TempSkKepwakilGub */

$this->title = "Detail Dokumen ".$model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kodeTahun->tahun;
$this->params['breadcrumbs'][] = ['label' => 'Temp Sk Kepwakil Gubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
$no_dokumen = $model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kodeTahun->tahun;
?>
<div class="temp-sk-kepwakil-gub-view">



  <p>
    <?= Html::a('Setujui', ['approve', 'kode'=>$model->format_dokumen,'id' => $model->id_temp_sk_kep_wakil_gub], [
        'class' => 'btn btn-success',
        'data' => [
            'confirm' => 'Apakah kamu ingin menyetujui surat ini?',
            'method' => 'post',
        ],
    ]) ?>
    <?= Html::a('Tolak', ['reject', 'kode'=>$model->format_dokumen,'id' => $model->id_temp_sk_kep_wakil_gub], [
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
            'perihal',
            [
              'attribute'=>'pengesah',
              'format'=>'raw',
            ],
            'waktu_input',
            [
            'attribute'=>'file_dokumen',
            'format'=>'raw',
            'value'=>Html::a($model->file_dokumen, "uploads/$model->file_dokumen", ['target'=>'_blank']),
        ],
        ],
    ]) ?>

</div>
