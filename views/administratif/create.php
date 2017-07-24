<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Administratif */

$this->title = 'Create Administratif';
$this->params['breadcrumbs'][] = ['label' => 'Administratif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="administratif-create">

    <?= $this->render('_form', [
        'model' => $model,
        'format' => $dataFormatJenis,
        'dataSatker' => $dataSatker,
        'dataUnit'=>$dataUnit,
        'dataTim' => $dataTim,
        'dataPengesah' => $dataPengesah,
    ]) ?>

</div>
