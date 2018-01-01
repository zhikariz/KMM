<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TempDokumenMasuk */

$this->title = 'Update Temp Dokumen Masuk: ' . $model->id_temp_dokumen_masuk;
$this->params['breadcrumbs'][] = ['label' => 'Temp Dokumen Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_temp_dokumen_masuk, 'url' => ['view', 'id' => $model->id_temp_dokumen_masuk]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="temp-dokumen-masuk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
