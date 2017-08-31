<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TempNotaDebet */
$no_dokumen=$model->kode_tahun."/".$model->kode_satuan_kerja."/".$model->no_dokumen."/".$model->kode_satker_pusat;
$this->title = $no_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Temp Nota Debets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="temp-nota-debet-view">

      <p>
        <?= Html::a('Setujui', ['approve', 'id' => $model->id_temp_nota_debet], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Apakah kamu ingin menyetujui surat ini?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Tolak', ['reject', 'id' => $model->id_temp_nota_debet], [
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
              'perihal',
              'waktu_input',
              [
                'attribute'=>'pengesah',
                'format'=>'raw',
                'value'=>function($data,$row){
                  $temp = json_decode($data->pengesah);
                  for($i=0;$i<count($temp);$i++){
                    $a[$i]='<button class="btn-xs btn btn-info" style="margin: 1px;">'.$temp[$i].'</button>';
                  }
                   return $vl = implode('<br>',$a);
                }
              ],
              [
              'attribute'=>'file_dokumen',
              'format'=>'raw',
              'value'=>Html::a($model->file_dokumen, "uploads/$model->file_dokumen", ['target'=>'_blank']),
              ],
              [
                'attribute'=>'editor'
              ],
          ],
      ]) ?>

</div>
