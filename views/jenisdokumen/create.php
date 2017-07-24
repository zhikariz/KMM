<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jenisdokumen */

$this->title = 'Create Jenis Dokumen';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Dokumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="jenisdokumen-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
