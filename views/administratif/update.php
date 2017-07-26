<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Administratif */

$this->title = 'Update Administratif : ' . $model->kode_tahun."/".$model->format_dokumen."/".$model->kode_jenis_dokumen."/".$model->kode_sifat_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Administratif', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_surat_adm, 'url' => ['view', 'id' => $model->id_surat_adm]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="administratif-update">

    <?= $this->render('_form_update', [
      'model' => $model,
      'format' => $dataFormatJenis,
      'dataSatker' => $dataSatker,
      'dataUnit'=>$dataUnit,
      'dataTim' => $dataTim,
      'dataPengesah' => $dataPengesah
    ]) ?>

</div>
