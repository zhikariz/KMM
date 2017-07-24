<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Administratif */

$this->title = "Detail Dokumen ".$model->kode_tahun."/".$model->format_dokumen."/".$model->kode_jenis_dokumen."/".$model->kode_sifat_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Administratif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
$no_dokumen = $model->kode_tahun."/".$model->format_dokumen."/".$model->kode_jenis_dokumen."/".$model->kode_sifat_dokumen;
?>
<div class="administratif-view">



    <p>
        <?= Html::a('Update', ['update', 'kode'=>$model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen,'id' => $model->id_surat_adm], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'kode'=>$model->kode_jenis_dokumen,'sifat'=>$model->kode_sifat_dokumen,'id' => $model->id_surat_adm], [
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
            ['attribute'=>'No Dokumen',
            'value'=>function($data,$row) use ($no_dokumen){
return $no_dokumen;
                },
            ],
            'pengesah',
            'kodeJenisDokumen.ket_jenis_dokumen',
            'kodeSifatDokumen.ket_sifat_dokumen',
            'perihal',
            'user.username',
            'waktu_input',
            'file_dokumen',
        ],
    ]) ?>

</div>
