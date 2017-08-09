<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Satkerpusat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="satkerpusat-form">

  <?php $form = ActiveForm::begin([
               'options' => ['enctype'=>'multipart/form-data']
           ]); ?>

    <?= $form->field($model, 'kode_satker_pusat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket_satker_pusat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
