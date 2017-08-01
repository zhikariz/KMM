<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */

$this->params['breadcrumbs'][] = ['label' => 'Sk Kepwakil Gub Sjalan', 'url' => ['index','kode'=>$_GET['kode']]];
$this->title = "Detail Dokumen ".$model->kode_tahun."/".$model->no_dokumen."/".$model->kode_jenis_dokumen."/".$model->kodeTahun->tahun;
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
$no_dokumen = $model->kode_tahun."/".$model->no_dokumen."/".$model->kode_jenis_dokumen."/".$model->kodeTahun->tahun;
?>
<div class="sk-kepwakil-gub-sjalan-view">



    <p>
        <?= Html::a('Update', ['update', 'kode'=>$model->kode_jenis_dokumen,'id' => $model->id_sk_kepwakil_gub_sjalan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'kode'=>$model->kode_jenis_dokumen,'id' => $model->id_sk_kepwakil_gub_sjalan], [
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
            'perihal',
            'pengesah',
            [
              'attribute' => 'user.nama_user',
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
