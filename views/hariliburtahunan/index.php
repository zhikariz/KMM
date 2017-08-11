<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HariliburtahunanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hari Libur';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hariliburtahunan-index">

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
            'headerOptions'=>['class'=>'kartik-sheet-style']
          ],
          [
            'attribute'=>'waktu_hari_libur',
            'vAlign'=>'middle',
            'hAlign'=>'center',
          ],
          [
            'attribute'=>'ket_hari_libur',
            'vAlign' => 'middle',
            'hAlign' => 'center',
          ],
          [
            'class'=>'kartik\grid\ActionColumn'
          ],
        ],
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        // set your toolbar
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>Yii::t('app', 'Create Satuan Kerja')]) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
            ],

            '{toggleData}',
        ],
        // set export properties
        'export'=>[
            'fontAwesome'=>true
        ],
        // parameters from the demo form
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading' => 'Hari Libur'
        ],
        'persistResize'=>false,
        'toggleDataOptions'=>['minCount'=>10]
    ]); ?>
        <?php Pjax::end(); ?>

</div>
