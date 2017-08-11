<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SkKepwakilGubSjalanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "SK Kep Wakil & Gub BI";
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="sk-kepwakil-gub-sjalan-index">


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
        'content' => function($model, $key, $index) use ($dataSk) {
                  $content = $dataSk[$index]['kode_tahun']."/".$dataSk[$index]['no_dokumen']."/".$dataSk[$index]['format_dokumen']."/".$dataSk[$index]->kodeTahun->tahun;
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
        'content' => function($model,$key,$index) use ($dataSk){
          $temp=json_decode($dataSk[$index]['pengesah']);
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
        function($model, $key, $index) use ($dataSk){
          $temp = $dataSk[$index]['file_dokumen'];
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
        'template' => Yii::$app->user->identity->role->ket_role=='Approval'?'{view}':(Yii::$app->user->identity->role->ket_role=='Operator'?('{view}{update}'):'{view}{update}{delete}'),
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
        Yii::$app->user->identity->role->ket_role== 'Operator' || Yii::$app->user->identity->role->ket_role=='Administrator'?
        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create','kode'=>$_GET['kode'],], ['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>Yii::t('app', 'Create Satuan Kerja')])   . ' '.
          Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index','kode'=>$_GET['kode']], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')]):
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index','kode'=>$_GET['kode']], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
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
