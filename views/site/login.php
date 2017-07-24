<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<!DOCTYPE html>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Bank Indonesia</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="<?=Yii::$app->request->baseUrl?>/login/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="<?=Yii::$app->request->baseUrl?>/login/style.css">
  <link href='<?= Yii::$app->request->baseUrl?>/dist/img/bi.ico' rel='SHORTCUT ICON'/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <style>
  body {
    	 background: url("<?=Yii::$app->request->baseUrl?>/login/photo_bg.jpg") no-repeat center center fixed;
      	background-size: cover;
      	font-size: 16px;
      	font-family: 'Lato', sans-serif;
      	font-weight: 300;
      	margin: 0;
      	color: #666;
      }</style>
</head>

<body>
	<div class="container">
		<div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Bank Indonesia</h2>
			</div>
      <?php $form = ActiveForm::begin([
          'id' => 'login-form',
          'layout' => 'horizontal',
          'fieldConfig' => [
              'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
              'labelOptions' => ['class' => 'col-lg-1 control-label'],
          ],
      ]); ?>

          <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
          <?= $form->field($model, 'password')->passwordInput() ?>

          <div class="form-group">
              <div class="col-xs-12">
                  <?= Html::submitButton('Login', ['class' => 'btn btn-primary col-xs-12', 'name' => 'login-button']) ?>
              </div>
          </div>

      <?php ActiveForm::end(); ?>
		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>

</html>
