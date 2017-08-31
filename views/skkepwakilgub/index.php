<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use aryelds\sweetalert\SweetAlert;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SkKepwakilGubSjalanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if(date('d-m-Y') != $libur['waktu_hari_libur']){
  $dataContent = Yii::$app->user->identity->role->ket_role== 'Operator' || Yii::$app->user->identity->role->ket_role=='Administrator'?
  Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create','kode'=>$_GET['kode']], ['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>Yii::t('app', 'Create Satuan Kerja')])   . ' '.
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index','kode'=>$_GET['kode']], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')]):
      Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index','kode'=>$_GET['kode']], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')]);
      $dataTemplate = Yii::$app->user->identity->role->ket_role=='Approval'?'{view}':(Yii::$app->user->identity->role->ket_role=='Operator'?('{view}{update}'):'{view}{update}{delete}');
}else{
  $dataContent = Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index','kode'=>$_GET['kode']], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')]);
  $dataTemplate = '{view}';
}
if((date('D')=='Sat')||(date('D')=='Sun'))
{
  $dataContent = Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create','kode'=>$_GET['kode']], ['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>Yii::t('app', 'Create Satuan Kerja')])   . ' '.Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index','kode'=>$_GET['kode']], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')]);
  $dataTemplate = '{view}';
}
$this->title = "SK Kep Wakil & Gub BI";
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="sk-kepwakil-gub-sjalan-index">
  <?php if(date('d-m-Y') == $libur['waktu_hari_libur']){?>
  <div class="row">
<div class="col-sm-12 text-center" style="color:red;"><?='Hari Ini Libur dengan Keterangan '.$libur->ket_hari_libur."<br>".'Anda Tidak Dapat Melakukan Input, Edit dan Delete Dokumen'?></div>
</div>
<?php }?>
<?php if((date('D')=='Sat')||(date('D')=='Sun'))
{?>
  <div class="row">
<div class="col-sm-12 text-center" style="color:red;"><?php date('D')=="Sat"?$hari="Sabtu":$hari="Minggu" ?><?='Hari Ini Hari '.$hari.'<br> Anda Dapat Melakukan Input Dokumen tetapi tidak dapat Edit dan Delete Dokumen'?></div>
</div>
<?php }
?>


    <?php Pjax::begin(); ?>
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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>
    [
      [
        'class'=>'kartik\grid\SerialColumn',
        'contentOptions'=>['class'=>'kartik-sheet-style'],
        'width'=>'36px',
        'header'=>'No',
        'headerOptions'=>['class'=>'kartik-sheet-style'],
      ],
      [
        'attribute'=>'no_dokumen',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'content' => function($model, $key, $index) {
                  $content = $model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kodeTahun->tahun;
                  return $content;
              },
      ],
      [
        'attribute'=>'perihal',
        'vAlign' => 'middle',
        'hAlign' => 'center',
      ],
      [
        'attribute'=>'pengesah',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'content' => function($model,$key,$index){
          $temp=json_decode($model->pengesah);
          for($i=0;$i<count($temp);$i++){
            $a[$i]='<button class="btn-xs btn btn-info" style="margin: 1px;">'.$temp[$i].'</button>';
          }
           $vl = implode('<br>',$a);
           return $vl;
        }

      ],
      [
        'label'=>'Progress',
        'vAlign'=>'middle',
        'hAlign'=>'center',
        'content'=>function($model,$key,$index){
          $temp_pengesah=json_decode($model->pengesah,true);
          $temp_penyetuju =json_decode($model->penyetuju_dokumen,true);
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
        'attribute'=>'waktu_input',
        'vAlign' => 'middle',
        'hAlign' => 'center',
      ],
      [
        'attribute'=>'file_dokumen',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format'=>'raw',
        'content' =>
        function($model, $key, $index){
          $temp = $model->file_dokumen;
          if($temp == NULL){
            return "File Tidak Ada";
          }else{
          return Html::a($temp, "uploads/$temp", ['target'=>'_blank','data-pjax'=>"0"]);}

        },
      ],
      [
        'attribute'=>'user.nama_user',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'header' => 'Pembuat',
      ],

      [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Actions',
        'headerOptions' => ['style' => 'color:#337ab7'],
        'template' => $dataTemplate,
        'buttons' => [
          'view' => function ($url, $model) {
              return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                          'title' => Yii::t('app', 'View'),
              ]);
          },

          'update' => function ($url, $model) {
              return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                          'title' => Yii::t('app', 'Update'),
              ]);
          },
          'delete' => function ($url, $model) {
              return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
                          'title' => Yii::t('app', 'Delete'),
              ]);
          }

        ],
        'urlCreator' => function ($action, $model, $key, $index) {
          if ($action === 'view') {
              $url ='index.php?r=skkepwakilgub/view&kode='.$_GET['kode'].'&id='.$model->id_sk_kepwakil_gub;
              return $url;
          }

          if ($action === 'update') {
              $url ='index.php?r=skkepwakilgub/update&kode='.$_GET['kode'].'&id='.$model->id_sk_kepwakil_gub;
              return $url;
          }
          if ($action === 'delete') {
              $url ='index.php?r=skkepwakilgub/delete&kode='.$_GET['kode'].'&id='.$model->id_sk_kepwakil_gub;
              return $url;
          }

        }
        ],
    ],
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar'=> [
        ['content'=>
        $dataContent
        ],
        '{export}',
        '{toggleData}',
    ],
    // set export properties
    'export'=>[
        'fontAwesome'=>true
    ],
    // parameters from the demo form
    'panel'=>[
        'type'=>GridView::TYPE_PRIMARY,
        'heading' => "SK Kep Wakil & Gub BI"
    ],
    'persistResize'=>false,
    'toggleDataOptions'=>['minCount'=>10],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
