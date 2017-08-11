<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Petunjuk */

$this->title = $model->id_petunjuk;
$this->params['breadcrumbs'][] = ['label' => 'Petunjuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="petunjuk-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_petunjuk], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_petunjuk], [
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
            'id_petunjuk',
            'keterangan_petunjuk',
        ],
    ]) ?>

</div>
