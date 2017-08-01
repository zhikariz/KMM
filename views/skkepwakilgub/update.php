<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */

$this->title = 'Update  '. $model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kodeTahun->tahun;
$this->params['breadcrumbs'][] = ['label' => 'Sk Kepwakil Gub Sjalans', 'url' => ['index','kode'=>$model->format_dokumen]];
$this->params['breadcrumbs'][] = ['label' => $model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kodeTahun->tahun, 'url' => ['view', 'kode'=>$model->format_dokumen, 'id' => $model->id_sk_kepwakil_gub]];
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
