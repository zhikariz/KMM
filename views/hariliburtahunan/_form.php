<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Hariliburtahunan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hariliburtahunan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'waktu_hari_libur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket_hari_libur')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
