<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Satuankerja */

$this->title = 'Update Satuankerja: ' . $model->kode_satuan_kerja;
$this->params['breadcrumbs'][] = ['label' => 'Satuan Kerja', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_satuan_kerja, 'url' => ['view', 'id' => $model->kode_satuan_kerja]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="satuankerja-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
