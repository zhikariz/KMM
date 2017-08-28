<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use aryelds\sweetalert\SweetAlert;

/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */

$this->params['breadcrumbs'][] = ['label' => 'Sk Kepwakil Gub Sjalan', 'url' => ['index','kode'=>$_GET['kode']]];
$this->title = "Detail Dokumen ".$model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kodeTahun->tahun;
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
$no_dokumen = $model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kodeTahun->tahun;
?>
<div class="sk-kepwakil-gub-sjalan-view">
  <?php foreach (Yii::$app->session->getAllFlashes() as $message) {
      echo SweetAlert::widget([
          'options' => [
              'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
              'text' => (!empty($message['text'])) ? Html::encode($message['text']) : 'Text Not Set!',
              'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_INFO,
              'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
              'showConfirmButton' =>  (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true,
          ]
      ]);
  }?>

  <?php if(Yii::$app->user->identity->role->ket_role == 'Administrator' || Yii::$app->user->identity->role->ket_role == 'Operator'){?>
    <p>
        <?= Html::a('Update', ['update', 'kode'=>$model->format_dokumen,'id' => $model->id_sk_kepwakil_gub], ['class' => 'btn btn-primary']) ?>
          <?php if(Yii::$app->user->identity->role->ket_role == 'Administrator'){?>
        <?= Html::a('Delete', ['delete', 'kode'=>$model->format_dokumen,'id' => $model->id_sk_kepwakil_gub], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php }?>
    </p>
    <?php }?>

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
            [
              'attribute' => 'user.nama_user',
            ],
            'waktu_input',
            [
            'attribute'=>'file_dokumen',
            'format'=>'raw',
            'value'=>Html::a($model->file_dokumen, "uploads/$model->file_dokumen", ['target'=>'_blank']),
        ],
        [
          'attribute'=>'persetujuan',
          'format'=>'raw',
          'value'=>function($data,$row){
              if($data->persetujuan == 'Disetujui'){
                return '<button class="btn-xs btn btn-success" style="margin: 1px;">'.$data->persetujuan.'</button';
              }else if($data->persetujuan == 'Belum Disetujui'){
                return '<button class="btn-xs btn btn-warning" style="margin: 1px;">'.$data->persetujuan.'</button';
              }else{
                return '<button class="btn-xs btn btn-danger" style="margin: 1px;">'.$data->persetujuan.'</button';
              }
              },
        ],
        [
          'attribute'=>'ket_persetujuan',
        ],
        [
          'attribute'=>'editor',
        ]
        ],
    ]) ?>

</div>
