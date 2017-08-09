<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sk-kepwakil-gub-sjalan-form">

  <?php $form = ActiveForm::begin([
               'options' => ['enctype'=>'multipart/form-data']
           ]); ?>

    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengesah')->checkboxlist($dataPengesah);?>

    <?= $form->field($model, 'file_dokumen')->label('File Dokumen')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
