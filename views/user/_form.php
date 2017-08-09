<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

  <?php $form = ActiveForm::begin([
               'options' => ['enctype'=>'multipart/form-data']
           ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_user')->textInput(['maxlength' => true]) ?>

    <?=  "<b>Role</b><Br><br>".Html::activeDropDownList($model, "id_role",$dataRole,
      [
          'class' => 'btn btn-primary dropdown-toggle col-lg-12',
          'prompt'=>'Pilih Role',
      ]);
      ?>
<br><br><br>

    <?= $form->field($model, 'photo_user')->label('Foto Profil')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
