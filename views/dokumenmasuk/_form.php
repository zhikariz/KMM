<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use \kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Dokumenmasuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dokumenmasuk-form">

  <?php $form = ActiveForm::begin([
               'options' => ['enctype'=>'multipart/form-data']
           ]); ?>
    <?php if(!$model->isNewRecord){?>

    <?= $form->field($model, 'no_dokumen')->textInput(['maxlength' => true, 'disabled' => Yii::$app->user->identity->role->ket_role != 'Administrator' ? true:false]) ?>

    <?=$form->field($model, 'tgl_dokumen')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Masukkan Tanggal Dokumen ...'],
            'language' => 'id',
            'disabled' => Yii::$app->user->identity->role->ket_role != 'Administrator' ? true:false,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'DD, dd-MM-yyyy'
    ]
]);?>


    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true,'disabled' => Yii::$app->user->identity->role->ket_role != 'Administrator' ? true:false]) ?>

    <?= $form->field($model, 'asal_dokumen')->textInput(['maxlength' => true,'disabled' => Yii::$app->user->identity->role->ket_role != 'Administrator' ? true:false]) ?>

    <?=$form->field($model, 'tgl_terima')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Masukkan Tanggal Terima ...'],
            'language' => 'id',
            'disabled' => Yii::$app->user->identity->role->ket_role != 'Administrator' ? true:false,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'DD, dd-MM-yyyy',

    ]
]);?>

    <?php
    echo $form->field($model, 'kesegeraan')->widget(Select2::classname(),
    [
    'data' => ['Biasa'=>'Biasa','Segera'=>'Segera','Sangat Segera'=>'Sangat Segera'],
    'disabled' => Yii::$app->user->identity->role->ket_role != 'Administrator' ? true:false,
    'options'=>['placeholder'=>'Pilih Satuan Kerja Pusat'],
    'pluginOptions' => ['allowClear' => true]
  ]);?>
  <?php
  echo $form->field($model, 'dari')->widget(Select2::classname(),
  [
  'data' => $dataKepala,
  'disabled' => Yii::$app->user->identity->role->ket_role != 'Administrator' ? true:false,
  'options'=>['placeholder'=>'Pilih Dari'],
  'pluginOptions' => ['allowClear' => true]
  ]);?>



    <?= $form->field($model, 'tujuan_disposisi[kepala]')->checkboxlist($dataKepala,['separator'=>'<br>','onclick' => Yii::$app->user->identity->role->ket_role != 'Administrator' ? 'return false;':'return true;']);?>
    <?php }else{
      ?>
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
  echo $form->field($model, 'kesegeraan')->widget(Select2::classname(),
  [
  'data' => ['Biasa'=>'Biasa','Segera'=>'Segera','Sangat Segera'=>'Sangat Segera'],
  'options'=>['placeholder'=>'Pilih Kesegeraan'],
  'pluginOptions' => ['allowClear' => true]
]);?>

<?php
echo $form->field($model, 'dari')->widget(Select2::classname(),
[
'data' => $dataKepala,
'options'=>['placeholder'=>'Pilih Dari'],
'pluginOptions' => ['allowClear' => true]
]);?>


      <?= $form->field($model, 'tujuan_disposisi[kepala]')->checkboxlist($dataKepala,['separator'=>'<br>']);?>
      <?php }?>

    <?= $form->field($model, 'tujuan_disposisi[unit]')->checkboxlist($dataUnit,['separator'=>'<br>'])->label(false);?>

    <?= $form->field($model, 'petunjuk_disposisi')->checkboxlist($dataPetunjuk,['separator'=>'<br>']); ?>
      <?php if(!$model->isNewRecord){?>
    <?= $form->field($model, 'ket_disposisi_kepala')->textarea(['rows' => '3','disabled' => Yii::$app->user->identity->role->ket_role != 'Administrator' ? true:false,]) ?>
    <?php }else{?>
      <?= $form->field($model, 'ket_disposisi_kepala')->textarea(['rows' => '3']) ?>
    <?php }?>

    <?= $form->field($model, 'ket_disposisi_tim')->textarea(['rows' => '3'])?>

    <?= $form->field($model, 'ket_disposisi_unit')->textarea(['rows' => '3']) ?>

    <?= $form->field($model, 'file_dokumen')->label('File Dokumen')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
