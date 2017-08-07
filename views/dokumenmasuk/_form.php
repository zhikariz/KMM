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


    <?php echo '<label>Tanggal Dokumen</label>';
    echo DatePicker::widget([
        'name' => 'tgl_dokumen',
        'type' => DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-MM-yyyy'
        ]
    ]);
    echo "<Br>"; ?>

    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asal_dokumen')->textInput(['maxlength' => true]) ?>

    <?php echo '<label>Tanggal Terima</label>';
    echo DatePicker::widget([
        'name' => 'tgl_terima',
        'type' => DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-MM-yyyy'
        ]
    ]);
    echo "<Br>"; ?>

    <?php
    echo '<label>Kesegeraan</label>';
    echo Html::activeDropDownList($model, "kesegeraan", ['Biasa'=>'Biasa','Segera'=>'Segera','Sangat Segera'],
    [
        'class' => 'btn btn-primary dropdown-toggle col-lg-12',
        'prompt'=>'Pilih Kesegeraan Dokumen',
    ]); echo "<Br>";?>
      <?="<br>"?>
      <?="<br>"?>

    <?= $form->field($model, "tujuan_disposisi['unit']")->checkboxlist($dataUnit,['separator'=>'<br>']);?>

    <?= $form->field($model, "tujuan_disposisi['tim']")->checkboxlist($dataTim,['separator'=>'<br>']);?>

    <?= $form->field($model, 'petunjuk_disposisi')->checkboxlist($dataPetunjuk,['separator'=>'<br>']); ?>

    <?= $form->field($model, 'ket_disposisi_kepala')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket_disposisi_tim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket_disposisi_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_dokumen')->label('File Dokumen')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
