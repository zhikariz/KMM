<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Suratjalan */

$this->title = 'Update Suratjalan: ' . $model->id_surat_jalan;
$this->params['breadcrumbs'][] = ['label' => 'Suratjalans', 'url' => ['index','kode'=>$_GET['kode']]];
$this->params['breadcrumbs'][] = ['label' => $model->id_surat_jalan, 'url' => ['view', 'id' => $model->id_surat_jalan]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="suratjalan-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataSatker'=>$dataSatker,
        'dataPengesah'=>$dataPengesah,
    ]) ?>

</div>
