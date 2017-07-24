<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sifatdokumen */

$this->title = 'Create Sifat Dokumen';
$this->params['breadcrumbs'][] = ['label' => 'Sifat Dokumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="sifatdokumen-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
