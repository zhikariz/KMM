<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Satuankerja */

$this->title = 'Create Satuan Kerja';
$this->params['breadcrumbs'][] = ['label' => 'Satuankerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="satuankerja-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
