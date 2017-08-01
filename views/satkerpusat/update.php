<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Satkerpusat */

$this->title = 'Update Satkerpusat: ' . $model->kode_satker_pusat;
$this->params['breadcrumbs'][] = ['label' => 'Satkerpusats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_satker_pusat, 'url' => ['view', 'id' => $model->kode_satker_pusat]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="satkerpusat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
