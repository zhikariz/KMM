<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TempNotaDebet */

$this->title = $model->id_temp_nota_debet;
$this->params['breadcrumbs'][] = ['label' => 'Temp Nota Debets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="temp-nota-debet-view">

      <p>
        <?= Html::a('Setujui', ['approve', 'id' => $model->id_temp_nota_debet], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Apakah kamu ingin menyetujui surat ini?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Tolak', ['reject', 'id' => $model->id_temp_nota_debet], [
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
            'id_temp_nota_debet',
            'id_nota_debet',
            'kode_tahun',
            'no_dokumen',
            'kode_satuan_kerja',
            'kode_satker_pusat',
            'pengesah:ntext',
            'perihal:ntext',
            'id_user',
            'waktu_input',
            'file_dokumen:ntext',
            'editor:ntext',
        ],
    ]) ?>

</div>
