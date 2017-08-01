<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Suratjalan */

$this->title = $model->id_surat_jalan;
$this->params['breadcrumbs'][] = ['label' => 'Suratjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="suratjalan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_surat_jalan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_surat_jalan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_surat_jalan',
            'kode_tahun',
            'kode_satuan_kerja',
            'kode_satker_pusat',
            'no_dokumen',
            'pengesah',
            'id_user',
            'waktu_input',
            'file_dokumen',
        ],
    ]) ?>

</div>
