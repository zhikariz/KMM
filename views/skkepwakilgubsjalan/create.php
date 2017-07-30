<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */

$this->title = 'Create Sk Kepwakil Gub Sjalan';
$this->params['breadcrumbs'][] = ['label' => 'Sk Kepwakil Gub Sjalan', 'url' => ['index','kode'=>$_GET['kode']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="sk-kepwakil-gub-sjalan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
