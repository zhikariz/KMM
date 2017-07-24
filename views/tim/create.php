<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tim */

$this->title = 'Create Tim';
$this->params['breadcrumbs'][] = ['label' => 'Tims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="tim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
