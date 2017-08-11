<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jenisdokumen */

$this->title = 'Update Jenisdokumen: ' . $model->kode_jenis_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Jenisdokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_jenis_dokumen, 'url' => ['view', 'id' => $model->kode_jenis_dokumen]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="jenisdokumen-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
