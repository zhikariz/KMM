<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dokumenmasuk */

$this->title = 'Update Dokumen Masuk: ' . $model->no_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Masuk', 'url' => ['index','sifat'=>$_GET['sifat']]];
$this->params['breadcrumbs'][] = ['label' => $model->no_dokumen, 'url' => ['view', 'sifat'=>$_GET['sifat'], 'id' => $model->id_dokumen_masuk]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="dokumenmasuk-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataUnit'=>$dataUnit,
        'dataTim'=>$dataTim,
        'dataKepala'=>$dataKepala,
        'dataPetunjuk'=>$dataPetunjuk
    ]) ?>

</div>
