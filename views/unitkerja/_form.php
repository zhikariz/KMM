<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Unitkerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unitkerja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_unit_kerja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket_unit_kerja')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
