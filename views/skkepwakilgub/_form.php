<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sk-kepwakil-gub-sjalan-form">

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

    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengesah')->checkboxlist($dataPengesah,['separator'=>'<br>']);?>

    <?= $form->field($model, 'file_dokumen')->label('File Dokumen')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
