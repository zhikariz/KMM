<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Suratjalan */
$no_dokumen=$model->kode_tahun."/".$model->no_dokumen."/".$model->format_dokumen."/".$model->kode_satuan_kerja;
$this->title = 'Update Surat Jalan: ' . $no_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Surat Jalan', 'url' => ['index','kode'=>$_GET['kode']]];
$this->params['breadcrumbs'][] = ['label' => $no_dokumen, 'url' => ['view', 'kode'=>$_GET['kode'], 'id' => $model->id_surat_jalan]];
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
