<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dokumenmasuk */

$this->title = 'Create Dokumen Masuk';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Masuk', 'url' => ['index','sifat'=>$_GET['sifat']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="dokumenmasuk-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dataUnit'=>$dataUnit,
        'dataTim'=>$dataTim,
        'dataPetunjuk'=>$dataPetunjuk,
        'dataKepala'=>$dataKepala,
    ]) ?>

</div>
