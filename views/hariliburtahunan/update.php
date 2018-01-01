<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hariliburtahunan */

$this->title = 'Update Hariliburtahunan: ' . $model->id_hari_libur;
$this->params['breadcrumbs'][] = ['label' => 'Hariliburtahunans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_hari_libur, 'url' => ['view', 'id' => $model->id_hari_libur]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="hariliburtahunan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
