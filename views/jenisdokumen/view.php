<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jenisdokumen */

$this->title = $model->kode_jenis_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Jenisdokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="jenisdokumen-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kode_jenis_dokumen], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kode_jenis_dokumen], [
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
            'kode_jenis_dokumen',
            'ket_jenis_dokumen',
            'format_jenis_dokumen',
        ],
    ]) ?>

</div>
