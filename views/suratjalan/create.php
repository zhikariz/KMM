<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Suratjalan */

$this->title = 'Create Surat Jalan';
$this->params['breadcrumbs'][] = ['label' => 'Surat Jalan', 'url' => ['index','kode'=>$_GET['kode']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="suratjalan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
