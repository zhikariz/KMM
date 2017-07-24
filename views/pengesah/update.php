<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengesah */

$this->title = 'Update Pengesah: ' . $model->id_pengesah;
$this->params['breadcrumbs'][] = ['label' => 'Pengesahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pengesah, 'url' => ['view', 'id' => $model->id_pengesah]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="pengesah-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
