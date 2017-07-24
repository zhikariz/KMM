<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tim */

$this->title = 'Update Tim: ' . $model->kode_tim;
$this->params['breadcrumbs'][] = ['label' => 'Tims', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_tim, 'url' => ['view', 'id' => $model->kode_tim]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="tim-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
