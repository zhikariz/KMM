<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TempSkKepwakilGubSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temp-sk-kepwakil-gub-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_temp_sk_kep_wakil_gub') ?>

    <?= $form->field($model, 'id_sk_kepwakil_gub') ?>

    <?= $form->field($model, 'kode_tahun') ?>

    <?= $form->field($model, 'no_dokumen') ?>

    <?= $form->field($model, 'format_dokumen') ?>

    <?php // echo $form->field($model, 'perihal') ?>

    <?php // echo $form->field($model, 'pengesah') ?>

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
