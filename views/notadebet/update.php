<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notadebet */

$this->title = 'Update Nota Debet: ' . $model->id_nota_debet;
$this->params['breadcrumbs'][] = ['label' => 'Notadebets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_nota_debet, 'url' => ['view', 'id' => $model->id_nota_debet]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="notadebet-update">


    <?= $this->render('_form', [
      'model' => $model,
      'dataSatker'=>$dataSatker,
      'dataSatkerPusat'=>$dataSatkerPusat,
      'dataPengesah' => $dataPengesah,
    ]) ?>

</div>
