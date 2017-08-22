<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TempAdm */

$this->title = 'Update Temp Adm: ' . $model->id_temp_adm;
$this->params['breadcrumbs'][] = ['label' => 'Temp Adms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_temp_adm, 'url' => ['view', 'id' => $model->id_temp_adm]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="temp-adm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
