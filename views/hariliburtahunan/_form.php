<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Hariliburtahunan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hariliburtahunan-form">

  <?php $form = ActiveForm::begin([
               'options' => ['enctype'=>'multipart/form-data']
           ]); ?>

    <?=$form->field($model, 'waktu_hari_libur')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Masukkan Tanggal Terima ...'],
            'disabled' => Yii::$app->user->identity->role->ket_role != 'Administrator' ? true:false,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd-mm-yyyy',

    ]
]);?>

    <?= $form->field($model, 'ket_hari_libur')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
