<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

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
    $satker = json_decode($format->format_jenis_dokumen);?>
    <?php
    <?= $form->field($model, 'format_dokumen')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengesah')->checkboxlist($dataPengesah);?>

      <?= $form->field($model, 'file_dokumen')->label('File Dokumen')->widget(FileInput::classname(), [
        'options' => ['accept' => 'uploads/*'], ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
