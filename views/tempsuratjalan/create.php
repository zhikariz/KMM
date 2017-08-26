<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TempSuratjalan */

$this->title = 'Create Temp Suratjalan';
$this->params['breadcrumbs'][] = ['label' => 'Temp Suratjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="temp-suratjalan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
