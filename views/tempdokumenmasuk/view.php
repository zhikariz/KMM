<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use aryelds\sweetalert\SweetAlert;

/* @var $this yii\web\View */
/* @var $model app\models\TempDokumenMasuk */

$this->title = $model->no_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Temp Dokumen Masuks', 'url' => ['index','sifat'=>$_GET['sifat']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="temp-dokumen-masuk-view">
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

  <p>
    <?= Html::a('Setujui', ['approve', 'sifat'=>$_GET['sifat'],'id' => $model->id_temp_dokumen_masuk], [
        'class' => 'btn btn-success',
        'data' => [
            'confirm' => 'Apakah kamu ingin menyetujui surat ini?',
            'method' => 'post',
        ],
    ]) ?>
    <?= Html::a('Tolak', ['reject', 'sifat'=>$_GET['sifat'],'id' => $model->id_temp_dokumen_masuk], [
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
          'no_dokumen',
          'tgl_dokumen',
          'perihal',
          'asal_dokumen',
          'tgl_terima',
          'dari',
          [
          'attribute'=>'tujuan_disposisi',
          'format' => 'raw',
          'value'=>function($data,$row){
            $temp=json_decode($data->tujuan_disposisi,true);
            if($temp['kepala']!=null){
            $a = $temp['kepala'];
          for($i=0;$i<count($a);$i++){
            $vl[$i]='<button class="btn-xs btn btn-danger" style="margin: 1px;">'.$a[$i].'</button>';
          }
          $hasil = implode($vl) ."<br>";
        }else{
          $hasil = '';
        }

          if($temp['unit']!=null){
          $c = $temp['unit'];
          for($i=0;$i<count((array)$c);$i++){
            $u[$i]='<button class="btn-xs btn btn-primary" style="margin: 1px;">'.$c[$i].'</button>';
          }
          $hasil .= implode($u);
        }
          return $hasil;

          }
          ],
          [
          'attribute'=>'petunjuk_disposisi',
          'format' => 'raw',
          'value'=>function($data,$row){
            $temp=json_decode($data->petunjuk_disposisi,true);
            for($i=0;$i<count($temp);$i++){
              $vl[$i]='<button class="btn-xs btn btn-warning" style="margin: 1px;">'.$temp[$i].'</button><br>';
            }
            $hasil = implode($vl);
             return $hasil;
          }
          ],
          'ket_disposisi_kepala',
          'ket_disposisi_tim',
          'ket_disposisi_unit',
          [
          'attribute'=>'file_dokumen',
          'format'=>'raw',
          'value'=>Html::a($model->file_dokumen, "uploads/$model->file_dokumen", ['target'=>'_blank']),
          ],
          'waktu_input',
          [
            'attribute'=>'editor',
          ],

      ],
  ]) ?>

</div>
