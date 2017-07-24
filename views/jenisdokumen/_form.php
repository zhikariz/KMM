<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jenisdokumen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jenisdokumen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_jenis_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket_jenis_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'format_jenis_dokumen')->checkboxlist(["Satuan Kerja"=> 'Satuan Kerja', "Tim Kerja" => 'Tim Kerja', "Unit Kerja" => 'Unit Kerja']);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
