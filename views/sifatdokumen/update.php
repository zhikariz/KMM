<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sifatdokumen */

$this->title = 'Update Sifatdokumen: ' . $model->kode_sifat_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Sifatdokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_sifat_dokumen, 'url' => ['view', 'id' => $model->kode_sifat_dokumen]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="sifatdokumen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
