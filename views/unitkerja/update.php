<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unitkerja */

$this->title = 'Update Unit Kerja : ' . $model->kode_unit_kerja;
$this->params['breadcrumbs'][] = ['label' => 'Unit Kerja', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_unit_kerja, 'url' => ['view', 'id' => $model->kode_unit_kerja]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="unitkerja-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
