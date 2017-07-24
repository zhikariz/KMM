<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pejabat */

$this->title = 'Create Pejabat';
$this->params['breadcrumbs'][] = ['label' => 'Pejabat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="pejabat-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
