<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TempDokumenMasukSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temp-dokumen-masuk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_temp_dokumen_masuk') ?>

    <?= $form->field($model, 'id_dokumen_masuk') ?>

    <?= $form->field($model, 'no_dokumen') ?>

    <?= $form->field($model, 'tgl_dokumen') ?>

    <?= $form->field($model, 'perihal') ?>

    <?php // echo $form->field($model, 'asal_dokumen') ?>

    <?php // echo $form->field($model, 'tgl_terima') ?>

    <?php // echo $form->field($model, 'kode_sifat_dokumen') ?>

    <?php // echo $form->field($model, 'kesegeraan') ?>

    <?php // echo $form->field($model, 'dari') ?>

    <?php // echo $form->field($model, 'tujuan_disposisi') ?>

    <?php // echo $form->field($model, 'petunjuk_disposisi') ?>

    <?php // echo $form->field($model, 'ket_disposisi_kepala') ?>

    <?php // echo $form->field($model, 'ket_disposisi_tim') ?>

    <?php // echo $form->field($model, 'ket_disposisi_unit') ?>

    <?php // echo $form->field($model, 'file_dokumen') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'waktu_input') ?>

    <?php // echo $form->field($model, 'editor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
