<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Administratif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="administratif-form">

    <?php $form = ActiveForm::begin([
      'options' => [
         'class' => 'form-vertical',
         'enctype' => 'multipart/form-data',
],
    ]); ?>
    <?php
    $satker = json_decode($format->format_jenis_dokumen,true);

    if(in_array("Satuan Kerja",$satker)){
      echo Html::activeDropDownList($model, "format_dokumen[satker]",$dataSatker,
      [
          'class' => 'btn btn-primary dropdown-toggle col-lg-12',
          'prompt'=>'Pilih Satuan Kerja',
      ]);
      echo "<br>";
      echo "<br>";

    }
    if(in_array("Tim Kerja",$satker)){
        echo Html::activeDropDownList($model, "format_dokumen[tim]",$dataTim,
        [
            'class' => 'btn btn-primary dropdown-toggle col-lg-12',
            'prompt'=>'Pilih Tim Kerja'
        ]);
        echo "<br>";
        echo "<br>";

    }
    if(in_array("Unit Kerja",$satker)){
        echo Html::activeDropDownList($model, "format_dokumen[unit]",$dataUnit,
        [
            'class' => 'btn btn-primary dropdown-toggle col-lg-12',
            'prompt'=>'Pilih Unit Kerja'
        ]);
        echo "<br>";
        echo "<br>";
    }
     ?>

    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengesah')->checkboxlist($dataPengesah,['separator'=>'<br>']);?>
      <?= $form->field($model, 'file_dokumen')->label('File Dokumen')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
