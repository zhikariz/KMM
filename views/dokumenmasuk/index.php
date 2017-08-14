<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DokumenmasukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dokumen Masuk';
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="dokumenmasuk-index">

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'', 'options'=>['colspan'=>9]],
                ['content'=>'Keterangan Disposisi', 'options'=>['colspan'=>3, 'class'=>'text-center warning']],
            ],
            'options'=>['class'=>'skip-export'] // remove this row from export
        ]
    ],
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

      ],
      [
        'attribute'=>'tgl_dokumen',
        'vAlign' => 'middle',
        'hAlign' => 'center',
      ],
      [
        'attribute'=>'perihal',
        'vAlign' => 'middle',
        'hAlign' => 'center',
      ],
      [
        'attribute'=>'asal_dokumen',
        'vAlign' => 'middle',
        'hAlign' => 'center',
      ],
      [
        'attribute'=>'tgl_terima',
        'vAlign' => 'middle',
        'hAlign' => 'center',
      ],
      [
        'attribute'=>'kesegeraan',
        'vAlign' => 'middle',
        'hAlign' => 'center',
      ],
      [
        'attribute'=>'tujuan_disposisi',
        'format'=>'html',
        'content'=>function($model,$key,$index) use ($dataDokumenMasuk){
          $temp=json_decode($dataDokumenMasuk[$index]['tujuan_disposisi'],true);
          $a = $temp['kepala'];
        for($i=0;$i<count($a);$i++){
          $vl[$i]='<button class="btn-xs btn btn-danger" style="margin: 1px;">'.$a[$i].'</button>';
        }
        $hasil = implode($vl);
        $b = $temp['tim'];
        for($i=0;$i<count($b);$i++){
          $t[$i]='<button class="btn-xs btn btn-info" style="margin: 1px;">'.$b[$i].'</button>';
        }
        $hasil .= implode($t);
        $c = $temp['unit'];
        for($i=0;$i<count((array)$c);$i++){
          $u[$i]='<button class="btn-xs btn btn-primary" style="margin: 1px;">'.$c[$i].'</button>';
        }
        $hasil .= implode($u);
        return $hasil;

        }
      ],
      [
        'attribute'=>'petunjuk_disposisi',
        'format'=>'html',
        'content'=>function($model,$key,$index) use ($dataDokumenMasuk){
          $temp=json_decode($dataDokumenMasuk[$index]['petunjuk_disposisi'],true);
        for($i=0;$i<count($temp);$i++){
          $vl[$i]='<button class="btn-xs btn btn-warning" style="margin: 1px;">'.$temp[$i].'</button><br>';
        }
        $hasil = implode($vl);
        return $hasil;

        }
      ],
      [
        'attribute'=>'ket_disposisi_kepala',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'header'=>'Kepala'
      ],
      [
        'attribute'=>'ket_disposisi_tim',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'header'=>'Tim'
      ],
      [
        'attribute'=>'ket_disposisi_unit',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'header'=>'Unit'
      ],
      [
        'attribute'=>'file_dokumen',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format'=>'raw',
        'content' =>
        function($model, $key, $index) use ($dataDokumenMasuk){
          $temp = $dataDokumenMasuk[$index]['file_dokumen'];
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
              $url ='index.php?r=dokumenmasuk/view&sifat='.$_GET['sifat'].'&id='.$model->id_dokumen_masuk;
              return $url;
          }

          if ($action === 'update') {
              $url ='index.php?r=dokumenmasuk/update&sifat='.$_GET['sifat'].'&id='.$model->id_dokumen_masuk;
              return $url;
          }
          if ($action === 'delete') {
              $url ='index.php?r=dokumenmasuk/delete&sifat='.$_GET['sifat'].'&id='.$model->id_dokumen_masuk;
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
        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create','sifat'=>$_GET['sifat']], ['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>Yii::t('app', 'Create Satuan Kerja')])   . ' '.
          Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index','sifat'=>$_GET['sifat']], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')]):
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index','sifat'=>$_GET['sifat']], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
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
        'heading' => "Dokumen Masuk ",
    ],
    'persistResize'=>false,
    'toggleDataOptions'=>['minCount'=>10],
    ]); ?>
    <?php Pjax::end(); ?>
</div>