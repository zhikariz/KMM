<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TempDokumenMasuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temp-dokumen-masuk-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_dokumen_masuk')->textInput() ?>

    <?= $form->field($model, 'no_dokumen')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tgl_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'perihal')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'asal_dokumen')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tgl_terima')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_sifat_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kesegeraan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dari')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tujuan_disposisi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'petunjuk_disposisi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ket_disposisi_kepala')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ket_disposisi_tim')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ket_disposisi_unit')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file_dokumen')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'waktu_input')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'editor')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
