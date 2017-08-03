<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notadebet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notadebet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
      echo Html::activeDropDownList($model, "kode_satuan_kerja", $dataSatker,
      [
          'class' => 'btn btn-primary dropdown-toggle col-lg-12',
          'prompt'=>'Pilih Satuan Kerja',
      ]);
      echo "<br>";
      echo "<br>";
    ?>

    <?php
      echo Html::activeDropDownList($model, "kode_satker_pusat", $dataSatkerPusat,
      [
          'class' => 'btn btn-primary dropdown-toggle col-lg-12',
          'prompt'=>'Pilih Satuan Kerja Pusat',
      ]);
      echo "<br>";
      echo "<br>";
    ?>



    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengesah')->checkboxlist($dataPengesah);?>

    <?= $form->field($model, 'file_dokumen')->label('File Dokumen')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
