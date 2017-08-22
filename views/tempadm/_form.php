<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TempAdm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temp-adm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_surat_adm')->textInput() ?>

    <?= $form->field($model, 'no_dokumen')->textInput() ?>

    <?= $form->field($model, 'kode_tahun')->textInput() ?>

    <?= $form->field($model, 'format_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengesah')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kode_jenis_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_sifat_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'perihal')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'waktu_input')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'editor')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
