<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Suratjalan */

$this->title = "Detail Dokumen ".$model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kode_satuan_kerja;
$this->params['breadcrumbs'][] = ['label' => 'Surat Jalan', 'url' => ['index','kode'=>$_GET['kode']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
$no_dokumen=$model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kode_satuan_kerja;
?>
<div class="suratjalan-view">
<?php if(Yii::$app->user->identity->role->ket_role == 'Administrator' || Yii::$app->user->identity->role->ket_role == 'Operator'){?>
    <p>
        <?= Html::a('Update', ['update', 'kode'=>$_GET['kode'],'id' => $model->id_surat_jalan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'kode'=>$_GET['kode'],'id' => $model->id_surat_jalan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php }?>

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
            'user.nama_user',
            'perihal',
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
            ]
        ],
    ]) ?>

</div>
