<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Satkerpusat */

$this->title = $model->kode_satker_pusat;
$this->params['breadcrumbs'][] = ['label' => 'Satkerpusats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="satkerpusat-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kode_satker_pusat], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kode_satker_pusat], [
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
            'kode_satker_pusat',
            'ket_satker_pusat',
        ],
    ]) ?>

</div>
