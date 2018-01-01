<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Petunjuk */

$this->title = 'Update Petunjuk : ' . $model->id_petunjuk;
$this->params['breadcrumbs'][] = ['label' => 'Petunjuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_petunjuk, 'url' => ['view', 'id' => $model->id_petunjuk]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="petunjuk-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
