<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Administratif */
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
$this->params['breadcrumbs'][] = ['label' => 'Administratif', 'url' => ['index','kode'=> $model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
$no_dokumen = $model->kode_tahun."/".$model->no_dokumen."/".$format."/".$model->kode_jenis_dokumen."/".$model->kode_sifat_dokumen;
?>
<div class="administratif-view">


<?php if(Yii::$app->user->identity->role->ket_role == 'Administrator' || Yii::$app->user->identity->role->ket_role == 'Operator'){?>
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
    <?php }else{?>
      <p>
        <?= Html::a('Setujui', ['approve', 'kode'=>$model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen,'id' => $model->id_surat_adm], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Apakah kamu ingin menyetujui surat ini?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Tolak', ['reject', 'kode'=>$model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen,'id' => $model->id_surat_adm], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah kamu ingin menolak surat ini?',
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
                },
            ],
            [
              'attribute'=>'pengesah',
              'format'=>'raw',
              
            ],
            [
              'attribute'=>'kodeJenisDokumen.ket_jenis_dokumen',
              'label'=>'Jenis Dokumen'
            ],
            [
              'attribute'=>'kodeSifatDokumen.ket_sifat_dokumen',
              'label'=>'Sifat Dokumen'
            ],
            'perihal',
            [
              'attribute'=>'user.nama_user',
              'label' => 'Pembuat'
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
            ]
        ],
    ]) ?>



</div>
