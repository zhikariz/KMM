<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */

$this->title = 'Create '.$kode['ket_jenis_dokumen'];
$this->params['breadcrumbs'][] = ['label' => $kode['ket_jenis_dokumen'], 'url' => ['index','kode'=>$kode['kode_jenis_dokumen']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="sk-kepwakil-gub-sjalan-create">



    <?= $this->render('_form', [
        'model' => $model,
        'dataPengesah'=>$dataPengesah,
    ]) ?>

</div>
