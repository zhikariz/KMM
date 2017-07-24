<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Satuankerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="satuankerja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_satuan_kerja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket_satuan_kerja')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
