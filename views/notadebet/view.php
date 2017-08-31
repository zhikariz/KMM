<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use aryelds\sweetalert\SweetAlert;

/* @var $this yii\web\View */
/* @var $model app\models\Notadebet */


$no_dokumen=$model->kode_tahun."/".$model->kode_satuan_kerja."/".$model->no_dokumen."/".$model->kode_satker_pusat;
$this->title = "Detail Dokumen ".$no_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Nota Debet', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="notadebet-view">

  <?php if(Yii::$app->user->identity->role->ket_role == 'Administrator' || Yii::$app->user->identity->role->ket_role == 'Operator'){?>
    <p>
        <?php if(date('d-m-Y') != $libur['waktu_hari_libur']){
          if((date('D')=='Sat')||(date('D')=='Sun')){}else{?>
        <?= Html::a('Update', ['update', 'id' => $model->id_nota_debet], ['class' => 'btn btn-primary']) ?>
          <?php if(Yii::$app->user->identity->role->ket_role == 'Administrator'){?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_nota_debet], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php }}}
      }else {?>
        <?php if(strpos($model->penyetuju_dokumen,Yii::$app->user->identity->nama_user) == false ){?>
        <?= Html::a('Setujui', ['approve','id' => $model->id_nota_debet], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Apakah anda ingin menyetujui dokumen ini?',
                'method' => 'post',
            ],
        ]) ?>
      <?php }?>

    </p>
    <?php }?>
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          ['attribute'=>'No Dokumen',
          'value'=>function($data,$row) use ($no_dokumen){
return $no_dokumen;
              }],
            'perihal',
            'user.nama_user',
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
              'label'=>'Progress',
              'format'=>'raw',
              'value'=>function($data,$row){

                $temp_pengesah=json_decode($data['pengesah'],true);
                $temp_penyetuju =json_decode($data->penyetuju_dokumen,true);
                $jml_penyetuju = count($temp_penyetuju);
                 $total_penyetuju = count($temp_pengesah);
                 $progress =  $jml_penyetuju / $total_penyetuju *100;

                if($progress < 50){
                  return '<button class="btn-xs btn btn-danger" style="margin: 1px;">'.$progress . ' %</button>';
                }else if($progress < 100){
                  return '<button class="btn-xs btn btn-warning" style="margin: 1px;">'.$progress . ' %</button>';
                }else {
                  return '<button class="btn-xs btn btn-success" style="margin: 1px;">'.$progress . ' %</button>';
                }

              }

            ],
            [
              'attribute'=>'ket_penyetuju_dokumen',
              'format'=>'raw',
              'value'=>function($data,$row){
                if($data->ket_penyetuju_dokumen!=null){
                $ket=json_decode($data->ket_penyetuju_dokumen,true);
                return implode($ket,"<br>");
              }else{
                return null;
              }

              }
            ],

            [
              'attribute'=>'persetujuan_edit',
              'format'=>'raw',
              'value'=>function($data,$row){
                  if($data->persetujuan_edit == 'Disetujui'){
                    return '<button class="btn-xs btn btn-success" style="margin: 1px;">'.$data->persetujuan_edit.'</button';
                  }else if($data->persetujuan_edit == 'Belum Disetujui'){
                    return '<button class="btn-xs btn btn-warning" style="margin: 1px;">'.$data->persetujuan_edit.'</button';
                  }else{
                    return '<button class="btn-xs btn btn-danger" style="margin: 1px;">'.$data->persetujuan_edit.'</button';
                  }
                  },
            ],
            [
              'attribute'=>'ket_persetujuan_edit',
            ],
            [
              'attribute'=>'editor'
            ],
        ],
    ]) ?>

</div>
