<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */

$this->title = 'Update  '.$kode['ket_jenis_dokumen'] ." ". $model->id_sk_kepwakil_gub_sjalan;
$this->params['breadcrumbs'][] = ['label' => 'Sk Kepwakil Gub Sjalans', 'url' => ['index','kode'=>$model->kode_jenis_dokumen]];
$this->params['breadcrumbs'][] = ['label' => $model->id_sk_kepwakil_gub_sjalan, 'url' => ['view', 'id' => $model->id_sk_kepwakil_gub_sjalan]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="sk-kepwakil-gub-sjalan-update">



    <?= $this->render('_form', [
        'model' => $model,
        'dataPengesah'=>$dataPengesah,
    ]) ?>

</div>
