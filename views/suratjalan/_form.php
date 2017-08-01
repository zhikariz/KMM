<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Suratjalan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suratjalan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_tahun')->textInput() ?>

    <?= $form->field($model, 'kode_satuan_kerja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_satker_pusat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_dokumen')->textInput() ?>

    <?= $form->field($model, 'pengesah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'waktu_input')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_dokumen')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
