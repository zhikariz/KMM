<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dokumenmasuk */

$this->title = $model->id_dokumen_masuk;
$this->params['breadcrumbs'][] = ['label' => 'Dokumenmasuks', 'url' => ['index','sifat'=>$_GET['sifat']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="dokumenmasuk-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_dokumen_masuk], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_dokumen_masuk], [
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
            'id_dokumen_masuk',
            'no_dokumen',
            'tgl_dokumen',
            'perihal',
            'asal_dokumen',
            'tgl_terima',
            'kode_sifat_dokumen',
            'tujuan_disposisi',
            'petunjuk_disposisi',
            'ket_disposisi_kepala',
            'ket_disposisi_tim',
            'ket_disposisi_unit',
            'file_dokumen',
            'id_user',
            'waktu_input',
        ],
    ]) ?>

</div>
