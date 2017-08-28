<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Notadebet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notadebet-form">

  <?php $form = ActiveForm::begin([
               'options' => ['enctype'=>'multipart/form-data']
           ]); ?>
           <?php
           if (!$model->isNewRecord) {
             if(Yii::$app->user->identity->role->ket_role== 'Administrator'){
             echo $form->field($model, 'no_dokumen')->textInput(['maxlength' => true,]);
           }
           }
             ?>
    <?php
    echo $form->field($model, 'kode_satuan_kerja')->widget(Select2::classname(),
    [
    'data' => $dataSatker,
    'options'=>['placeholder'=>'Pilih Satuan Kerja'],
    'pluginOptions' => ['allowClear' => true]
    ]);
    ?>

    <?php
    echo $form->field($model, 'kode_satker_pusat')->widget(Select2::classname(),
    [
    'data' => $dataSatkerPusat,
    'options'=>['placeholder'=>'Pilih Satuan Kerja Pusat'],
    'pluginOptions' => ['allowClear' => true]
    ]);
    ?>



    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengesah')->checkboxlist($dataPengesah);?>

    <?= $form->field($model, 'file_dokumen')->label('File Dokumen')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
