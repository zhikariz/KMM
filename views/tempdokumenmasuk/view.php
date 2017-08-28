<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TempDokumenMasuk */

$this->title = $model->id_temp_dokumen_masuk;
$this->params['breadcrumbs'][] = ['label' => 'Temp Dokumen Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="temp-dokumen-masuk-view">


  <p>
    <?= Html::a('Setujui', ['approve', 'sifat'=>$_GET['sifat'],'id' => $model->id_temp_dokumen_masuk], [
        'class' => 'btn btn-success',
        'data' => [
            'confirm' => 'Apakah kamu ingin menyetujui surat ini?',
            'method' => 'post',
        ],
    ]) ?>
    <?= Html::a('Tolak', ['reject', 'sifat'=>$_GET['sifat'],'id' => $model->id_temp_dokumen_masuk], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Apakah kamu ingin menolak surat ini?',
            'method' => 'post',
        ],
    ]) ?>
  </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_temp_dokumen_masuk',
            'id_dokumen_masuk',
            'no_dokumen:ntext',
            'tgl_dokumen',
            'perihal:ntext',
            'asal_dokumen:ntext',
            'tgl_terima',
            'kode_sifat_dokumen',
            'kesegeraan',
            'dari',
            'tujuan_disposisi:ntext',
            'petunjuk_disposisi:ntext',
            'ket_disposisi_kepala:ntext',
            'ket_disposisi_tim:ntext',
            'ket_disposisi_unit:ntext',
            'file_dokumen:ntext',
            'id_user',
            'waktu_input',
            'editor:ntext',
        ],
    ]) ?>

</div>
