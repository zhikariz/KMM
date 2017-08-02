<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AdministratifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administratif '.$kode['ket_jenis_dokumen']." || ".$sifat['ket_sifat_dokumen'];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="administratif-index">

    <?php Pjax::begin(); ?>
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
          'content' => function($model, $key, $index) use ($dataAdm) {
                    // you can do here something with $lang if you need so
                    $a = json_decode($dataAdm[$index]['format_dokumen']);
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
                    $content = $dataAdm[$index]['kode_tahun']."/".$dataAdm[$index]['no_dokumen']."/".$format."/".$dataAdm[$index]['kode_jenis_dokumen']."/".$dataAdm[$index]['kode_sifat_dokumen'];

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
        'content' => function($model,$key,$index) use ($dataAdm){
          $temp=json_decode($dataAdm[$index]['pengesah']);
           $vl = implode("<br>",$temp);
           return $vl;
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
        function($model, $key, $index) use ($dataAdm){
          $temp = $dataAdm[$index]['file_dokumen'];
          if($temp == NULL){
            return "File Tidak Ada";
          }else{
          return Html::a($temp, "uploads/$temp", ['target'=>'_blank','data-pjax'=>"0"]);}

        },
      ],
      [
        'attribute'=>'user.username',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'header' => 'Pembuat',
      ],

      [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Actions',
        'headerOptions' => ['style' => 'color:#337ab7'],
        'template' => '{view}{update}{delete}',
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
              $url ='index.php?r=administratif/view&kode='.$_GET['kode'].'&sifat='.$_GET['sifat'].'&id='.$model->id_surat_adm;
              return $url;
          }

          if ($action === 'update') {
              $url ='index.php?r=administratif/update&kode='.$_GET['kode'].'&sifat='.$_GET['sifat'].'&id='.$model->id_surat_adm;
              return $url;
          }
          if ($action === 'delete') {
              $url ='index.php?r=administratif/delete&kode='.$_GET['kode'].'&sifat='.$_GET['sifat'].'&id='.$model->id_surat_adm;
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
            Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create','kode'=>$_GET['kode'],'sifat'=>$_GET['sifat']], ['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>Yii::t('app', 'Create Satuan Kerja')]) . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index','kode'=>$_GET['kode'],'sifat'=>$_GET['sifat']], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
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
        'heading' => "Administratif ".$kode['ket_jenis_dokumen'],
    ],
    'persistResize'=>false,
    'toggleDataOptions'=>['minCount'=>10],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
