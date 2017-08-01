<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Suratjalan */

$this->title = 'Update Suratjalan: ' . $model->id_surat_jalan;
$this->params['breadcrumbs'][] = ['label' => 'Suratjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_surat_jalan, 'url' => ['view', 'id' => $model->id_surat_jalan]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="suratjalan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
