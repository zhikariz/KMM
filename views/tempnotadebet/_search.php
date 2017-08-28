<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TempNotaDebetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temp-nota-debet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_temp_nota_debet') ?>

    <?= $form->field($model, 'id_nota_debet') ?>

    <?= $form->field($model, 'kode_tahun') ?>

    <?= $form->field($model, 'no_dokumen') ?>

    <?= $form->field($model, 'kode_satuan_kerja') ?>

    <?php // echo $form->field($model, 'kode_satker_pusat') ?>

    <?php // echo $form->field($model, 'pengesah') ?>

    <?php // echo $form->field($model, 'perihal') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'waktu_input') ?>

    <?php // echo $form->field($model, 'file_dokumen') ?>

    <?php // echo $form->field($model, 'editor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
