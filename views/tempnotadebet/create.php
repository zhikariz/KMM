<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TempNotaDebet */

$this->title = 'Create Temp Nota Debet';
$this->params['breadcrumbs'][] = ['label' => 'Temp Nota Debets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temp-nota-debet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
