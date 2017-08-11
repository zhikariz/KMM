<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sifatdokumen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sifatdokumen-form">

  <?php $form = ActiveForm::begin([
               'options' => ['enctype'=>'multipart/form-data']
           ]); ?>

    <?= $form->field($model, 'kode_sifat_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket_sifat_dokumen')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
