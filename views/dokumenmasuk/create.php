<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dokumenmasuk */

$this->title = $_GET['sifat']=="Rhs"?("Create Dokumen Masuk Rahasia"):"Create Dokumen Masuk Biasa";
$this->params['breadcrumbs'][] = ['label' => $_GET['sifat']=="Rhs"?("Dokumen Masuk Rahasia"):"Dokumen Masuk Biasa", 'url' => ['index','sifat'=>$_GET['sifat']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="dokumenmasuk-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dataUnit'=>$dataUnit,
        'dataPetunjuk'=>$dataPetunjuk,
        'dataKepala'=>$dataKepala,
    ]) ?>

</div>
