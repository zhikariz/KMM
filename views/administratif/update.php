<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Administratif */

$this->title = 'Update Administratif : ' . $model->id_surat_adm;
$this->params['breadcrumbs'][] = ['label' => 'Administratifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_surat_adm, 'url' => ['view', 'id' => $model->id_surat_adm]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="administratif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
      'model' => $model,
      'format' => $dataFormatJenis,
      'dataSatker' => $dataSatker,
      'dataUnit'=>$dataUnit,
      'dataTim' => $dataTim,
      'dataPengesah' => $dataPengesah
    ]) ?>

</div>
