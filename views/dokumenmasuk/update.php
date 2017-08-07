<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dokumenmasuk */

$this->title = 'Update Dokumenmasuk: ' . $model->id_dokumen_masuk;
$this->params['breadcrumbs'][] = ['label' => 'Dokumenmasuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_dokumen_masuk, 'url' => ['view', 'id' => $model->id_dokumen_masuk]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="dokumenmasuk-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
