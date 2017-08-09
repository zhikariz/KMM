<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pengesah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengesah-form">

  <?php $form = ActiveForm::begin([
               'options' => ['enctype'=>'multipart/form-data']
           ]); ?>

    <?= $form->field($model, 'nama_pengesah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_pengesah')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
