<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Hariliburtahunan */

$this->title = 'Create Hari Libur';
$this->params['breadcrumbs'][] = ['label' => 'Hari Libur', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="hariliburtahunan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
