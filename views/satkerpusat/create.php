<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Satkerpusat */

$this->title = 'Create Satkerpusat';
$this->params['breadcrumbs'][] = ['label' => 'Satkerpusats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="satkerpusat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
