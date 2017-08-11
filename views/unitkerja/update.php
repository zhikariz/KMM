<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unitkerja */

$this->title = 'Update Unitkerja: ' . $model->kode_unit_kerja;
$this->params['breadcrumbs'][] = ['label' => 'Unitkerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_unit_kerja, 'url' => ['view', 'id' => $model->kode_unit_kerja]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="unitkerja-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
