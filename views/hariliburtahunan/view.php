<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Hariliburtahunan */

$this->title = $model->id_hari_libur;
$this->params['breadcrumbs'][] = ['label' => 'Hariliburtahunans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="hariliburtahunan-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_hari_libur], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_hari_libur], [
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
            'id_hari_libur',
            'waktu_hari_libur',
            'ket_hari_libur',
        ],
    ]) ?>

</div>
