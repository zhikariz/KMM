<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TempSuratjalan */

$this->title = 'Update Temp Suratjalan: ' . $model->id_temp_suratjalan;
$this->params['breadcrumbs'][] = ['label' => 'Temp Suratjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_temp_suratjalan, 'url' => ['view', 'id' => $model->id_temp_suratjalan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="temp-suratjalan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
