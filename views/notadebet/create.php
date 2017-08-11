<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Notadebet */

$this->title = 'Create Notadebet';
$this->params['breadcrumbs'][] = ['label' => 'Nota Debet', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="notadebet-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dataSatker'=>$dataSatker,
        'dataSatkerPusat'=>$dataSatkerPusat,
        'dataPengesah' => $dataPengesah,
    ]) ?>

</div>
