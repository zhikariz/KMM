<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Administratif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="administratif-form">

  <?php $form = ActiveForm::begin([
               'options' => ['enctype'=>'multipart/form-data']
           ]); ?>

           <?php
           if (!$model->isNewRecord) {
             if(Yii::$app->user->identity->role->ket_role== 'Administrator'){
             echo $form->field($model, 'no_dokumen')->textInput(['maxlength' => true,]);
             echo $form->field($model, 'waktu_input')->widget(DatePicker::classname(), [
             'options' => ['placeholder' => 'Masukkan Tanggal Dokumen ...'],
                     'language' => 'id',
             'pluginOptions' => [
                 'autoclose'=>true,
                 'format' => 'dd-mm-yyyy'
             ]
         ]);
           }
           }
             ?>
    <?php
    $satker = json_decode($format->format_jenis_dokumen,true);
if($model->isNewRecord){
    if(in_array("Satuan Kerja",$satker)){
      echo $form->field($model, 'format_dokumen[satker]')->widget(Select2::classname(),
      [
      'data' => $dataSatker,
      'options'=>
      [
        'placeholder'=>'Pilih Satuan Kerja',
        'onchange'=>'woyo();',
      ],
      'pluginOptions' => ['allowClear' => true,

    ],


      ]);
    }

    if(in_array("Tim Kerja",$satker)){
      echo $form->field($model, 'format_dokumen[tim]')->widget(Select2::classname(),
      [
        'data' => $dataTim,
        'options'=>
        [
          'placeholder'=>'Pilih Tim',
          'onchange'=>'woyos();',
        ],
        'pluginOptions' => ['allowClear' => true],
        'disabled'=>true,
      ])
        ->label(false);

    }

    if(in_array("Unit Kerja",$satker)){
      echo $form->field($model, 'format_dokumen[unit]')->widget(Select2::classname(),
      [
        'data' => $dataUnit,
        'options'=>
        [
          'placeholder'=>'Pilih Unit',
        ],
        'pluginOptions' => ['allowClear' => true],
        'disabled'=>true,
      ])
        ->label(false);
    }
  }else{
    if(in_array("Satuan Kerja",$satker)){
      if(Yii::$app->user->identity->role->ket_role != 'Administrator'){
      echo $form->field($model, 'format_dokumen[satker]')->widget(Select2::classname(),
      [
      'data' => $dataSatker,
      'disabled' => true,
      'options'=>[
        'placeholder'=>'Pilih Satuan Kerja',
        'onchange'=>'woyo();',
      ],
      'pluginOptions' => ['allowClear' => true]
      ]);

    }else{
      echo $form->field($model, 'format_dokumen[satker]')->widget(Select2::classname(),
      [
      'data' => $dataSatker,
      'options'=>[
        'placeholder'=>'Pilih Satuan Kerja',
        'onchange'=>'woyo();',
      ],
      'pluginOptions' => ['allowClear' => true]
      ]);
    }
  }
    if(in_array("Tim Kerja",$satker)){
      if(Yii::$app->user->identity->role->ket_role != 'Administrator'){
      echo $form->field($model, 'format_dokumen[tim]')->widget(Select2::classname(),
      [
        'data' => $dataTim,
        'disabled' => true,
        'options'=>
        [
          'placeholder'=>'Pilih Tim',
        ]
      ])
        ->label(false);
      } else {
        echo $form->field($model, 'format_dokumen[tim]')->widget(Select2::classname(),
        [
          'data' => $dataTim,
          'disabled' => true,
          'options'=>
          [
            'placeholder'=>'Pilih Tim',
            'onchange'=>'woyos();',
          ]
        ])
          ->label(false);

      }

    }
    if(in_array("Unit Kerja",$satker)){
      echo $form->field($model, 'format_dokumen[unit]')->widget(Select2::classname(),
      [
        'data' => $dataUnit,
        'disabled' => Yii::$app->user->identity->role->ket_role != 'Administrator'?true:true,
        'options'=>['placeholder'=>'Pilih Unit']
      ])
        ->label(false);
    }
  }
     ?>
    <?=$form->field($model, 'perihal')->textInput(['maxlength' => true,])?>

    <?= $form->field($model, 'pengesah')->checkboxlist($dataPengesah,['separator'=>'<br>']);?>
      <?= $form->field($model, 'file_dokumen')->label('File Dokumen')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>


</div>
