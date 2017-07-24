<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pejabat */

$this->title = 'Update Pejabat: ' . $model->id_pejabat;
$this->params['breadcrumbs'][] = ['label' => 'Pejabats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pejabat, 'url' => ['view', 'id' => $model->id_pejabat]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="pejabat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
