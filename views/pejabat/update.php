<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pejabat */

$this->title = 'Update Pejabat : ' . $model->id_pejabat;
$this->params['breadcrumbs'][] = ['label' => 'Pejabats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pejabat, 'url' => ['view', 'id' => $model->id_pejabat]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="pejabat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
