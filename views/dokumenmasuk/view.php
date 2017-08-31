<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use aryelds\sweetalert\SweetAlert;

/* @var $this yii\web\View */
/* @var $model app\models\Dokumenmasuk */

$this->title = "Detail Dokumen ".$model->no_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Masuk', 'url' => ['index','sifat'=>$_GET['sifat']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="dokumenmasuk-view">
<?php if(Yii::$app->user->identity->role->ket_role == 'Administrator' || Yii::$app->user->identity->role->ket_role == 'Operator'){?>
    <p>
      <?php if(date('d-m-Y') != $libur['waktu_hari_libur']){
        if((date('D')=='Sat')||(date('D')=='Sun')){}else{?>
        <?= Html::a('Update', ['update', 'sifat'=>$_GET['sifat'],'id' => $model->id_dokumen_masuk], ['class' => 'btn btn-primary']) ?>
          <?php if(Yii::$app->user->identity->role->ket_role == 'Administrator'){?>
        <?= Html::a('Delete', ['delete', 'sifat'=>$_GET['sifat'],'id' => $model->id_dokumen_masuk], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php }}} ?>
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
            'no_dokumen',
            'tgl_dokumen',
            'perihal',
            'asal_dokumen',
            'tgl_terima',
            'dari',
            'kodeSifatDokumen.ket_sifat_dokumen',
            [
            'attribute'=>'tujuan_disposisi',
            'format' => 'raw',
            'value'=>function($data,$row) use ($dataDokumenMasuk){
              $temp=json_decode($dataDokumenMasuk['tujuan_disposisi'],true);
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
            'value'=>function($data,$row) use ($dataDokumenMasuk){
              $temp=json_decode($dataDokumenMasuk['petunjuk_disposisi'],true);
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
            [
              'attribute'=>'user.nama_user',
              'label' => 'Pembuat'
            ],
            'waktu_input',
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
            ],

        ],
    ]) ?>

</div>
