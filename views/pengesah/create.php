<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pengesah */

$this->title = 'Create Pengesah';
$this->params['breadcrumbs'][] = ['label' => 'Pengesah', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="pengesah-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
