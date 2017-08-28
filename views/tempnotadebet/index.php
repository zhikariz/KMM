<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TempNotaDebetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Temp Nota Debets';
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="temp-nota-debet-index">

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
        'content' => function($model, $key, $index) {
                  $content = $model->kode_tahun."/".$model->kode_satuan_kerja."/".$model->no_dokumen."/".$model->kode_satker_pusat;
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
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Actions',
        'headerOptions' => ['style' => 'color:#337ab7'],
        'template' => '{view}',
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
              $url ='index.php?r=tempnotadebet/view'.'&id='.$model->id_temp_nota_debet;
              return $url;
          }

          if ($action === 'update') {
              $url ='index.php?r=notadebet/update'.'&id='.$model->id_nota_debet;
              return $url;
          }
          if ($action === 'delete') {
              $url ='index.php?r=notadebet/delete'.'&id='.$model->id_nota_debet;
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
          Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
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
        'heading' => "Temp Nota Debet"
    ],
    'persistResize'=>false,
    'toggleDataOptions'=>['minCount'=>10],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
