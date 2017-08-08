<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Dokumenmasuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dokumenmasuk-form">

  <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_dokumen')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'tgl_dokumen')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Masukkan Tanggal Dokumen ...'],
            'language' => 'id',
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'DD, dd-MM-yyyy'
    ]
]);?>


    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asal_dokumen')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'tgl_terima')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Masukkan Tanggal Terima ...'],
            'language' => 'id',
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'DD, dd-MM-yyyy',

    ]
]);?>

    <?php
    echo '<label>Kesegeraan</label>';
    echo Html::activeDropDownList($model, "kesegeraan", ['Biasa'=>'Biasa','Segera'=>'Segera','Sangat Segera'=>'Sangat Segera'],
    [
        'class' => 'btn btn-primary dropdown-toggle col-lg-12',
        'prompt'=>'Pilih Kesegeraan Dokumen',
    ]); echo "<Br>";?>
      <?="<br>"?>
      <?="<br>"?>


    <?= $form->field($model, 'tujuan_disposisi[kepala]')->checkboxlist($dataKepala,['separator'=>'<br>']);?>

    <?= $form->field($model, 'tujuan_disposisi[unit]')->checkboxlist($dataUnit,['separator'=>'<br>'])->label(false);?>

    <?= $form->field($model, "tujuan_disposisi[tim]")->checkboxlist($dataTim,['separator'=>'<br>'])->label(false);?>

    <?= $form->field($model, 'petunjuk_disposisi')->checkboxlist($dataPetunjuk,['separator'=>'<br>']); ?>

    <?= $form->field($model, 'ket_disposisi_kepala')->textarea(['rows' => '3']) ?>

    <?= $form->field($model, 'ket_disposisi_tim')->textarea(['rows' => '3'])?>

    <?= $form->field($model, 'ket_disposisi_unit')->textarea(['rows' => '3']) ?>

    <?= $form->field($model, 'file_dokumen')->label('File Dokumen')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
