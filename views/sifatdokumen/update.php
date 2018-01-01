<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sifatdokumen */

$this->title = 'Update Sifat Dokumen: ' . $model->kode_sifat_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Sifat Dokumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_sifat_dokumen, 'url' => ['view', 'id' => $model->kode_sifat_dokumen]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="sifatdokumen-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
