<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sk-kepwakil-gub-sjalan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_tahun')->textInput() ?>

    <?= $form->field($model, 'no_dokumen')->textInput() ?>

    <?= $form->field($model, 'kode_jenis_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'waktu_input')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_dokumen')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
